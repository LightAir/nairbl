<?php

/**
 * Class ApiInfoTest
 */
class ApiInfoTest extends TestCase
{

    /**
     * Test get info about blog
     */
    public function testGetInfo()
    {
        $this->json('GET', '/api/info');

        $this->seeJsonStructure(
            [
                '*' => 'title',
                '*' => 'author',
                '*' => 'slogan'
            ]
        );
    }

    /**
     * Test put info about blog
     */
    public function testPutInfo()
    {
        $token = json_decode($this->json('POST', '/api/auth/login', [
            'email' => 'admin@nairbl.local',
            'password' => 'admin'
        ])->response->getContent());

        $this->refreshApplication();

        if(!isset($token->token)){
            $this->fail('Token not found');
        }

        $headers = [
            'Authorization' => 'Bearer ' . $token->token
        ];

        $this->json('PUT', '/api/info', [
            'title' => 'new title',
            'author' => 'new author',
            'slogan' => 'New slogan'
        ], $headers);

        $this->seeJson(
        [
            'success' => [
                'message' => 'ok',
                'status_code' => 200
            ]
        ]
    );
    }
}