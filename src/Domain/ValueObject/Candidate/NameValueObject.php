<?php

namespace Api\Domain\ValueObject\Candidate;

class NameValueObject
{
    private $name;

    public function __construct(string $value) 
    {
        $this->name = $value;
    }

    public function value()
    {
        return $this->name;
    }
}