<?php

namespace Tests\Unit\UseCase;

use Api\Infrastructure\CandidateInMemory;
use Api\UseCase\Candidate\GetCandidate;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class GetCandidateTest extends TestCase
{
    public function test_for_get_response_candidate_true()
    {
        JWTAuth::shouldReceive('parseToken->checkOrFail')
        ->once()
        ->andReturn(['uid' => 1, 'role' => 'agent']); 


        $useCase = new GetCandidate(new CandidateInMemory());
        $response = $useCase->execute(1);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertJson($response->getContent());
    }

    public function test_for_get_response_candidate_false()
    {
        $useCase = new GetCandidate(new CandidateInMemory());
        $response = $useCase->execute(20);
        $this->assertEquals(404, $response->getStatusCode());
    }
}    