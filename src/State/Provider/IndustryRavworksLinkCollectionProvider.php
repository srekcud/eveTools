<?php

namespace App\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\TraversablePaginator;
use ApiPlatform\State\ProviderInterface;
use App\ApiResource\Project;
use App\Repository\IndustryRavworksLinkRepository;
use App\Repository\ProjectRepository;
use App\Repository\RavworksJobRepository;
use App\Service\Builder\ProjectBuilder;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class IndustryRavworksLinkCollectionProvider implements ProviderInterface
{
    public function __construct(
        private readonly RavworksJobRepository  $ravworksJobRepository,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        if(! $irl = $this->ravworksJobRepository->getIRLByProjectIdAndJobType($uriVariables['id'], $uriVariables['type']))
        {
            throw new NotFoundHttpException("No projects found");
        }
        $page = $context['filters']['page'] ?? 1;

        return new TraversablePaginator(
            new ArrayCollection($irl),
            $page,
            Project::MAX_ITEMS_PER_PAGE,
            count($irl),
        );
    }
}
