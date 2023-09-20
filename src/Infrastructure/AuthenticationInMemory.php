<?php

namespace Api\Infrastructure;

use Api\Domain\Contracts\AuthenticationInterface;
use Api\Domain\Entity\Authentication;
use Api\Domain\Entity\UserEntity;
use Api\Domain\Service\AuthService;

class AuthenticationInMemory implements AuthenticationInterface
{
    public function login(Authentication $authentication): ?String
    {
        $result = null;

        if($authentication->getUserName()->value() === "tester" &&
            $authentication->getUserPassword()->value() === "PASSWORD"){

            $userEntity = new UserEntity(1,"tester","PASSWORD",new \DateTime(),"1","agent");
            $result =  AuthService::generateToken($userEntity,120);
        }

        return $result;
    }
}
