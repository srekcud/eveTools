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
            uriTemplate: '/projects/{id}/link',
            openapi: new Operation(
                summary: 'Link ravworks and industry jobs',
                description: 'links ravworks and industry jobs to display them together afterward',
                parameters: [
                    new Parameter(
                        name: 'id',
                        in: 'path',
                        description: 'The project id',
                        required: true,
                        example: '22ee0813-ae21-4c0a-9067-207feda55522'
                    ),
                ],
            ),
            shortName: 'Project',
            processor: IndustryRavworksLinkPostProcessor::class,
        ),
        new GetCollection(
            uriTemplate: '/projects/{id}/details/{type}',
            openapi: new Operation(
                summary: 'Link ravworks and industry jobs',
                description: 'links ravworks and industry jobs to display them together afterward',
                parameters: [
                    new Parameter(
                        name: 'id',
                        in: 'path',
                        description: 'The project id',
                        required: true,
                        example: '22ee0813-ae21-4c0a-9067-207feda55522'
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
            paginationMaximumItemsPerPage: IndustryRavworksLink::MAX_ITEMS_PER_PAGE,
            provider: IndustryRavworksLinkCollectionProvider::class
        )
    ]
)]
class IndustryRavworksLink extends ApiResource
{
    public const int MAX_ITEMS_PER_PAGE = 10;

}
