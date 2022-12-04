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

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\PublicationController;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/auth', 'AuthenticationController@authenticate');
$router->post('signup', 'AuthenticationController@signup');
$router->post('/publication', 'PublicationController@new');
$router->get('/list/{user_id}', 'PublicationController@list');
$router->get('/find/{publication}', 'PublicationController@find');