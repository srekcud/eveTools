<?php

namespace App\State\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\IndustryJobsRetrieve;
use App\Service\Procedure\IndustryJobsRetrieveCorporationProcedure;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

readonly class IndustryJobsRetrieveCorporationPostProcessor implements ProcessorInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private IndustryJobsRetrieveCorporationProcedure $industryJobsRetrieveCorporationProcedure,
    ) {
    }

    /**
     * @param IndustryJobsRetrieve $data
     * @param array<string, mixed>&array{request?: Request, previous_data?: mixed, resource_class?: string|null, original_data?: mixed} $context
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): IndustryJobsRetrieve
    {
        $ijr = new IndustryJobsRetrieve();
        $ijr->setCreationDatetime(new \DateTime());
        $this->entityManager->persist($ijr);
        $this->entityManager->flush();

        $errors = [];
        try {
            $ijr->setStartDatetime(new \DateTime());
            $this->industryJobsRetrieveCorporationProcedure->process();
        } catch (\Exception $e) {
            $errors[] = $e;
        }

        $ijr->setErrors($errors);
        $this->entityManager->persist($ijr);
        $this->entityManager->flush();

        return $ijr;
    }
}
