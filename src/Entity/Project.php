<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use DateTimeInterface;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[ORM\Table(name: 'project')]
#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{

    // TODO : add a check of the role to avoid that everybody can add a new industrial project
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private string $projectId;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 10, nullable: true)]
    private ?string $ravworksId;

    #[ORM\Column(type: Types::JSON, nullable: true)]
    private ?array $json;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $startDatetime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?DateTimeInterface $creationDatetime = null;

    public function getProjectId(): string
    {
        return $this->projectId;
    }

    public function setProjectId(string $projectId): Project
    {
        $this->projectId = $projectId;

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

    public function getRavworksId(): ?string
    {
        return $this->ravworksId;
    }

    public function setRavworksId(?string $ravworksId): Project
    {
        $this->ravworksId = $ravworksId;

        return $this;
    }

    public function getStartDatetime(): ?DateTimeInterface
    {
        return $this->startDatetime;
    }

    public function setStartDatetime(?DateTimeInterface $startDatetime): Project
    {
        $this->startDatetime = $startDatetime;
        return $this;
    }

    public function getCreationDatetime(): ?DateTimeInterface
    {
        return $this->creationDatetime;
    }

    public function setCreationDatetime(?DateTimeInterface $creationDatetime): Project
    {
        $this->creationDatetime = $creationDatetime;
        return $this;
    }

    public function getJson(): ?array
    {
        return $this->json;
    }

    public function setJson(?array $json): Project
    {
        $this->json = $json;
        return $this;
    }

}
