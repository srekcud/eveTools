<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\Parameter;
use App\State\Processor\RavworksProjectRetrievePostProcessor;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/ravworks/project/{code}/retrieve',
            openapi: new Operation(
                parameters: [
                    new Parameter(
                        name: 'code',
                        in: 'path',
                        description: 'The project id',
                        required: true,
                        example: 'o5cr6aE'
                    ),
                ],
            ),
            shortName: 'Ravworks',
            processor: RavworksProjectRetrievePostProcessor::class,
        ),
    ]
)]
class RavworksProjectRetrieve
{
}
