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
    $router->get('/contracts', ['as' => 'api.v1.index', 'uses' => 'ContractsController@index'] );
    $router->post('/contracts', ['as' => 'api.v1.create', 'uses' => 'ContractsController@create'] );
    $router->get('/contracts/{id}', ['as' => 'api.v1.show', 'uses' => 'ContractsController@show'] );
    $router->put('/contracts/{id}', ['as' => 'api.v1.update', 'uses' => 'ContractsController@update'] );
    $router->delete('/contracts/{id}', ['as' => 'api.v1.delete', 'uses' => 'ContractsController@delete'] );
    $router->get('/vendors', ['as' => 'api.v1.index', 'uses' => 'VendorsController@index'] );
    $router->get('/vendors/{id}', ['as' => 'api.v1.show', 'uses' => 'VendorsController@show'] );
    $router->post('/vendors', ['as' => 'api.v1.create', 'uses' => 'VendorsController@create'] );
    $router->put('/vendors/{id}', ['as' => 'api.v1.update', 'uses' => 'VendorsController@update'] );
    $router->delete('/vendors/{id}', ['as' => 'api.v1.delete', 'uses' => 'VendorsController@delete'] );   
});
