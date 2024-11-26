<?php

namespace App\MessageHandler;

use App\Entity\IndustryRavworksLink;
use App\Message\IndustryRavworksLinkMessage;
use App\Message\RavworksStockMessage;
use App\Repository\IndustryJobRepository;
use App\Repository\ProjectRepository;
use App\Repository\RavworksStockRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class IndustryRavworksLinkMessageHandler
{
    public const int BATCH_FLUSH = 100;
    public function __construct(
        private EntityManagerInterface $entityManager,
        private IndustryJobRepository $industryJobRepository,
        private ProjectRepository $projectRepository,
//        private RavworksStockRepository $ravworksStockRepository,
    ) {
    }

    public function __invoke(IndustryRavworksLinkMessage $message): void
    {
        $rvJob = $message->getRvJob();
        $project = $this->projectRepository->findOneBy(['ravworksId' => $rvJob->getRavworksCode()]);

        $i = 0;
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
        $this->entityManager->flush();
    }
}
