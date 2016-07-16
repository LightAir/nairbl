<?php

namespace App\Http\Controllers;

use App\Models\Posts;

/**
 * General controller
 */
class Api extends Controller
{
  /**
   * Return some information
   */
    public function about(){

      // TODO getting data from database
      $data = [
        'title' => 'My blog',
        'siteName' => 'Header',
        'siteHelp' => '/php, coding, js, css/'
      ];

      return response()->json($data);
    }

    /**
     * Return news
     *
     * @param  int $offset
     *
     * @return mixed
     */
    public function news($offset)
    {
      $npp = env('NPP', 10);
      $data = Posts::find([], $offset?:0, $npp);

      return response()->json($data);
    }


}
