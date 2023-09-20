<?php

namespace Tests\Unit\UseCase;

use Api\Infrastructure\AuthenticationInMemory;
use Api\UseCase\Authentication\Authenticate;
use Tests\TestCase;

class AuthenticateTest extends TestCase
{
    public function test_that_generate_access_token_is_true()
    {
        $authenticate = new Authenticate(new AuthenticationInMemory());
        $response = $authenticate->execute("tester", "PASSWORD");
        
        $this->assertEquals(201, $response->getStatusCode());
        $json = json_decode($response->getContent());
        $this->assertTrue($json->meta->success);
    }
    
    public function test_that_generate_access_token_is_false()
    {
        $authenticate = new Authenticate(new AuthenticationInMemory());
        $response = $authenticate->execute("otheruser", "passwt");

        $json = json_decode($response->getContent());

        $this->assertEquals(401, $response->getStatusCode());
        $this->assertFalse($json->meta->success);
    }
}    