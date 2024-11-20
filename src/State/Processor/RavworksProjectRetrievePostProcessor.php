<?php

namespace App\State\Processor;


use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\RavworksProjectRetrieve;
use App\Service\Procedure\RavworksProjectRetrieveProcedure;
use Doctrine\ORM\EntityManagerInterface;

readonly class RavworksProjectRetrievePostProcessor implements ProcessorInterface
{
    public function __construct(
        private EntityManagerInterface           $entityManager,
        private RavworksProjectRetrieveProcedure $ravworksProjectRetrieveProcedure,
    ){}

    /**
     * @param RavworksProjectRetrieve $data
     * @param array $context
     */
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): RavworksProjectRetrieve
    {
        $rpr = new RavworksProjectRetrieve();
        $rpr->setCreationDatetime(new \DateTime());
        $this->entityManager->persist($rpr);
        $this->entityManager->flush();

        $errors = [];
        try {
            $rpr->setStartDatetime(new \DateTime());
            $this->ravworksProjectRetrieveProcedure->process($uriVariables['code']);
        } catch (\Exception $e){
            $errors[] = $e;
        }

        $rpr->setErrors($errors);
        $this->entityManager->persist($rpr);
        $this->entityManager->flush();

        return $rpr;
    }
}
