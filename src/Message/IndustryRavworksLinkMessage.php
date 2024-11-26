<?php

namespace App\Message;

use App\Entity\IndustryRavworksLink;
use App\Entity\RavworksJob;

class IndustryRavworksLinkMessage
{
    public function __construct(
        private readonly RavworksJob $rvJob,
    ) {
    }

    public function getRvJob(): RavworksJob
    {
        return $this->rvJob;
    }
}
