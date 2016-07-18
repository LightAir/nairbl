<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

App::get('/', 'Blog@index');


App::group(['prefix' => 'api/v1', 'namespace' => 'App\Http\Controllers'], function ()
{
    App::get('/about', 'Api@about');
    App::get('/news/{offset:[0-9]+}', 'Api@news');
    App::get('/item/{slug:[a-zA-Z_\-0-9]+}', 'Api@getNewsBySlug');

});
