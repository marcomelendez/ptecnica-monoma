<?php

namespace Tests\Unit\UseCase;

use Api\Infrastructure\CandidateInMemory;
use Api\UseCase\Candidate\GetAllCandidates;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class GetAllCandidatesTest extends TestCase
{
    public function test_for_get_response_candidates_true()
    {
        JWTAuth::shouldReceive('parseToken->checkOrFail')
        ->once()
        ->andReturn(['uid' => 1, 'role' => 'agent']); 


        $useCase = new GetAllCandidates(new CandidateInMemory());
        $response = $useCase->execute();
        
        $this->assertEquals(201, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    public function test_for_get_user_unauthorized()
    {
        $useCase = new GetAllCandidates(new CandidateInMemory());
        $response = $useCase->execute();;
        $this->assertEquals(401, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }
} 