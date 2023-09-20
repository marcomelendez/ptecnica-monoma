<?php

namespace Api\Domain\ValueObject\Login;

class UserName 
{
    protected string $userName;

    public function __construct(string $userName)
    {
        
        $this->userName = $userName;
    }

    public function value(): string
    {
        return $this->userName;
    }
}