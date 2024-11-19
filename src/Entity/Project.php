<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[ORM\table(name: 'project')]
#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private string $projectid;

    #[ORM\Column(type: Types::STRING, length: 255,nullable: true)]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 10, nullable: true)]
    private ?string $ravworkId;

    public function getProjectid(): string
    {
        return $this->projectid;
    }

    public function setProjectid(string $projectid): Project
    {
        $this->projectid = $projectid;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Project
    {
        $this->name = $name;
        return $this;
    }

    public function getRavworkId(): ?string
    {
        return $this->ravworkId;
    }

    public function setRavworkId(?string $ravworkId): Project
    {
        $this->ravworkId = $ravworkId;
        return $this;
    }



}



