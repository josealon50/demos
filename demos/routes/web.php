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
$router->get('/', function () use ($router) { 
    return $router->app->version(); 
});

$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->post('/login', ['as' => 'api.v1.authcontroller.login', 'uses' => 'AuthController@login'] );
});

$router->group(['prefix' => 'v1', 'middleware' => 'auth:v1'], function () use ($router) {
    $router->get('/users', ['as' => 'api.v1.users.index', 'uses' => 'UsersController@index'] );
    $router->get('/users/profile', ['as' => 'api.v1.users.index', 'uses' => 'UsersController@profile'] );
    $router->get('/users/{id}', ['as' => 'api.v1.users.show', 'uses' =>  'UsersController@show'] );
    $router->post('/users', ['as' => 'api.v1.users.create', 'uses' => 'UsersController@create'] );
    $router->put('/users', ['as' => 'api.v1.users.create', 'uses' => 'UsersController@edit'] );
    $router->delete('/users', ['as' => 'api.v1.users.create', 'uses' => 'UsersController@delete'] );
    $router->get('/contracts', ['as' => 'api.v1.contracts.index', 'uses' => 'ContractsController@index'] );
    $router->post('/contracts', ['as' => 'api.v1.contracts.create', 'uses' => 'ContractsController@create'] );
    $router->get('/contracts/{id}', ['as' => 'api.v1.contracts.show', 'uses' => 'ContractsController@show'] );
    $router->put('/contracts/{id}', ['as' => 'api.v1.contracts.update', 'uses' => 'ContractsController@update'] );
    $router->delete('/contracts/{id}', ['as' => 'api.v1.contracts.delete', 'uses' => 'ContractsController@delete'] );
    $router->get('/vendors', ['as' => 'api.v1.index', 'uses' => 'VendorsController@index'] );
    $router->get('/vendors/{id}', ['as' => 'api.v1.show', 'uses' => 'VendorsController@show'] );
    $router->post('/vendors', ['as' => 'api.v1.create', 'uses' => 'VendorsController@create'] );
    $router->put('/vendors/{id}', ['as' => 'api.v1.update', 'uses' => 'VendorsController@update'] );
    $router->delete('/vendors/{id}', ['as' => 'api.v1.delete', 'uses' => 'VendorsController@delete'] );   
});
