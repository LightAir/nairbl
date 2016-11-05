<?php

namespace App\Transformers;

use App\Models\Posts;
use League\Fractal\TransformerAbstract;

/**
 * Class PostTransformer
 *
 * @package App\Transformers
 */
class PostTransformer extends TransformerAbstract
{
    /**
     * @var array
     */
    protected $defaultIncludes = [
        'keywords'
    ];

    /**
     * @param Posts $posts
     *
     * @return array
     */
    public function transform(Posts $posts)
    {
        return [
            'id' => (int)$posts->id,
            'title' => $posts->title,
            'text' => $posts->text,
            'is_commentable' => (bool)$posts->is_commentable,
            'is_favourite' => (bool)$posts->is_favourite,
            'slug' => $posts->slug,
            'date' => [
                [
                    'create' => $posts->created_at,
                    'update' => $posts->updated_at,
                ]
            ]
        ];
    }

    /**
     * @param Posts $posts
     *
     * @return \League\Fractal\Resource\Collection
     */
    public function includeKeywords(Posts $posts)
    {
        return $this->collection($posts->keywords, new KeywordsTransformer());
    }
}