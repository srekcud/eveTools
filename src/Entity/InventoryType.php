<?php

namespace App\Entity;

use App\Repository\InventoryTypeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\table(name: 'inventory_type')]
#[ORM\Entity(repositoryClass: InventoryTypeRepository::class)]
class InventoryType
{
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, length: 10, unique:true, nullable: false)]
    private string $inventoryTypeId;
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, length: 250, unique:true, nullable: false)]
    private string $name;

    /**
     * @return mixed
     */
    public function getInventoryTypeId()
    {
        return $this->inventoryTypeId;
    }

    /**
     * @param mixed $inventoryTypeId
     * @return InventoryType
     */
    public function setInventoryTypeId($inventoryTypeId)
    {
        $this->inventoryTypeId = $inventoryTypeId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return InventoryType
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


}
