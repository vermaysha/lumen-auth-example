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

$router->group(['prefix' => 'auth'], function () use ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('signup', 'AuthController@signup');

    $router->group([
        'middleware' => 'auth:api'
    ], function () use ($router) {
        $router->get('logout', 'AuthController@logout');
        $router->get('user', 'AuthController@user');

        // Admin User
        $router->group([
            'middleware' => 'scopes:admin'
        ], function () use ($router) {
            $router->get('admin', function () {
                return "Administrator user page";
            });
        });

        // Writer User
        $router->group([
            'middleware' => 'scopes:writer'
        ], function () use ($router) {
            $router->get('writer', function () {
                return "Writer user page";
            });
        });

        // Basic User
        $router->group([
            'middleware' => 'scopes:user'
        ], function () use ($router) {
            $router->get('basic', function () {
                return "Basic user page";
            });
        });
    });
});

// $router->post('/register', 'UsersController@register');
