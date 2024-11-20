<?php

namespace App\Entity;

use App\Repository\IndustryActivityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'industry_activity')]
#[ORM\Entity(repositoryClass: IndustryActivityRepository::class)]
class IndustryActivity
{
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, length: 2, unique: true, nullable: false)]
    private int $IndustryActivityId;
    #[ORM\Column(type: Types::STRING, length: 50, unique: true, nullable: false)]
    private string $name;

    public function getIndustryActivityId(): int
    {
        return $this->IndustryActivityId;
    }

    public function setIndustryActivityId(int $IndustryActivityId): IndustryActivity
    {
        $this->IndustryActivityId = $IndustryActivityId;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): IndustryActivity
    {
        $this->name = $name;

        return $this;
    }
}
