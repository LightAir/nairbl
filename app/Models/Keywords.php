<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model Keywords
 *
 * @package App\Models
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
