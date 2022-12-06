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
use App\Http\Controllers\TemplateController;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/auth', 'AuthenticationController@authenticate');
$router->post('signup', 'AuthenticationController@signup');
$router->post('/publication', 'PublicationController@new');
$router->get('/list/{user_id}', 'PublicationController@list');
$router->get('/find/{publication}', 'PublicationController@find');
$router->post('/template/add', 'TemplateController@new');
$router->get('/template/list', 'TemplateController@list');
$router->put('/template/edit', 'TemplateController@edit');
$router->delete('/template/delete/{id}', 'TemplateController@delete');
$router->get('/template/find/{title}', 'TemplateController@find');