<?php

namespace App\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\TraversablePaginator;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Project;
use App\Repository\ProjectRepository;
use App\Service\Builder\ProjectBuilder;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class ProjectCollectionProvider implements ProviderInterface
{
    public function __construct(
        private readonly ProjectRepository $projectRepository,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $page = $context['filters']['page'] ?? 1;
        if(! $projects = $this->projectRepository->findBy([],['startDatetime' => 'ASC','name'=>'ASC'],Project::MAX_ITEMS_PER_PAGE,(($page - 1) * Project::MAX_ITEMS_PER_PAGE)))
        {
            throw new NotFoundHttpException("No projects found");
        }
        $totalItems = count($this->projectRepository->findAll());


        return new TraversablePaginator(
            new ArrayCollection($projects),
            $page,
            Project::MAX_ITEMS_PER_PAGE,
            $totalItems,
        );
    }
}
