<?php

namespace App\State\Provider;


use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\ProjectRepository;
use App\Service\Builder\ProjectBuilder;

readonly class ProjectCollectionProvider implements ProviderInterface
{
    public function __construct(
        private readonly ProjectRepository $projectRepository,
//        private readonly ProjectBuilder             $projectBuilder,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $projects = $this->projectRepository->findAll();
        $page = $context['filters']['page'] ?? 1;

        print_r($page);
        print_r($projects);die();
    }
}