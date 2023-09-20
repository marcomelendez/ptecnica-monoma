<?php

namespace Api\UseCase\Candidate;

use Api\Infrastructure\ResponseHandler;
use Tymon\JWTAuth\Facades\JWTAuth;

class GetAllCandidates extends CandidateAbstract
{
    public function execute()
    {
        try{

            $candidates = $this->candidateRepository->all();

            $user = JWTAuth::parseToken()->checkOrFail();
            if ($user['role'] === self::ROLE_AGENT) {
                $candidates = $candidates->filter(function ($value) use($user) {
                    return $value->getOwner()->value() === (int) $user['uid'];
                });
            }

            $candidates = $candidates->map(function($row){
                return $row->toArray(); 
            });        

        
            return ResponseHandler::renderSuccessJson(201, $candidates->toArray());

        }catch(\Exception $e){
    
            return ResponseHandler::renderErrorJson(401, ['Token expired']);
        }
        
    }
}