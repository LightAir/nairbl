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
      $result = [];

      $data = Posts::find([], $offset?:0, $npp);

      foreach ($data as $key => $value) {
        $text = substr($value->text, 0, env('NEWS_LENGTH', 1000));

        if ($value->is_published && $value->is_visible){
          $result[$key]['title'] = $value->title;
          $result[$key]['slug'] = $value->slug;
          $result[$key]['text'] = $text;
          $result[$key]['commentable'] = (bool)$value->is_commentable;
          $result[$key]['favourite'] = (bool)$value->is_favourite;
          $result[$key]['date'] = date('Y.m.d' ,strtotime($value->created_at));
        }
      }


      return response()->json($result);
    }


}
