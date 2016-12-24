<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Posts
 *
 * @package App\Models
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Keywords[] $keywords
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $text
 * @property bool $is_published
 * @property bool $is_commentable
 * @property bool $is_visible
 * @property bool $is_favourite
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereIsPublished($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereIsCommentable($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereIsVisible($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereIsFavourite($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Posts whereUpdatedAt($value)
 */
class Posts extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'text',
        'is_published',
        'is_commentable',
        'is_visible',
        'is_favourite'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function keywords()
    {
        return $this->belongsToMany('App\Models\Keywords');
    }
}
