<?php

use App\Transformers\KeywordsTransformer;
use App\Models\Keywords;

class KeywordsTransformerTest extends TestCase
{

    /**
     * @var Keywords
     */
    private $keywords;

    public function setUp()
    {
        $this->keywords = factory(Keywords::class, 1)->make();
    }

    public function testTransform()
    {
        $ktr = (new KeywordsTransformer())->transform($this->keywords);

        $this->assertArrayHasKey('keyword', $ktr);
        $this->assertArrayHasKey('slug', $ktr);
        $this->assertArrayHasKey('is_favourite', $ktr);
    }

}