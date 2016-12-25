<?php

/**
 * Class ApiAuthTest
 */
class ApiAuthTest extends TestCase
{

    /**
     * Test getting Bearer token
     */
    public function testLogin()
    {
        $this->json('POST', '/api/auth/login', [
            'email' => 'admin@nairbl.local',
            'password' => 'admin'
        ]);

        $this->assertEquals(200,$this->response->getStatusCode());

        $this->assertObjectHasAttribute('token', json_decode($this->response->getContent()));
    }

    /**
     * Test bad login
     */
    public function testBadLogin()
    {
        $this->json('POST', '/api/auth/login', [
            'email' => 'baduser@nairbl.local',
            'password' => 'admin'
        ]);

        $this->assertEquals(404,$this->response->getStatusCode());

        $this->assertEquals('user_not_found', (json_decode(
            $this->response->getContent()
        ))[0]);
    }

    /**
     * test logout
     */
    public function testLogout()
    {
        $this->json('POST', '/api/auth/login', [
            'email' => 'admin@nairbl.local',
            'password' => 'admin'
        ]);

        $resp = json_decode($this->response->getContent());

        if(!isset($resp->token)){
            $this->fail('Token not found');
        }

        $this->refreshApplication();

        $this->json('POST', '/api/auth/logout?token=' . $resp->token, [
            'email' => 'admin@nairbl.local',
            'password' => 'admin'
        ]);

        $this->assertEquals('ok', (json_decode($this->response->getContent()))[0]);
    }
}