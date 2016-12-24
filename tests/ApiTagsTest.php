<?php

class ApiTagsTest extends TestCase
{

    /**
     * Test structure '/api/tags'
     */
    public function testTags()
    {

        $this->json('GET', '/api/tags')
            ->seeJsonStructure([
                'data' => [[
                    '*' => 'is_favourite',
                    '*' => 'keyword',
                    '*' => 'slug',
                ]]
            ]);
    }

    /**
     * Test structure '/api/tags?include=posts'
     */
    public function testTagsInclude()
    {
        $this->json('GET', '/api/tags?include=posts')
            ->seeJsonStructure([
                'data' => [[
                    '*' => 'is_favourite',
                    '*' => 'keyword',
                    '*' => 'slug',
                    'posts' => [
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
                        ]]
                    ]
                ]]
            ]);
    }

    /**
     * Test structure '/api/tags?short'
     */
    public function testTagsShort()
    {
        $this->json('GET', '/api/tags?short')
            ->seeJsonStructure([
                'data' => [[
                    '*' => 'is_favourite',
                    '*' => 'keyword',
                    '*' => 'slug',
                    '*' => 'tags_id'
                ]]
            ]);
    }

    /**
     * Test structure '/api/tag/first'
     */
    public function testTag()
    {

        $this->json('GET', '/api/tag/fav')
            ->seeJsonStructure([
                'data' => [
                    '*' => 'is_favourite',
                    '*' => 'keyword',
                    '*' => 'slug',
                    'posts' => [
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
                        ]]
                    ]
                ]
            ]);
    }

    //todo add test delete tag
}