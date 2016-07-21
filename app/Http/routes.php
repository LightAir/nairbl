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

/**
 * API
 *
 * @static
 */
App::group(['prefix' => 'api/v1', 'namespace' => 'App\Http\Controllers'], function ()
{
    App::get('/about', 'Api@about');
    App::get('/news/{offset:[0-9]+}', 'Api@news');
    App::get('/item/{slug:[a-zA-Z_\-0-9]+}', 'Api@getNewsBySlug');

    // for page 'tags'
    App::get('/tags', 'Api@getTags');
    App::get('/tag/{slug:[a-zA-Z_\-0-9]+}', 'Api@getPostsByTag');

});

/**
 * all
 */
App::get('/{path:[\/\w\.-]*}', 'Blog@index');
