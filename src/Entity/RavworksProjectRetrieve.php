<?php

namespace App\Entity;

use App\Repository\RavworksProjectRetrieveRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[ORM\Table(name: 'ravworks_project_retrieve')]
#[ORM\Entity(repositoryClass: RavworksProjectRetrieveRepository::class)]
class RavworksProjectRetrieve
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private string $ravworksProjectRetrieveId;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startDatetime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $creationDatetime = null;

    #[ORM\Column(nullable: true)]
    private array $errors = [];

    public function getRavworksProjectRetrieveId(): string
    {
        return $this->ravworksProjectRetrieveId;
    }

    public function setRavworksProjectRetrieveId(string $ravworksProjectRetrieveId): RavworksProjectRetrieve
    {
        $this->ravworksProjectRetrieveId = $ravworksProjectRetrieveId;

        return $this;
    }

    public function getStartDatetime(): ?\DateTimeInterface
    {
        return $this->startDatetime;
    }

    public function setStartDatetime(?\DateTimeInterface $startDatetime): RavworksProjectRetrieve
    {
        $this->startDatetime = $startDatetime;

        return $this;
    }

    public function getCreationDatetime(): ?\DateTimeInterface
    {
        return $this->creationDatetime;
    }

    public function setCreationDatetime(?\DateTimeInterface $creationDatetime): RavworksProjectRetrieve
    {
        $this->creationDatetime = $creationDatetime;

        return $this;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(array $errors): RavworksProjectRetrieve
    {
        $this->errors = $errors;

        return $this;
    }
}
