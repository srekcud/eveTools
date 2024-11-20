<?php

namespace App\MessageHandler;

use App\Message\RavworksJobMessage;
use App\Repository\RavworksJobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class RavworksJobMessageHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private RavworksJobRepository $ravworksJobRepository,
    ) {
    }

    public function __invoke(RavworksJobMessage $message): void
    {
        $job = $message->getJob();

        if (!$this->ravworksJobRepository->findOneBy(
            [
                'ravworksCode' => $job->getRavworksCode(),
                'jobType' => $job->getJobType(),
                'name' => $job->getName(),
                'run' => $job->getRun(),
                'jobCount' => $job->getJobCount(),
            ]
        )) {
            $this->entityManager->persist($job);
            $this->entityManager->flush();
        }
    }
}
