<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\Parameter;
use App\State\Processor\ProjectPatchProcessor;
use App\State\Processor\ProjectPostProcessor;
use App\State\Provider\ProjectGetProvider;
use App\State\Provider\ProjectCollectionProvider;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    operations: [
        new GetCollection(
            paginationMaximumItemsPerPage: Project::MAX_ITEMS_PER_PAGE,
            provider: ProjectCollectionProvider::class
        ),
        new Get(
            uriTemplate: '/projects/{id}',
            openapi: new Operation(
                parameters: [
                    new Parameter(
                        name: 'id',
                        in: 'path',
                        description: 'The project id',
                        required: true,
                        example: 'def7c93a-2551-11ea-9fc5-0242ac750103'
                    ),
                ],
            ),
            provider: ProjectGetProvider::class,
        ),
        new Post(
            processor: ProjectPostProcessor::class,
        ),
        new Patch(
            uriTemplate: '/projects/{id}',
            openapi: new Operation(
                parameters: [
                    new Parameter(
                        name: 'id',
                        in: 'path',
                        description: 'The project id',
                        required: true,
                        example: 'def7c93a-2551-11ea-9fc5-0242ac750103'
                    ),
                ],
            ),
            provider: ProjectGetProvider::class,
            processor: ProjectPatchProcessor::class,
        ),
    ]
)]
class Project
{
    const int MAX_ITEMS_PER_PAGE = 20;
    public string $projectId;
    #[Assert\NotNull(message: 'Project name cannot be null')]
    #[Assert\NotBlank(message: 'Project name cannot be blank')]
    public string $name;
    #[Assert\NotNull(message: 'Ravwork ID cannot be null')]
    #[Assert\NotBlank(message: 'Ravwork ID cannot be blank')]
    public string $ravworkId;
}
