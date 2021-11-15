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


//$router->get('userkeyauthenticte', ['middleware' => 'auth_user_key', EmployeeController::class,'index']);
$router->get('userkeyauthenticte/{id}', ['middleware' => 'auth_user_key','uses' => 'UsersController@index']);

$router->group(['middleware' => ['auth_level:600']], function () use ($router) {
    $router->get('/teachers', '\App\Http\Controllers\TeacherController@index');
});


