<?php

namespace App\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\IndustryRavworksLink;
use App\Entity\Project;
use App\Entity\RavworksJob;
use App\Repository\IndustryJobRepository;
use App\Repository\IndustryRavworksLinkRepository;
use App\Repository\ProjectRepository;
use App\Repository\RavworksJobRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class IndustryRavworksLinkPostProcessor implements ProcessorInterface
{
    public const int BATCH_FLUSH = 100;

    public function __construct(
        private ProjectRepository              $projectRepository,
        private RavworksJobRepository          $ravworksJobRepository,
        private IndustryJobRepository          $industryJobRepository,
        private IndustryRavworksLinkRepository $industryRavworksLinkRepository,
        private EntityManagerInterface         $entityManager,
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
            $j = 0;
            $industryJobs = $this->industryJobRepository->getPotentialIndustryJobsByNameAndRunsAndStartDatetime($rvJob->getName(), $rvJob->getRun(), $project->getStartDatetime());
            while (count($industryJobs) > 0 && $j < $rvJob->getJobCount()) {

                $irl = new IndustryRavworksLink();
                $irl->setIndustryJobId(array_shift($industryJobs)->getIndustryJobId())
                    ->setRavworksJobId($rvJob->getRavworksJobId());

                $this->entityManager->persist($irl);
                if (0 === $i++ % self::BATCH_FLUSH) {
                    $this->entityManager->flush();
                }
                $j++;

            }
//
//                            $this->entityManager->persist($irl);
//
//                            if (0 === $i++ % self::BATCH_FLUSH) {
//                                $this->entityManager->flush();
//                            }
//
//                        }
//                    }
//
//                }
//
//
//            }

        }

        $this->entityManager->flush();

    }
}
