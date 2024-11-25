<?php

namespace App\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\ProjectRepository;
use App\Service\Builder\ProjectBuilder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class ProjectGetProvider implements ProviderInterface
{
    public function __construct(
        private ProjectRepository $projectRepository,
//        private ProjectBuilder $projectBuilder,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if (!$project = $this->projectRepository->find($uriVariables['id'])) {
            throw new NotFoundHttpException();
        }

        return $project;
    }
}
