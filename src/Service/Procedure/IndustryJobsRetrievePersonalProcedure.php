<?php

namespace App\Service\Procedure;

use App\Entity\IndustryJob;
use App\Message\IdentifyIdMessage;
use App\Repository\IndustryJobRepository;
use App\Service\Builder\IndustryJobsBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class IndustryJobsRetrievePersonalProcedure
{

    const string EVE_LOGIN_URI = 'oauth/token';
    const int BATCH_FLUSH = 100;


    public function __construct(
        private readonly string $srekcudAlphaRefreshToken,
        private readonly string $basicToken,
        private readonly string $srekcudAlphaId,
//        private readonly ManagerRegistry        $managerRegistry,
        private readonly HttpClientInterface    $eveEsiClient,
        private readonly HttpClientInterface    $eveLoginClient,
        private readonly IndustryJobsBuilder    $industryJobsBuilder,
        private readonly IndustryJobRepository   $industryJobRepository,
        private readonly EntityManagerInterface $entityManager,
        private readonly MessageBusInterface $messageBus,
    ){}

    public function process(){
        $accessToken = $this->getAccessToken();

        $listJobs = $this->getListJobs($accessToken);

//        print_r($listJobs);die();

        $i = 0;
        $job = null;

        foreach($listJobs as $item){
            $job = $this->industryJobsBuilder->build($item);

            if($this->industryJobRepository->findOneBy(['industryJobId' => $job->getIndustryJobId()])){
                /** @var IndustryJob $j */
                $j = $this->industryJobRepository->findOneBy(['industryJobId' => $job->getIndustryJobId()]);
                $j->setSuccessful($job->getSuccessful())
                    ->setCompletedDatetime($job->getCompletedDatetime())
                    ->setStatus($job->getStatus());

                $this->entityManager->persist($j);
            }
            elseif(! $this->industryJobRepository->findOneBy(['industryJobId' => $job->getIndustryJobId(),'completedDatetime' => $job->getCompletedDatetime()])){

                $this->entityManager->persist($job);

                $message = new IdentifyIdMessage($job);
                $this->messageBus->dispatch($message);
            }

            if ($i++ % self::BATCH_FLUSH === 0){
                $this->entityManager->flush();
            }
        }


        $this->entityManager->flush();

        return $job;
    }

    public function getAccessToken(): string
    {
        $response = $this->eveLoginClient->request(
            'POST',self::EVE_LOGIN_URI,
            [
                'headers' =>[
                    'Content-Type'=> 'application/json',
                    'Authorization' => 'Basic '.$this->basicToken,
                ],
                'body' => [
                    'refresh_token' => $this->srekcudAlphaRefreshToken,
                    'grant_type' => 'refresh_token'
                ]])->toArray();
        return $response['access_token'];
    }

    public function getListJobs(string $accessToken): array
    {
            $URI = 'characters/'.$this->srekcudAlphaId.'/industry/jobs/?datasource=tranquility&include_completed=true';

        return $this->eveEsiClient->request(
            'GET', $URI,
            [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken
                ]
            ]
        )->toArray();

    }

}
