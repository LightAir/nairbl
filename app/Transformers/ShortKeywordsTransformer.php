<?php

namespace App\Transformers;

use App\Models\Keywords;
use League\Fractal\TransformerAbstract;

/**
 * Class ShortKeywordsTransformer
 * @package App\Transformers
 */
class ShortKeywordsTransformer extends TransformerAbstract
{

    /**
     * @param Keywords $keywords
     * @return array
     */
    public function transform(Keywords $keywords)
    {
        $out = [
            'keyword' => $keywords->keyword,
            'slug' => $keywords->route,
            'is_favourite' => $keywords->is_favourite,
            'tags_id' => $keywords->posts->keyBy('id')->keys()->toArray()
        ];

        return $out;
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