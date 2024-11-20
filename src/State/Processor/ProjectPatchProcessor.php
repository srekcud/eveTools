<?php

namespace App\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\ApiResource\Project;
use App\Entity\Project as ProjectEntity;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class ProjectPatchProcessor implements ProcessorInterface
{
    public function __construct(
        private ProjectRepository      $projectRepository,
        private EntityManagerInterface $entityManager,
    )
    {
    }

    /**
     * @param Project $data
     * @param array $context
     */
    public function process($data, Operation $operation, array $uriVariables = [], array $context = []): ProjectEntity
    {
        if (!$project = $this->projectRepository->find($uriVariables['id'])) {
            throw new NotFoundHttpException();
        }

        $project->setName($data->name);
        $project->setRavworkId($data->ravworkId);

        $this->entityManager->flush();

        return $project;
    }

}