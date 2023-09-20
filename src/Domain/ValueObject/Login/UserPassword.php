<?php

namespace Api\Domain\ValueObject\Login;

class UserPassword 
{
    private $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public function value()
    {
        return $this->password;
    }
}