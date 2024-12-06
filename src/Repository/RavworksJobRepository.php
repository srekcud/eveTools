<?php

namespace App\Repository;

use App\Entity\Character;
use App\Entity\IndustryJob;
use App\Entity\IndustryRavworksLink;
use App\Entity\Project;
use App\Entity\RavworksJob;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RavworksJobRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RavworksJob::class);
    }

    public function getIRLByProjectRVIdAndJobType($code, $type)
    {
        return $this->createQueryBuilder('rj')
            ->select('rj.name,rj.jobCount,rj.run,ij.cost,c.name as character,ij.startDatetime,ij.endDatetime,coalesce(ij.status,\'not started\') as status')
            ->leftJoin(IndustryRavworksLink::class, 'irl', 'WITH', 'rj.ravworksJobId = irl.ravworksJobId')
            ->leftJoin(Project::class, 'p', 'WITH', 'rj.ravworksCode = p.ravworksId')
            ->leftJoin(IndustryJob::class, 'ij', 'WITH', 'irl.industryJobId = ij.industryJobId')
            ->leftJoin(Character::class, 'c', 'WITH', 'ij.installerId = c.characterId')
            ->Where('p.ravworksId = :code')
            ->andWhere('rj.jobType = :type')
            ->andWhere('rj.display = true')
            ->orderBy('ij.startDatetime', 'ASC')
            ->addOrderBy('status', 'ASC')
            ->setParameter('code', $code)
            ->setParameter('type', $type)
            ->getQuery()
            ->getResult();

    }
}
