<?php

namespace App\MessageHandler;

use App\Entity\RavworksStock;
use App\Message\RavworksStockMessage;
use App\Repository\RavworksStockRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class RavworksStockMessageHandler
{

    public function __construct(
        private EntityManagerInterface  $entityManager,
        private RavworksStockRepository $ravworksStockRepository,
    )
    {
    }


    public function __invoke(RavworksStockMessage $message): void
    {
        $stock = $message->getStock();

        if (!$this->ravworksStockRepository->findOneBy(
            [
                'ravworksCode' => $stock->getRavworksCode(),
                'name' => $stock->getName()
            ]
        )) {
            $this->entityManager->persist($stock);
            $this->entityManager->flush();

        }

    }

}