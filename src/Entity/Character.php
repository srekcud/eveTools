<?php

namespace App\Entity;

use App\Repository\CharacterRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\table(name: 'character')]
#[ORM\Entity(repositoryClass: CharacterRepository::class)]
class Character
{
    #[ORM\Id]
    #[ORM\Column(type: Types::STRING, length: 15, unique:true, nullable: false)]
    private string $characterId;
    #[ORM\Column(type: Types::STRING, length: 250, unique:true, nullable: false)]
    private string $name;
    #[ORM\Column(type: Types::STRING, length: 1024, nullable: true)]
    private ?string $refreshToken;

    public function getCharacterId() : string
    {
        return $this->characterId;
    }

    public function setCharacterId(string $characterId) : Character
    {
        $this->characterId = $characterId;
        return $this;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : Character
    {
        $this->name = $name;
        return $this;
    }

    public function getRefreshToken() : string
    {
        return $this->refreshToken;
    }

    public function setRefreshToken(?string $refreshToken) : Character
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }




}
