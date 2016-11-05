<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Laravel\Lumen\Routing\Controller as BaseController;
use League\Fractal\{
    Manager, Resource\Collection
};

class Controller extends BaseController
{

    /**
     * @var Manager
     */
    protected $fractal;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->fractal = new Manager();
    }

    /**
     * @param $resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function render($resource)
    {
        return response()->json($this->fractal->createData($resource)->toJson());
    }

    /**
     * Check fields
     *
     * @param $fields
     * @param $req
     *
     * @return array
     */
    public function fieldsCheck($fields, $req)
    {
        $data = [];

        foreach ($req as $key => $value) {

            if (array_key_exists($key, $fields)) {
                if ($fields[$key] && checkState($value)) {
                    $data[$key] = checkState($value);
                }
                $data[$key] = $value;
            }
        }

        return $data;
    }
}
