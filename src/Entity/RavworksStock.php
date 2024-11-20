<?php

namespace App\Entity;

use App\Repository\RavworksStockRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[ORM\Table(name: 'ravworks_stock')]
#[ORM\Entity(repositoryClass: RavworksStockRepository::class)]
class RavworksStock
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private string $ravworksStockId;

    #[ORM\Column(type: Types::STRING, length: 10, unique: false, nullable: false)]
    #[ORM\ManyToOne(targetEntity: Project::class, inversedBy: 'ravworksStocks')]
    #[ORM\JoinColumn(name: 'ravworks_code', referencedColumnName: 'ravworks_id', nullable: false)]
    private string $ravworksCode;
    #[ORM\Column(type: Types::STRING)]
    private string $name;
    #[ORM\Column(type: Types::INTEGER)]
    private int $toBuy;
    #[ORM\Column(type: Types::BIGINT)]
    private int $toBuyValue;
    #[ORM\Column(type: Types::FLOAT)]
    private float $toBuyVolume;
    #[ORM\Column(type: Types::BIGINT)]
    private int $startAmount;
    #[ORM\Column(type: Types::BIGINT, nullable: false)]
    private int $endAmount;

    public function getRavworksStockId(): string
    {
        return $this->ravworksStockId;
    }

    public function setRavworksStockId(string $ravworksStockId): RavworksStock
    {
        $this->ravworksStockId = $ravworksStockId;

        return $this;
    }

    public function getRavworksCode(): string
    {
        return $this->ravworksCode;
    }

    public function setRavworksCode(string $ravworksCode): RavworksStock
    {
        $this->ravworksCode = $ravworksCode;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): RavworksStock
    {
        $this->name = $name;

        return $this;
    }

    public function getToBuy(): int
    {
        return $this->toBuy;
    }

    public function setToBuy(int $toBuy): RavworksStock
    {
        $this->toBuy = $toBuy;

        return $this;
    }

    public function getToBuyValue(): int
    {
        return $this->toBuyValue;
    }

    public function setToBuyValue(int $toBuyValue): RavworksStock
    {
        $this->toBuyValue = $toBuyValue;

        return $this;
    }

    public function getToBuyVolume(): float
    {
        return $this->toBuyVolume;
    }

    public function setToBuyVolume(float $toBuyVolume): RavworksStock
    {
        $this->toBuyVolume = $toBuyVolume;

        return $this;
    }

    public function getStartAmount(): int
    {
        return $this->startAmount;
    }

    public function setStartAmount(int $startAmount): RavworksStock
    {
        $this->startAmount = $startAmount;

        return $this;
    }

    public function getEndAmount(): int
    {
        return $this->endAmount;
    }

    public function setEndAmount(int $endAmount): RavworksStock
    {
        $this->endAmount = $endAmount;

        return $this;
    }
}
