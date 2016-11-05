<?php

namespace App\Transformers;

use App\Models\Keywords;
use League\Fractal\TransformerAbstract;

/**
 * Class KeywordsTransformer
 *
 * @package App\Transformers
 */
class KeywordsTransformer extends TransformerAbstract
{

    /**
     * @var array
     */
    protected $availableIncludes = [
        'posts'
    ];

    /**
     * @param Keywords $keywords
     * @return array
     */
    public function transform(Keywords $keywords)
    {
        return [
            'keyword' => $keywords->keyword,
            'slug' => $keywords->route,
            'is_favourite' => $keywords->is_favourite,
//            'posts' => $keywords->posts
        ];
    }

    /**
     * @param Keywords $keywords
     * @return \League\Fractal\Resource\Collection
     */
    public function includePosts(Keywords $keywords)
    {
        return $this->collection($keywords->posts, new PostTransformer());
    }

}