<?php

namespace App\Entity;

use App\Repository\FacilityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'facility')]
#[ORM\Entity(repositoryClass: FacilityRepository::class)]
#[ORM\Index(name: 'f_name', columns: ['name'])]

class Facility
{
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, length: 250, unique: true, nullable: false)]
    private string $facilityId;
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, length: 250, unique: true, nullable: false)]
    private string $name;

    public function getFacilityId() : string
    {
        return $this->facilityId;
    }

    public function setFacilityId($facilityId) : Facility
    {
        $this->facilityId = $facilityId;

        return $this;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName($name) : Facility
    {
        $this->name = $name;

        return $this;
    }
}
