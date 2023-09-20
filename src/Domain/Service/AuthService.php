<?php

namespace Api\Domain\Service;

use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService
{
    /**
     * @param $user
     * @param $tll
     * @return mixed
     */
    public static function generateToken($user, $tll = 1440)
    {
        JWTAuth::factory()->setTTL($tll);

        return JWTAuth::claims([
            'uid' => $user->getId(),
            'role'=>$user->getRole()
        ])->fromUser($user);
    }
}

