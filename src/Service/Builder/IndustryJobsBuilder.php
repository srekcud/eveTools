<?php

namespace App\Service\Builder;

use App\Entity\IndustryJob;

class IndustryJobsBuilder
{
    public function build($data): IndustryJob
    {
        if (isset($data['completed_date'])) {
            $completedDate = new \DateTimeImmutable($data['completed_date']);
            $successfulRuns = $data['successful_runs'];
        } else {
            $completedDate = null;
            $successfulRuns = null;
        }

        return (new IndustryJob())
            ->setIndustryJobId($data['job_id'])
            ->setOutputLocationId($data['output_location_id'])
            ->setActivityId($data['activity_id'])
            ->setBlueprintTypeId($data['blueprint_type_id'])
            ->setRuns($data['runs'])
            ->setDuration($data['duration'])
            ->setInstallerId($data['installer_id'])
            ->setCost($data['cost'])
            ->setStartDatetime(new \DateTimeImmutable($data['start_date']))
            ->setEndDatetime(new \DateTimeImmutable($data['end_date']))
            ->setCompletedDatetime($completedDate)
            ->setFacilityId($data['facility_id'])
            ->setProbability($data['probability'])
            ->setSuccessful($successfulRuns)
            ->setStatus($data['status']);
    }
}
