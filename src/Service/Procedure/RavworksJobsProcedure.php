<?php

namespace App\Service\Procedure;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class RavworksJobsProcedure
{
    public function __construct(
        private readonly HttpClientInterface $esCLient,
        private readonly RavworksJobsBuilder $ravworksJobsBuilder,
        private readonly RavworksJobsRepository $ravworksJobsRepository
    )
    {
    }

    public function process()
    {

    }
}