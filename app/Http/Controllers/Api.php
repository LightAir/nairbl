<?php

namespace App\Http\Controllers;

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

    public function news()
    {
      $npp = env('NPP', 10);
    }


}
