<?php

namespace Api\Infrastructure;

use Api\Domain\Contracts\AuthenticationInterface;
use Api\Domain\Entity\Authentication;
use Api\Domain\Entity\UserEntity;
use Api\Domain\Service\AuthService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationInEloquent implements AuthenticationInterface
{
    /**
     * @param Authentication $authentication
     * @return String|null
     */
    public function login(Authentication $authentication): ?String
    {
        $result = null;
        $user = User::where('name', $authentication->getUserName()->value())->first();

        if ($user && Hash::check($authentication->getUserPassword()->value(), $user->getAuthPassword())) {

            $lastLogin = new \DateTime();

            $userEntity = new UserEntity(
                $user->id,
                $user->name,
                $user->password,
                $lastLogin,
                $user->is_active,
                $user->role,
            );

            $user->last_login = $lastLogin;

            $user->save();
            $result =  AuthService::generateToken($userEntity);
        }

        return $result;
    }
}
