<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\State\Processor\IndustryJobsRetrieveCorporationPostProcessor;
use App\State\Processor\IndustryJobsRetrievePersonalPostProcessor;

//TODO : use serialization / deserialization groups
//TODO : use security
//TODO : use multiple user for personnal post processor
#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/industry/jobs/personal/retrieve',
            shortName: 'Industry',
            processor: IndustryJobsRetrievePersonalPostProcessor::class,
        ), // TODO: regroup the posts or a least duplicate code
        new Post(
            uriTemplate: '/industry/jobs/corporation/retrieve',
            shortName: 'Industry',
            processor: IndustryJobsRetrieveCorporationPostProcessor::class,
        ),
    ]
)]
class IndustryJobRetrieve
{
}
