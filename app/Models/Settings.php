<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = [
        'group',
        'setting_key',
        'setting'
    ];
}
