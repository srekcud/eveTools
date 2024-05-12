<?php

namespace App\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\RavworksJobsRetrieve;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class RavworksJobsRetrieveProcessor implements ProcessorInterface
{
    const POST_ES_RAVWORKS_RETRIEVE_CREATE = '/ravworks_jobs_retrieve/_doc';
    const POST_ES_RAVWORKS_RETRIEVE_UPDATE = 'ravworks_jobs_retrieve/_update';

    public function __construct(
//        private RavworksJobsProcedure $ravworkJobsProcedure,
        private readonly HttpClientInterface $esClient,
    )
    {
    }

    /** @param RavworksJobsRetrieve $data */
    public function process($data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $data->setCreationDatetime(new \DateTime());
        $data->setId($this->createRetrieveDoc($data));
        $errors = [];
        try {
            echo "toto";
//            $this->ravworkJobsProcedure->process();
        } catch (\Exception $exception) {
            $errors[] = $exception;
        }

        $data->setStartDatetime(new \DateTime())
            ->setErrors($errors);

        $this->updateRetrieveDoc($data);
        return $data;
    }

    private function createRetrieveDoc($data): string
    {
        $response = $this->esClient->request(
            'POST',
            self::POST_ES_RAVWORKS_RETRIEVE_CREATE,
            [
                'json' => [
                    'creation_datetime' => $data->getCreationDatetime()
                ]
            ])->toArray();

        return $response['_id'];
    }

    private function updateRetrieveDoc($data): void
    {
        $this->esClient->request(
            'POST',
            self::POST_ES_RAVWORKS_RETRIEVE_UPDATE . '/' . $data->getId(),
            [
                'json' => [
                    'doc'=>[
                    'start_datetime' => $data->getCreationDatetime(),
                    'errors' => $data->getErrors()
                ]]
            ]);
    }
}