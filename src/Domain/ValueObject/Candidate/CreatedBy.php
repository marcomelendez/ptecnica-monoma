<?php

namespace Api\Domain\ValueObject\Candidate;

class CreatedBy
{
    private $createdBy;

    public function __construct(string $value) 
    {
        $this->createdBy = $value;
    }

    public function value()
    {
        return $this->createdBy;
    }
}