<?php

namespace Api\Domain\Entity;

use Api\Domain\ValueObject\Candidate\CandidateId;
use Api\Domain\ValueObject\Candidate\CreatedBy;
use Api\Domain\ValueObject\Candidate\NameValueObject;
use Api\Domain\ValueObject\Candidate\Owner;
use Api\Domain\ValueObject\Candidate\Source;
use ReflectionClass;

class Candidate
{
    private CandidateId $id;

    private NameValueObject $name;

    private Source $source;

    private Owner $owner;

    private CreatedBy $createdBy;

    private \DateTime $createdAt;

    /**
     * @param CandidateId $id
     * @param NameValueObject $name
     * @param Source $source
     * @param Owner $owner
     * @param CreatedBy $createdBy
     * @param \DateTime $createdAt
     */
    public function __construct(CandidateId $id, NameValueObject $name, Source $source, Owner $owner, CreatedBy $createdBy, \DateTime $createdAt)
    {
        $this->id = $id;
        $this->name = $name;
        $this->source = $source;
        $this->owner = $owner;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
    }

    public function getId(): CandidateId
    {
        return $this->id;
    }

    public function getName(): NameValueObject
    {
        return $this->name;
    }

    public function getSource(): Source
    {
        return $this->source;
    }

    public function getOwner(): Owner
    {
        return $this->owner;
    }

    public function getCreatedBy(): CreatedBy
    {
        return $this->createdBy;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name'=>$this->getName()->value(),
            'source'=>$this->getSource()->value(),
            'owner'=>$this->getOwner()->value(),
            'created_at'=>$this->getCreatedAt()->format('Y-m-d H:m:s'),
            'created_by'=>$this->getCreatedBy()->value()
        ];
    }
}
