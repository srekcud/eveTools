<?php

namespace App\Service\Procedure;

use App\Message\RavworksJobMessage;
use App\Message\RavworksStockMessage;
use App\Service\Builder\RavworksJobBuilder;
use App\Service\Builder\RavworksStockBuilder;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\Messenger\MessageBusInterface;

class RavworksProjectRetrieveProcedure
{

    const int BATCH_FLUSH = 100;

    public function __construct(
        private readonly RavworksStockBuilder $stockBuilder,
        private readonly RavworksJobBuilder   $jobBuilder,
        private readonly MessageBusInterface  $messageBus,

    )
    {
    }

    public function process($code)
    {
        $html = file_get_contents('https://ravworks.com/plan/' . $code);

        $stock = $this->getArrayFromHTMLTable($html, '#stocks_table');
        foreach ($stock as $stockItem) {
            $messageStock = new RavworksStockMessage($this->stockBuilder->build($code, $stockItem));
            $this->messageBus->dispatch($messageStock);
        }
//TODO: use compact table to avoid issue when 2 exact same jobs need to be run
        $types =
            [
//                'endProduct' =>'#end_products_table',
            'firstStageReaction' => '#first_stage_reacts_table_compact',
                'secondStageReaction' => '#second_stage_reacts_table_compact',
                'bioReaction' => '#bio_reacts_table_compact',
                'hybridReaction' => '#hybrid_reactionss_table_compact',
                'advancedComponents' => '#advanced_comps_table_compact',
                'CapitalComponents' => '#cap_comps_table_compact',
                'others' => '#others_table_compact',
//                'endProductJob' => '#end_product_jobs_table',
        ];

        foreach ($types as $type => $link) {
            $jobs = $this->getArrayFromHTMLTable($html, $link);
            foreach ($jobs as $job) {
                $message = new RavworksJobMessage($this->jobBuilder->build($code, $type, $job));
                $this->messageBus->dispatch($message);
            }
        }
    }


    public function getArrayFromHTMLTable($html, $table): array
    {
        $crawler = new Crawler($html);

        $table = $crawler->filter($table);

        $data = [];

        $table->filter('tr')->each(function (Crawler $row, $rowIndex) use (&$data) {
            if ($rowIndex > 0) { // Ignorer la première ligne
                $cells = $row->filter('td')->each(function (Crawler $cell) {
                    return trim($cell->text()); // Récupérer le texte de chaque cellule, en supprimant les espaces inutiles
                });

                // Ajouter la ligne au tableau, si elle contient des cellules
                if (!empty($cells)) {
                    $data[] = $cells;
                }
            }
        });

        return $data;
    }
}
