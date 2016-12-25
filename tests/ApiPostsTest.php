<?php

class ApiPostsTest extends TestCase
{

    /**
     * Bearer token
     *
     * @var string
     */
    private $token;

    /**
     * Headers for authorization
     *
     * @var array
     */
    private $headers;

    /**
     * Setup the test environment.
     *
     * @return void
     */
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
     *
     * @return void
     */
    public function testCreatePost()
    {

        $this->json('POST', '/api/post', [
            'title' => 'test post',
            'text' => 'text post',
            'tags' => 'newtag, qwe, wer, ert',
            'is_published' => 1,
            'is_commentable' => 1,
            'is_favourite' => 1,
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
     *
     * @return void
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
     *
     * @return void
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

    /**
     * Test for delete posts
     *
     * @return void
     */
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

    /**
     * Test for update posts
     *
     * @return void
     */
    public function testUpdatePost()
    {

        $postData = [
            'title' => 'test post',
            'text' => 'text post',
            'tags' => 'qwe, wer, ert, test 8',
            'is_published' => 1,
            'is_commentable' => 1,
            'is_favourite' => 1,
            'update_at' => date('Y-m-d H:i:s')
        ];

        $this->json('PUT', '/api/post/ultricies_nullam_nisl_metus_', $postData, $this->headers)->seeJson(
            [
                'success' => [
                    'message' => 'ok',
                    'status_code' => 200
                ]
            ]
        );
    }
}