<?php

namespace Api\UseCase\Candidate;

use Api\Infrastructure\ResponseHandler;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;

class GetCandidate extends CandidateAbstract
{
    public function execute(int $id)
    {
        try{
            $user = JWTAuth::parseToken()->checkOrFail();

            $candidate = $this->candidateRepository->find($id);
            
            if ($user['role'] === self::ROLE_AGENT && $candidate->getOwner()->value() !== $user['uid']) {

                return ResponseHandler::renderErrorJson(401, ['Token expired']);
            }    

            return ResponseHandler::renderSuccessJson(201, $candidate->toArray());

        }catch(Exception $e){
            return ResponseHandler::renderErrorJson(404, ['No lead found']);
        }    
    }
}
