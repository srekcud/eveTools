<?php

namespace App\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\RavworksJob;
use App\Message\IndustryRavworksLinkMessage;
use App\Repository\RavworksJobRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;

readonly class IndustryRavworksLinkPostProcessor implements ProcessorInterface
{

    public function __construct(
        private RavworksJobRepository $ravworksJobRepository,
        private MessageBusInterface   $messageBus,
    )
    {
    }

    /**
     * @param array<string, mixed>&array{request?: Request, previous_data?: mixed, resource_class?: string|null, original_data?: mixed} $context
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        //TODO : tenir compte des dates de création et de démarrage du projet pour éviter de relier les mauvaise id
        // + tenir compte de la contrainte d'unicité établie pour l'industry ID dans le link
        $i = 0;

        //TODO : recheck when we need other activity then manufacturing here
        $rvJobs = $this->ravworksJobRepository->findBy(['ravworksCode' => $uriVariables['code'],'display'=>true]);
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
