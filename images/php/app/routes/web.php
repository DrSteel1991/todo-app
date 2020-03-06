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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api/'], function ($router) {
	$router->post('login/', 'UsersController@authenticate');
    $router->post('register/', 'UsersController@register');

    $router->group(['prefix' => 'todo/'], function ($router) {
        $router->get('/', 'TodoController@index');
        $router->get('completed/', 'TodoController@getByStatus');
        $router->get('{id}', 'TodoController@show');
        $router->post('/', 'TodoController@store');
        $router->put('{id}', 'TodoController@update');
        $router->delete('{id}', 'TodoController@destroy');
    });
});
