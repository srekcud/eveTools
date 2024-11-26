<?php

namespace App\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\IndustryRavworksLink;
use App\Entity\Project;
use App\Entity\RavworksJob;
use App\Message\IndustryRavworksLinkMessage;
use App\Repository\IndustryJobRepository;
use App\Repository\IndustryRavworksLinkRepository;
use App\Repository\ProjectRepository;
use App\Repository\RavworksJobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

readonly class IndustryRavworksLinkPostProcessor implements ProcessorInterface
{

    public function __construct(
        private ProjectRepository     $projectRepository,
        private RavworksJobRepository $ravworksJobRepository,
        private MessageBusInterface   $messageBus,
    )
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        //TODO : tenir compte des dates de création et de démarrage du projet pour éviter de relier les mauvaise id
        // + tenir compte de la contrainte d'unicité établie pour l'industry ID dans le link
        $i = 0;


        /** @var Project $project */
        $project = $this->projectRepository->findOneBy(['projectId' => $uriVariables['id']]);
        $rvJobs = $this->ravworksJobRepository->findBy(['ravworksCode' => $project->getRavworksId()]);
// pour chaque job rv du projet
// trouver tous les jobs indus potentiel qui ne sont pas deja associé
// Lier le nombre de job indus nécessaire au compte du job rv

        /** @var RavworksJob $rvJob */
        foreach ($rvJobs as $rvJob) {
            $message = new IndustryRavworksLinkMessage($rvJob);
            $this->messageBus->dispatch($message);
        }

        return $data;


    }
}
