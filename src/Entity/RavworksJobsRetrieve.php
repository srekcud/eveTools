<?php
namespace App\Entity;

use ApiPlatform\Metadata\Post;
use App\Processor\RavworksJobsRetrieveProcessor;
use Symfony\Component\Serializer\Annotation\Groups;

#[Post(
    uriTemplate: 'ravworks/jobs/retrieve',
    denormalizationContext: ['groups' => [RavworksJobsRetrieve::POST]],
    processor: RavworksJobsRetrieveProcessor::class,
)]
Class RavworksJobsRetrieve
{
    const POST='RAVWORK_JOBS_RUN_POST';

    private ?string $id;
    #[Groups([RavworksJobsRetrieve::POST])]
    private ?string $code = null;
    private ?\DateTimeInterface $startDatetime = null;
    private ?\DateTimeInterface $creationDatetime = null;
    private array $errors = [];

    public function getId(): ?string
    {
        return $this->id;
    }
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getStartDatetime(): ?\DateTimeInterface
    {
        return $this->startDatetime;
    }

    public function setStartDatetime(\DateTimeInterface $startDatetime): self
    {
        $this->startDatetime = $startDatetime;

        return $this;
    }

    public function getCreationDatetime(): ?\DateTimeInterface
    {
        return $this->creationDatetime;
    }

    public function setCreationDatetime(?\DateTimeInterface $creationDatetime): self
    {
        $this->creationDatetime = $creationDatetime;

        return $this;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(?array $errors): self
    {
        $this->errors = $errors;

        return $this;
    }
}

