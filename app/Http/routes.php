<?php

/**
 * API
 *
 * @static
 */
$api = app(Dingo\Api\Routing\Router::class);

$currentApiVersion = 'v1';

$api->version($currentApiVersion, function ($api) {

    $api->get('info', 'App\Http\Controllers\Info@info');
    $api->get('tags', 'App\Http\Controllers\Tags@getTags');
    $api->get('tag/{name}', 'App\Http\Controllers\Tags@getPostsByTag');

    $api->group(['namespace' => 'App\Http\Controllers'], function ($api) {
        $api->group(['prefix' => 'auth'], function ($api) {
            // /api/auth/login
            $api->post('login', 'Auth@login');
        });
    });

    $api->group(['namespace' => 'App\Http\Controllers'], function ($api) {
        $api->get('post', 'Post@post');
        $api->get('post/{slug}', 'Post@getPostBySlug');
    });
});

/**
 * only authorized
 */
$api->version($currentApiVersion, ['middleware' => 'jwt.auth'], function ($api) {
    $api->put('info', 'App\Http\Controllers\Info@updateInfo');
    $api->delete('tag/{name}', 'App\Http\Controllers\Tags@deleteTag');

    $api->group(['namespace' => 'App\Http\Controllers'], function ($api) {
        $api->group(['prefix' => 'auth'], function ($api) {
            $api->post('logout', 'Auth@logout');
        });
    });

    $api->group(['namespace' => 'App\Http\Controllers'], function ($api) {
        $api->post('post', 'Post@addPost');
        $api->put('post/{slug}', 'Post@updatePost');
        $api->delete('post/{slug}', 'Post@deletePost');
    });
});


App::get('/', function () {
    return 'ok';
});
