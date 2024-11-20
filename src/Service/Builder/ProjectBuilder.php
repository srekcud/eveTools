<?php

namespace App\Service\Builder;

use App\ApiResource\Project;
use App\Entity\Project as ProjectEntity;

class ProjectBuilder
{
    public function buildFromEntity(ProjectEntity $project): Project
    {
        $projectApi = new Project();
        $projectApi->projectId = $project->getProjectId();
        $projectApi->name = $project->getName();
        $projectApi->ravworkId = $project->getRavworksId();

        return $projectApi;
    }

    public function buildFromApiResource(Project $data): ProjectEntity
    {
        $project = new ProjectEntity();

        $project->setName($data->name);
        $project->setRavworksId($data->ravworkId);


        return $project;
    }

}