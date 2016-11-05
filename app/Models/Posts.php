<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Posts
 * @package App\Models
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
