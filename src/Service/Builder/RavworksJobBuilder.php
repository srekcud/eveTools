<?php

namespace App\Service\Builder;

use App\Entity\RavworksJob;

class RavworksJobBuilder
{
    public function build($code, $type, $job): RavworksJob
    {
        $return = new RavworksJob();
        if ('endProductJob' == $type) {
            $return->setRavworksCode($code)
                ->setJobType($type)
                ->setName($job[1])
                ->setRun($job[2])
                ->setMe($job[3])
                ->setTime((float) $job[4])
                ->setJobCost((int) str_replace(',', '', $job[5]))
                ->setJobCount($job[6]);
        } else {
            $return->setRavworksCode($code)
                ->setJobType($type)
                ->setName($job[1])
                ->setRun($job[2])
                ->setMe(null)
                ->setTime((float) $job[3])
                ->setJobCost((int) str_replace(',', '', $job[4]))
                ->setJobCount($job[5]);
        }

        return $return;
    }
}
