<?php

namespace App\Models;

class Keywords extends Model
{
    /**
     * Return posts by tag.
     *
     * @param string $tag
     *
     * @return mixed
     */
    public static function getPostByTag($tag)
    {
        return \DB::table('keywords')
          ->rightJoin('posts_keywords', 'posts_keywords.keyword_id', '=', 'keywords.id')
          ->rightJoin('posts', 'posts_keywords.post_id', '=', 'posts.id')
          ->where('keywords.route', '=', $tag)
          ->get();
    }
}
