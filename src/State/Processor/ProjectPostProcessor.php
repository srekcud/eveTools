<?php

namespace App\State\Processor;


use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\ApiResource\Project;
use App\Entity\Project as ProjectEntity;
use App\Service\Builder\ProjectBuilder;
use Doctrine\ORM\EntityManagerInterface;

readonly class ProjectPostProcessor implements ProcessorInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ProjectBuilder         $projectBuilder,
    ){}

    /**
     * @param Project $data
     * @param array $context
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): ProjectEntity
    {
        $project = $this->projectBuilder->buildFromApiResource($data);

        $this->entityManager->persist($project);
        $this->entityManager->flush();

        return $project;
    }
}
