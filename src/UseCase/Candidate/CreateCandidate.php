<?php

namespace Api\UseCase\Candidate;

use Api\Domain\Entity\Candidate;
use Api\Domain\ValueObject\Candidate\CandidateId;
use Api\Domain\ValueObject\Candidate\CreatedBy;
use Api\Domain\ValueObject\Candidate\NameValueObject;
use Api\Domain\ValueObject\Candidate\Owner;
use Api\Domain\ValueObject\Candidate\Source;
use Api\Infrastructure\ResponseHandler;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

final class CreateCandidate extends CandidateAbstract
{
    public function execute(array $data)
    {
        try{

            $user = JWTAuth::parseToken()->checkOrFail();
        
            if($user['role'] === self::ROLE_MANAGER){

                $candidate = new Candidate(new CandidateId(),
                    new NameValueObject($data['name']),
                    new Source($data['source']),
                    new Owner($data['owner']),
                    new CreatedBy($user['uid']),
                    new \DateTime());

                $reponse = $this->candidateRepository->create($candidate);
                
                return ResponseHandler::renderSuccessJson(200, $reponse);

            }else{
                throw new Exception("User no authorized");
            }

        }catch(Exception $e){
            return ResponseHandler::renderErrorJson(401, ['Token expired']);

        }    
    }
}