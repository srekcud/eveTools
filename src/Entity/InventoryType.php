<?php

namespace App\Entity;

use App\Repository\InventoryTypeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'inventory_type')]
#[ORM\Entity(repositoryClass: InventoryTypeRepository::class)]
#[ORM\Index(name: 'it_name', columns: ['name'])]

class InventoryType
{
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, length: 10, unique: true, nullable: false)]
    private string $inventoryTypeId;
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, length: 250, unique: true, nullable: false)]
    private string $name;

    public function getInventoryTypeId()
    {
        return $this->inventoryTypeId;
    }

    /**
     * @return InventoryType
     */
    public function setInventoryTypeId($inventoryTypeId)
    {
        $this->inventoryTypeId = $inventoryTypeId;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return InventoryType
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
