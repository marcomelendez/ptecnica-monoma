<?php

namespace Api\Domain\ValueObject\Candidate;

class Owner
{
    private $owner;

    public function __construct(int $value) 
    {
        $this->owner = $value;
    }

    public function value()
    {
        return $this->owner;
    }
}