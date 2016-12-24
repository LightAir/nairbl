<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Keywords
 *
 * @package App\Models
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Posts[] $posts
 * @mixin \Eloquent
 * @property int $id
 * @property string $keyword
 * @property string $route
 * @property bool $is_favourite
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Keywords whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Keywords whereKeyword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Keywords whereRoute($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Keywords whereIsFavourite($value)
 */
class Keywords extends Model
{

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany('App\Models\Posts');
    }
}
