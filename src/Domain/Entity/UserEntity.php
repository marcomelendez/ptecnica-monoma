<?php

namespace Api\Domain\Entity;

use Tymon\JWTAuth\Contracts\JWTSubject;

Class UserEntity implements JWTSubject
{
    private int $id;

    private string $name;

    private string $password;

    private \DateTime $lastLogin;

    private bool $activate;

    private string $role;

    /**
     * @param int $id
     * @param string $name
     * @param string $password
     * @param \DateTime $lastLogin
     * @param bool $activate
     * @param string $role
     */
    public function __construct(int $id, string $name, string $password, \DateTime $lastLogin, bool $activate, string $role)
    {
        $this->id = $id;
        $this->name      = $name;
        $this->password  = $password;
        $this->lastLogin = $lastLogin;
        $this->activate  = $activate;
        $this->role      = $role;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->lastLogin;
    }

    /**
     * @return bool
     */
    public function getActivate()
    {
        return $this->activate;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getKey()
    {
        return $this->getId();
    }
}
