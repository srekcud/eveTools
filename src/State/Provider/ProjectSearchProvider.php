<?php

namespace App\State\Provider;


use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\ProjectRepository;
use App\Service\Builder\ProjectBuilder;

class ProjectSearchProvider implements ProviderInterface
{
    public function __construct(
        private readonly ProjectRepository $projectRepository,
        private ProjectBuilder             $projectBuilder,
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