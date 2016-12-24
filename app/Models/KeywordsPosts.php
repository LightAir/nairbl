<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\KeywordsPosts
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $posts_id
 * @property int $keywords_id
 * @method static \Illuminate\Database\Query\Builder|\App\Models\KeywordsPosts whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\KeywordsPosts wherePostsId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\KeywordsPosts whereKeywordsId($value)
 */
class KeywordsPosts extends Model
{

}
