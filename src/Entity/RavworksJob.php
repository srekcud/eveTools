<?php

namespace App\Entity;

use App\Repository\RavworksJobRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[ORM\Table(name: 'ravworks_job')]
#[ORM\Entity(repositoryClass: RavworksJobRepository::class)]
class RavworksJob
{
    //TODO : add a "display" column to handle manual fix for wrong ravwork run count
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private string $ravworksJobId;

    #[ORM\Column(type: Types::STRING, length: 10, unique: false, nullable: false)]
    //    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: "ravworksJobs")]
    //    #[ORM\JoinColumn(name: 'ravworks_code', referencedColumnName: 'ravworks_id', nullable: false)]
    private string $ravworksCode;

    #[ORM\Column(type: Types::STRING, length: 50, unique: false, nullable: false)]
    private string $jobType;
    #[ORM\Column(type: Types::STRING)]
    private string $name;
    #[ORM\Column(type: Types::INTEGER)]
    private int $run;
    #[ORM\Column(type: Types::INTEGER, nullable: true)]
    private ?int $me;
    #[ORM\Column(type: Types::FLOAT)]
    private float $time;
    #[ORM\Column(type: Types::BIGINT)]
    private int $jobCost;

    #[ORM\Column(type: Types::INTEGER)]
    private int $jobCount;

    #[ORM\Column(type: Types::BOOLEAN, nullable: false,options: ['default' => true])]
    private boolean $display;

    public function getRavworksJobId(): string
    {
        return $this->ravworksJobId;
    }

    public function setRavworksJobId(string $ravworksJobId): RavworksJob
    {
        $this->ravworksJobId = $ravworksJobId;

        return $this;
    }

    public function getRavworksCode(): string
    {
        return $this->ravworksCode;
    }

    public function setRavworksCode(string $ravworksCode): RavworksJob
    {
        $this->ravworksCode = $ravworksCode;

        return $this;
    }

    public function getJobType(): string
    {
        return $this->jobType;
    }

    public function setJobType(string $jobType): RavworksJob
    {
        $this->jobType = $jobType;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): RavworksJob
    {
        $this->name = $name;

        return $this;
    }

    public function getRun(): int
    {
        return $this->run;
    }

    public function setRun(int $run): RavworksJob
    {
        $this->run = $run;

        return $this;
    }

    public function getMe(): ?int
    {
        return $this->me;
    }

    public function setMe(?int $me): RavworksJob
    {
        $this->me = $me;

        return $this;
    }

    public function getTime(): float
    {
        return $this->time;
    }

    public function setTime(float $time): RavworksJob
    {
        $this->time = $time;

        return $this;
    }

    public function getJobCost(): int
    {
        return $this->jobCost;
    }

    public function setJobCost(int $jobCost): RavworksJob
    {
        $this->jobCost = $jobCost;

        return $this;
    }

    public function getJobCount(): int
    {
        return $this->jobCount;
    }

    public function setJobCount(int $jobCount): RavworksJob
    {
        $this->jobCount = $jobCount;

        return $this;
    }

    public function getDisplay(): bool
    {
        return $this->display;
    }

    public function setDisplay(bool $display): RavworksJob
    {
        $this->display = $display;
        return $this;
    }

}
