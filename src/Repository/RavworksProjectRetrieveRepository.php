<?php

namespace App\Repository;

use App\Entity\RavworksProjectRetrieve;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RavworksProjectRetrieveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RavworksProjectRetrieve::class);
    }
}