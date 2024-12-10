<?php

namespace App\Repository;

use App\Entity\IndustryJob;
use App\Entity\IndustryRavworksLink;
use App\Entity\InventoryType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

class IndustryJobRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IndustryJob::class);
    }

    /** @return IndustryJob [] */
    public function getPotentialIndustryJobsByNameAndRunsAndStartDatetime($name, $runs, $start): array
    {
        $qb = $this->createQueryBuilder('q');

        $sub = $qb->select('irl.industryJobId')->from(IndustryRavworksLink::class, 'irl');

        return $this->createQueryBuilder('industryJob')
            ->innerJoin(InventoryType::class, 'it', 'WITH', 'industryJob.blueprintTypeId = it.inventoryTypeId')
            ->Where('it.name = :name')
            ->AndWhere('industryJob.runs = :runs')
            ->AndWhere('industryJob.startDatetime >= :start')
            ->AndWhere('industryJob.activityId = \'1\'')
            ->AndWhere($qb->expr()->notIn('industryJob.industryJobId', $sub->getDQL()))
            ->OrderBy('industryJob.startDatetime', 'ASC')
            ->setParameter('name', $name)
            ->setParameter('runs', $runs)
            ->setParameter('start', $start)
            ->getQuery()
            ->getResult();
    }
}
