<?php

namespace App\Entity;

use App\Repository\IndustryJobsRetrieveRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[ORM\Table(name: 'industry_job_retrieve')]
#[ORM\Entity(repositoryClass: IndustryJobsRetrieveRepository::class)]
class IndustryJobsRetrieve
{
    public const string POST = 'INDUSTRY_JOB_RETRIEVE_POST';

    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private string $industryJobsRetrieveId;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startDatetime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $creationDatetime = null;

    #[ORM\Column(nullable: true)]
    private array $errors = [];

    public function getIndustryJobsRetrieveId(): ?string
    {
        return $this->industryJobsRetrieveId;
    }

    public function setIndustryJobsRetrieveId(string $industryJobsRetrieveId): IndustryJobsRetrieve
    {
        $this->industryJobsRetrieveId = $industryJobsRetrieveId;

        return $this;
    }

    public function getStartDatetime(): ?\DateTimeInterface
    {
        return $this->startDatetime;
    }

    public function setStartDatetime(\DateTimeInterface $startDatetime): self
    {
        $this->startDatetime = $startDatetime;

        return $this;
    }

    public function getCreationDatetime(): ?\DateTimeInterface
    {
        return $this->creationDatetime;
    }

    public function setCreationDatetime(?\DateTimeInterface $creationDatetime): self
    {
        $this->creationDatetime = $creationDatetime;

        return $this;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(?array $errors): self
    {
        $this->errors = $errors;

        return $this;
    }
}
