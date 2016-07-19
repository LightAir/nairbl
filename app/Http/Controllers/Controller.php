<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Models\Settings;

class Controller extends BaseController
{
    /**
     * Get setting by group.
     *
     * @param string $grp
     *
     * @return mixed
     */
    public function getSettingsByGroup($grp = 'general')
    {
        return Settings::find(['group' => $grp]);
    }

    /**
     * Get setting by group and key.
     *
     * @param string $grp
     * @param string $key
     *
     * @return mixed
     */
    public function getSettingsByKey($key = '', $grp = 'general')
    {
        $data = Settings::findFirst(['group' => $grp, 'setting_key' => $key]);

        // TODO add Redis cache
        if (isset($data->setting)) {
            return $data->setting;
        }

        return false;
    }

    /**
     * Save settings.
     *
     * @param string $grp
     * @param string $key
     * @param string $val
     *
     * @return bool
     */
    public function setSetting($key = '', $val = '', $grp = 'general')
    {
        $data = [
          'group' => $grp,
          'setting_key' => $key,
          'setting' => $val,
        ];

        return Settings::insert($data);
    }
}
