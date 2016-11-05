<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

/**
 * Class Info
 *
 * @package App\Http\Controllers
 */
class Info extends Controller
{
    /**
     * Return info about blog
     *
     * @return mixed
     */
    public function info()
    {
        return Settings::where('group', 'info')->get();
    }

    /**
     * Update info about blog
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateInfo(Request $request)
    {
        $fields = [
            'title' => false,
            'slogan' => false,
            'author' => false,
        ];

        $data = $this->fieldsCheck($fields, $request->toArray());

        \DB::beginTransaction();

        foreach ($data as $key => $value) {

            try {
                Settings::where('group', 'info')->where('setting_key', $key)->update([
                    'setting' => $value
                ]);
            } catch (\Exception $exc) {
                return success(false, $exc->getMessage());
            }
        }

        \DB::commit();

        // todo problem
        return success();
    }
}