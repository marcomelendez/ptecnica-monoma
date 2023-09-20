<?php

namespace Api\UseCase\Authentication;
use Api\Domain\Exceptions\TokenUnauthorized;
use Api\Domain\Contracts\AuthenticationInterface;
use Api\Domain\Entity\Authentication;
use Api\Domain\ValueObject\Login\UserName;
use Api\Domain\ValueObject\Login\UserPassword;
use Api\Infrastructure\ResponseHandler;
use Exception;

class Authenticate
{
    private AuthenticationInterface $authenticationRepository;

    public function __construct(AuthenticationInterface $authenticationRepository)
    {
        $this->authenticationRepository = $authenticationRepository;
    }

    public function execute(string $userName, string $password)
    {
        try{
            $authentication = new Authentication(
                new UserName($userName),
                new UserPassword($password)
            );
            
            if(!$token = $this->authenticationRepository->login($authentication)){
                throw new TokenUnauthorized('Password incorrect for: '.$userName);
            }

            return ResponseHandler::renderSuccessJson(201, [
                'token'=>$token,
                'minutes_to_expire'=>config('jwt.ttl')
            ]);

            return $token;

        }catch(Exception $e){
            return ResponseHandler::renderErrorJson(401, [$e->getMessage()]);
        }    

    }   
}