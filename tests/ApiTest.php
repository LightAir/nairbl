<?php

use Illuminate\Support\Facades\Artisan;

class ApiTest extends TestCase
{

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
}