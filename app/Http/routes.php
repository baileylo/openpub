<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

use Illuminate\Routing\Router;

Route::group(['middleware' => ['web']], function (Router $router) {
    $router->get('', ['as' => 'home', 'uses' => 'PostController@index']);
    $router->resource('post', 'PostController');
    $router->resource('page', 'PageController');

    $router->get('login', ['as' => 'login', 'uses' => 'Auth\\AuthController@getLogin']);
    $router->post('login', 'Auth\\AuthController@login');
    $router->get('logout', ['as' => 'logout', 'uses' => 'Auth\\AuthController@logout']);

    $router->group(['middleware' => ['auth']], function (Router $router) {
        $router->get('admin', ['as' => 'admin', 'uses' => 'PostController@overview']);

        $router->get('settings', ['as' => 'settings', 'uses' => function () {return 'coming soon!';}]);
    });
});
