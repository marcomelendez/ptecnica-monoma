<?php

namespace Api\Domain\ValueObject\Candidate;

class CandidateId
{
    private $id;

    public function __construct($value = null) 
    {
        $this->id = $value;
    }

    public function value()
    {
        return $this->id;
    }
}