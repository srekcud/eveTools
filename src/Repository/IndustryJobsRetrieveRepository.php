<?php

namespace App\Repository;

use App\Entity\IndustryJobsRetrieve;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class IndustryJobsRetrieveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IndustryJobsRetrieve::class);
    }
}
