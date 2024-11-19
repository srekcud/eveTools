<?php

namespace App\Message;


use App\Entity\IndustryJob;

class IdentifyIdMessage
{
    public function __construct(
        private readonly IndustryJob $job
    ) {}

    public function getJob(): IndustryJob
    {
        return $this->job;
    }

/*    public function getSenders(): ?array
    {
        return ['identify-id'];
    }*/
}
