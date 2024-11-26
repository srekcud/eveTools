<?php

namespace App\Entity;

use App\Repository\IndustryJobRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'industry_job')]
#[ORM\Entity(repositoryClass: IndustryJobRepository::class)]
#[ORM\Index(name: 'ij_start_datetime', columns: ['start_datetime'])]
class IndustryJob
{
    #[ORM\Id]
    #[ORM\Column(type: Types::BIGINT, unique: true, nullable: false)]
    private int $industryJobId;
    #[ORM\Column(type: Types::STRING, length: 50, nullable: false)]
    private string $outputLocationId;
    #[ORM\Column(type: Types::STRING, length: 50, nullable: false)]
    private string $activityId;
    #[ORM\Column(type: Types::STRING, length: 50, nullable: false)]
    private string $blueprintTypeId;
    // TODO: ADD product ID pour avoir le produit fini du job
    #[ORM\Column(type: Types::INTEGER, nullable: false)]
    private int $runs;
    #[ORM\Column(type: Types::BIGINT, nullable: false)]
    private int $duration;
    #[ORM\Column(type: Types::STRING, length: 15, nullable: false)]
    private string $installerId;
    #[ORM\Column(type: Types::BIGINT, nullable: false)]
    private int $cost;
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $startDatetime;
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE)]
    private \DateTimeImmutable $endDatetime;
    #[ORM\Column(type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $completedDatetime;
    #[ORM\Column(type: Types::STRING, length: 50, nullable: false)]
    private string $facilityId;
    #[ORM\Column(type: Types::FLOAT, nullable: false)]
    private float $probability;
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $successful;
    #[ORM\Column(type: Types::STRING, nullable: false)]
    private string $status;

    public function getIndustryJobId(): int
    {
        return $this->industryJobId;
    }

    public function setIndustryJobId(int $industryJobId): IndustryJob
    {
        $this->industryJobId = $industryJobId;

        return $this;
    }

    public function getOutputLocationId(): string
    {
        return $this->outputLocationId;
    }

    public function setOutputLocationId(string $outputLocationId): IndustryJob
    {
        $this->outputLocationId = $outputLocationId;

        return $this;
    }

    public function getActivityId(): string
    {
        return $this->activityId;
    }

    public function setActivityId(string $activityId): IndustryJob
    {
        $this->activityId = $activityId;

        return $this;
    }

    public function getBlueprintTypeId(): string
    {
        return $this->blueprintTypeId;
    }

    public function setBlueprintTypeId(string $blueprintTypeId): IndustryJob
    {
        $this->blueprintTypeId = $blueprintTypeId;

        return $this;
    }

    public function getRuns(): int
    {
        return $this->runs;
    }

    public function setRuns(int $runs): IndustryJob
    {
        $this->runs = $runs;

        return $this;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): IndustryJob
    {
        $this->duration = $duration;

        return $this;
    }

    public function getInstallerId(): string
    {
        return $this->installerId;
    }

    public function setInstallerId(string $installerId): IndustryJob
    {
        $this->installerId = $installerId;

        return $this;
    }

    public function getCost(): int
    {
        return $this->cost;
    }

    public function setCost(int $cost): IndustryJob
    {
        $this->cost = $cost;

        return $this;
    }

    public function getStartDatetime(): \DateTimeImmutable
    {
        return $this->startDatetime;
    }

    public function setStartDatetime(\DateTimeImmutable $startDatetime): IndustryJob
    {
        $this->startDatetime = $startDatetime;

        return $this;
    }

    public function getEndDatetime(): \DateTimeImmutable
    {
        return $this->endDatetime;
    }

    public function setEndDatetime(\DateTimeImmutable $endDatetime): IndustryJob
    {
        $this->endDatetime = $endDatetime;

        return $this;
    }

    public function getCompletedDatetime(): ?\DateTimeImmutable
    {
        return $this->completedDatetime;
    }

    public function setCompletedDatetime(?\DateTimeImmutable $completedDatetime): IndustryJob
    {
        $this->completedDatetime = $completedDatetime;

        return $this;
    }

    public function getFacilityId(): string
    {
        return $this->facilityId;
    }

    public function setFacilityId(string $facilityId): IndustryJob
    {
        $this->facilityId = $facilityId;

        return $this;
    }

    public function getProbability(): float
    {
        return $this->probability;
    }

    public function setProbability(float $probability): IndustryJob
    {
        $this->probability = $probability;

        return $this;
    }

    public function getSuccessful(): ?int
    {
        return $this->successful;
    }

    public function setSuccessful(?int $successful): IndustryJob
    {
        $this->successful = $successful;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): IndustryJob
    {
        $this->status = $status;

        return $this;
    }
}
