<?php

class ApiPostsTest extends TestCase
{

    private $token;

    private $headers;

    public function setUp()
    {
        parent::setUp();

        $this->token = json_decode($this->json('POST', '/api/auth/login', [
            'email' => 'admin@nairbl.local',
            'password' => 'admin'
        ])->response->getContent());

        $this->refreshApplication();

        $this->headers = [
            'Authorization' => 'Bearer ' . $this->token->token
        ];
    }

    /**
     * Test create post '/post'
     */
    public function testCreatePost()
    {

        $this->json('POST', '/api/post', [
            'title' => 'test post',
            'text' => 'text post',
            'tags' => 'newtag',
            'isPublished' => 1,
            'isCommentable' => 1,
            'isFavourite' => 1
        ], $this->headers)->seeJson(
            [
                'success' => [
                    'message' => 'ok',
                    'slug' => 'test_post'
                ]
            ]
        );
    }

    /**
     * Test get post '/post'
     */
    public function testGetPosts()
    {
        $this->json('GET', '/api/post')->seeJsonStructure([
            'data' => [[
                '*' => 'id',
                '*' => 'title',
                '*' => 'text',
                '*' => 'is_commentable',
                '*' => 'is_favourite',
                '*' => 'slug',
                'date' => [[
                    'create' => [
                        '*' => 'date',
                        '*' => 'timezone_type',
                        '*' => 'timezone'
                    ],
                    'update' => [
                        '*' => 'date',
                        '*' => 'timezone_type',
                        '*' => 'timezone'
                    ],
                ]],
                'keywords' => [
                    'data' => [[
                        '*' => 'keyword',
                        '*' => 'slug',
                        '*' => 'is_favourite'
                    ]]
                ]
            ]],
            'meta' => [
                'pagination' =>[
                    '*' => 'total',
                    '*' => 'count',
                    '*' => 'per_page',
                    '*' => 'current_page',
                    '*' => 'total_pages',
                    '*' => 'links'

                ]
            ]
        ]);
    }

    /**
     * Get post by slug '/post/{slug}'
     */
    public function testGetPost()
    {
        $this->json('GET', '/api/post/test_post')->seeJsonStructure([
            'data' => [
                '*' => 'id',
                '*' => 'title',
                '*' => 'text',
                '*' => 'is_commentable',
                '*' => 'is_favourite',
                '*' => 'slug',
                'date' => [[
                    'create' => [
                        '*' => 'date',
                        '*' => 'timezone_type',
                        '*' => 'timezone'
                    ],
                    'update' => [
                        '*' => 'date',
                        '*' => 'timezone_type',
                        '*' => 'timezone'
                    ],
                ]],
                'keywords' => [
                    '*' => 'data'
                    ]
                ]
            ]);
    }

    public function testDeletePost()
    {

        $server = $this->transformHeadersToServerVars($this->headers);

        $this->call(
            'DELETE',
            '/api/post/test_post',
            [],
            [],
            [],
            $server
        );

        $this->seeJson(
            [
                'success' => [
                    'message' => 'ok',
                    'status_code' => 200
                ]
            ]
        );
    }

    //todo add test for update posts
}