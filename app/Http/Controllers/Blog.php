<?php

namespace App\Http\Controllers;

/**
 * General controller
 */
class Blog extends Controller
{
  /**
   * Viewer main page
   *
   * @return \Illuminate\View\View
   */
    public function index(){

      // TODO getting data from database
      $data = [
        'title' => 'My blog',
        'snHeader' => 'Header',
        'littleHelp' => '/php, coding, js, css/'
      ];

      return view('main', $data);
    }

    
}
