<?php

namespace Api\Domain\Entity;

use Api\Domain\ValueObject\Login\UserName;
use Api\Domain\ValueObject\Login\UserPassword;

class Authentication
{
    private $userName;
    private $userPassword;

    /**
     * @param UserName $userName
     * @param UserPassword $userPassword
     */
    public function __construct(UserName $userName, UserPassword $userPassword)
    {
        $this->userName     = $userName;
        $this->userPassword = $userPassword;
    }

    /**
     * @return UserName
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @return UserPassword
     */
    public function getUserPassword()
    {
        return $this->userPassword;
    }
}
