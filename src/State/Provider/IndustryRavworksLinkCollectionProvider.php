<?php

namespace App\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\TraversablePaginator;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Project;
use App\Entity\IndustryRavworksLink;
use App\Entity\RavworksJob;
use App\Repository\IndustryJobRepository;
use App\Repository\IndustryRavworksLinkRepository;
use App\Repository\ProjectRepository;
use App\Repository\RavworksJobRepository;
use App\Service\Builder\ProjectBuilder;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class IndustryRavworksLinkCollectionProvider implements ProviderInterface
{
    public function __construct(
        private readonly RavworksJobRepository $ravworksJobRepository,
        private IndustryRavworksLinkRepository $industryRavworksLinkRepository,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        // todo : remove pagination since it's not correctly used
        if(! $irl = $this->ravworksJobRepository->getIRLByProjectRVIdAndJobType($uriVariables['code'], $uriVariables['type']))
        {
            return new TraversablePaginator(
                new ArrayCollection([]),
                1,
                Project::MAX_ITEMS_PER_PAGE,
                0,
            );
        }
        $page = $context['filters']['page'] ?? 1;

        $p = [];
        $ids = [];
        foreach($irl as $item)
        {
            $rvID = $item['ravworksJobId']->toString();
            if(in_array($rvID, $ids)){
                continue;
            }else{
                $ids[] = $rvID;
            }
            $c = count($this->industryRavworksLinkRepository->findBy(['ravworksJobId'=>$rvID]));
            /** @var RavworksJob $rvjob */
            $rvjob = $this->ravworksJobRepository->findOneBy(['ravworksJobId'=>$rvID]);

            ($item['status'] == 'not Started')? $minus = 1:$minus = 0; //TODO: put not started tring in a CONST

            while($c < ($rvjob->getJobCount() - $minus)){
                $c++;
                $p[] = [
                    "ravworksJobId" => $rvID,
                    "name" => $rvjob->getName(),
                    "run" => $rvjob->getRun(),
                    "status" => "not started"
                ];
            }

        }

        $irl = array_merge($irl, $p);
        usort($irl, fn($a, $b) => strcmp($a['name'], $b['name']));

        return new TraversablePaginator(
            new ArrayCollection($irl),
            $page,
            Project::MAX_ITEMS_PER_PAGE,
            count($irl),
        );
    }
}
