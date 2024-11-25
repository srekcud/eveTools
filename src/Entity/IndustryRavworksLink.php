<?php

namespace App\Entity;

use App\Repository\IndustryRavworksLinkRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[ORM\Table(name: 'industry_ravworks_link')]
#[ORM\Entity(repositoryClass: IndustryRavworksLinkRepository::class)]
class IndustryRavworksLink
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private string $industryRavworksLinkId;

    #[ORM\Column(type: Types::BIGINT, unique:true, nullable: false)]
    private int $industryJobId;

    #[ORM\Column(type: 'uuid', nullable: false)]
    private string $ravworksJobId;

    public function getIndustryRavworksLinkId(): string
    {
        return $this->industryRavworksLinkId;
    }

    public function setIndustryRavworksLinkId(string $industryRavworksLinkId): IndustryRavworksLink
    {
        $this->industryRavworksLinkId = $industryRavworksLinkId;
        return $this;
    }

    public function getIndustryJobId(): int
    {
        return $this->industryJobId;
    }

    public function setIndustryJobId(int $industryJobId): IndustryRavworksLink
    {
        $this->industryJobId = $industryJobId;
        return $this;
    }

    public function getRavworksJobId(): string
    {
        return $this->ravworksJobId;
    }

    public function setRavworksJobId(string $ravworksJobId): IndustryRavworksLink
    {
        $this->ravworksJobId = $ravworksJobId;
        return $this;
    }


}
