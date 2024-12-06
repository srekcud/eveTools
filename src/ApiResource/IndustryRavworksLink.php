<?php

namespace App\ApiResource;


use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\Parameter;
use App\State\Processor\IndustryRavworksLinkPostProcessor;
use App\State\Provider\IndustryRavworksLinkCollectionProvider;

#[ApiResource(
    operations: [
        new Post(
            uriTemplate: '/projects/{code}/link',
            openapi: new Operation(
                summary: 'Link ravworks and industry jobs',
                description: 'links ravworks and industry jobs to display them together afterward',
                parameters: [
                    new Parameter(
                        name: 'code',
                        in: 'path',
                        description: 'The project ravworks id',
                        required: true,
                        example: 'j0oHgrO'
                    ),
                ],
            ),
            shortName: 'Project',
            processor: IndustryRavworksLinkPostProcessor::class,
        ),
        new GetCollection(
            uriTemplate: '/projects/{code}/details/{type}',
            openapi: new Operation(
                summary: 'give detailled element of a project',
                description: 'give detailled element of a project',
                parameters: [
                    new Parameter(
                        name: 'code',
                        in: 'path',
                        description: 'The project ravworks id',
                        required: true,
                        example: 'j0oHgrO'
                    ),
                    new Parameter(
                        name: 'type',
                        in: 'path',
                        description: 'The job type',
                        required: true,
                        example: 'firstStageReaction',
                    ),
                ],
            ),
            shortName: 'Project',
            paginationEnabled: false,
            provider: IndustryRavworksLinkCollectionProvider::class
        )
    ]
)]
class IndustryRavworksLink extends ApiResource
{
    public const int MAX_ITEMS_PER_PAGE = 10;

}
