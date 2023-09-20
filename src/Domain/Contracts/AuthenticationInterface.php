<?php

namespace Api\Domain\Contracts;

use Api\Domain\Entity\Authentication;

interface AuthenticationInterface
{
    public function login(Authentication $authentication): ?String;
}   