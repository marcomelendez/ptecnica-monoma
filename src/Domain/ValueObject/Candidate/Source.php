<?php

namespace Api\Domain\ValueObject\Candidate;

class Source
{
    private $source;

    public function __construct(string $value) 
    {
        $this->source = $value;
    }

    public function value()
    {
        return $this->source;
    }
}