<?php

namespace Tests\Unit\UseCase;

use Api\Infrastructure\CandidateInMemory;
use Api\UseCase\Candidate\CreateCandidate;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CreateCandidatesTest extends TestCase
{
    public function test_for_get_creation_candidate_user_authorized()
    {
        JWTAuth::shouldReceive('parseToken->checkOrFail')
        ->once()
        ->andReturn(['uid' => 1, 'role' => 'manager']); 

        $data = [
            "name" => "Un candidato",
            "source" => "Fotocasa",
            "owner" => 2,
            "created_at" => "2023-09-19 23:09:45",
            "created_by" => "1"
        ];

        $useCase = new CreateCandidate(new CandidateInMemory());
        $response = $useCase->execute($data);

        $this->assertEquals(200,$response->getStatusCode());

        $response = json_decode($response->getContent(),true);
        $this->assertTrue($response['meta']['success']);
        $this->assertArrayHasKey('data',$response);
    }  
    
    public function test_for_get_creation_candidate_user_unauthorized()
    {
        JWTAuth::shouldReceive('parseToken->checkOrFail')
        ->once()
        ->andReturn(['uid' => 1, 'role' => 'agent']); 

        $data = [
            "name" => "Un candidato",
            "source" => "Fotocasa",
            "owner" => 2,
            "created_at" => "2023-09-19 23:09:45",
            "created_by" => "1"
        ];

        $useCase = new CreateCandidate(new CandidateInMemory());
        $response = $useCase->execute($data);
        $this->assertEquals(401,$response->getStatusCode());

        $response = json_decode($response->getContent(),true);    
        $this->assertFalse($response['meta']['success']);
        $this->assertEquals(['Token expired'],$response['meta']['errors']);
        
    
    } 
}    