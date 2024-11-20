<?php

namespace App\Message;

use App\Entity\RavworksJob;

class RavworksJobMessage
{
    public function __construct(
        private readonly RavworksJob $job,
    ) {
    }

    public function getJob(): RavworksJob
    {
        return $this->job;
    }
}
