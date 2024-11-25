<?php

namespace App\Repository;

use App\Entity\Character;
use App\Entity\IndustryJob;
use App\Entity\IndustryRavworksLink;
use App\Entity\Project;
use App\Entity\RavworksJob;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class IndustryRavworksLinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IndustryRavworksLink::class);
    }

}
