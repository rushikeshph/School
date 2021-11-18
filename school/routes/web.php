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

$router->group(['middleware' => ['auth_level:200']], function () use ($router) {

    
    $router->get('/courses', '\App\Http\Controllers\CourseController@index'); //show all courses
    $router->get('/courses/{id}', '\App\Http\Controllers\CourseController@show');  //show the course having the id passed

    $router->get('/teachers', '\App\Http\Controllers\TeacherController@index'); //show all teachers*
    $router->post('/teachers', '\App\Http\Controllers\TeacherController@store');// create teacher*
    $router->get('/teachers/{teacher_id}', '\App\Http\Controllers\TeacherController@show'); //show the techer by id*
    $router->put('/teachers/{teacher_id}', '\App\Http\Controllers\TeacherController@update'); //update teacher*
    $router->patch('/teachers/{teacher_id}', '\App\Http\Controllers\TeacherController@update'); //update teacher
    $router->delete('/teachers/{teacher_id}', '\App\Http\Controllers\TeacherController@destroy');// delete teacher
   
    /*all fields are required
    Dont allow user to remove a teacher with active courses.User need to delete the course first to delete the teacher first
   */

   $router->get('/students', '\App\Http\Controllers\StudentController@index'); //show all students*
   $router->post('/students', '\App\Http\Controllers\StudentController@store'); //create student*
   $router->get('/students/{student_id}', '\App\Http\Controllers\StudentController@show');//show the student with student_id*
   $router->put('/students/{student_id}', '\App\Http\Controllers\StudentController@update');// update the student with student_id*
   $router->patch('/students/{student_id}', '\App\Http\Controllers\StudentController@update'); //update the student with student_id
   $router->delete('/students/{student_id}', '\App\Http\Controllers\StudentController@destroy'); //delete the student with student_id

});


