<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');
$router->get('/logout', 'AuthController@logout');
$router->get('/refresh', 'AuthController@refresh');


// Authenticated Routes
$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->get('/ips', 'IpsController@index');
    $router->get('/ips/{id}', 'IpsController@show');
    $router->post('/ips', 'IpsController@add');
    $router->put('/ips/{id}', 'IpsController@modify');
    $router->delete('/ips/{id}', 'IpsController@destroy');
});
