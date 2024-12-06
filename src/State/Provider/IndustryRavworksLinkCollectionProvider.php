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
        // todo : remove pagination since it's not correctly used
        if(! $irl = $this->ravworksJobRepository->getIRLByProjectRVIdAndJobType($uriVariables['code'], $uriVariables['type']))
        {
            return new TraversablePaginator(
                new ArrayCollection([]),
                1,
                Project::MAX_ITEMS_PER_PAGE,
                0,
            );
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
