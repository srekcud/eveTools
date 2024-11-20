<?php

namespace App\Service\Builder;

use App\Entity\RavworksJob;

class RavworksJobBuilder
{
    public function build($code, $type, $job): RavworksJob
    {
        return (new RavworksJob())
            ->setRavworksCode($code)
            ->setJobType($type)
            ->setName($job[1])
            ->setRun($job[2])
            ->setTime((float) $job[3])
            ->setJobCost((int) str_replace(',', '', $job[4]))
            ->setJobCount($job[5]);
    }
}
