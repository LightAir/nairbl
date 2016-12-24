<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Settings
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $group
 * @property string $setting_key
 * @property string $setting
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings whereGroup($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings whereSettingKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Settings whereSetting($value)
 */
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
