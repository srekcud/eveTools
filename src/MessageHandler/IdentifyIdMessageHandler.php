<?php

namespace App\MessageHandler;

use App\Entity\Character;
use App\Entity\IndustryJob;
use App\Entity\InventoryType;
use App\Message\IdentifyIdMessage;
use App\Repository\CharacterRepository;
use App\Repository\InventoryTypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsMessageHandler]
class IdentifyIdMessageHandler
{
    public const string INVENTORY_TYPE = 'inventory_type';
    public const string CHARACTER = 'character';

    public function __construct(
        private readonly HttpClientInterface $eveEsiClient,
        private readonly InventoryTypeRepository $inventoryTypeRepository,
        private readonly CharacterRepository $characterRepository,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function __invoke(IdentifyIdMessage $message): void
    {
        // TODO : mettre ca dans une procedure ?
        $job = $message->getJob();
        $blueprintExist = $this->inventoryTypeRepository->findOneBy(['inventoryTypeId' => $job->getBlueprintTypeId()]);
        $characterExist = $this->characterRepository->findOneBy(['characterId' => $job->getInstallerId()]);
        // TODO: Add facility_id (/universe/structures/{structure_id}/) + output_location_id (/corporations/{corporation_id}/assets/names/ )
        if (!$blueprintExist || !$characterExist) {
            $nameAndType = $this->getNameAndTypeFromId($job);

            foreach ($nameAndType as $item) {
                switch ($item['category']) {
                    case self::INVENTORY_TYPE:
                        if (!$blueprintExist) {
                            $inventoryType = new InventoryType();
                            $inventoryType->setInventoryTypeId($item['id'])
                                ->setName($item['name']);
                            $this->entityManager->persist($inventoryType);
                        }
                        break;
                    case self::CHARACTER:
                        if (!$characterExist) {
                            $character = new Character();
                            $character->setCharacterId($item['id'])
                                ->setName($item['name']);

                            $this->entityManager->persist($character);
                        }
                        break;
                }
                $this->entityManager->flush();
            }
        }
    }

    public function getNameAndTypeFromId(IndustryJob $job): array
    {
        $URI = 'universe/names/?datasource=tranquility';

        $response = $this->eveEsiClient->request(
            'POST', $URI,
            [
                'body' => '['.$job->getBlueprintTypeId().','.$job->getInstallerId().']',
            ]
        )->toArray();

        return $response;
    }
}
