<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Notes\Department;
use Notes\Course;
use Illuminate\Http\Request;
use Notes\Http\Middleware\Logger;

Route::get('/',['uses' => 'Controller@mainPage', 'as' => 'main']);
Route::get('/login','Controller@loginPage');
Route::get('/register','Controller@registerPage');
// Cannot add department without authentication.
Route::get('/add_department','DepartmentController@create')->middleware('auth');
Route::post('/add_department',["uses" => "DepartmentController@store"])->middleware('auth','logger');
Route::get('/{department}','DepartmentController@show');
Route::get('/{department}/add_course','CourseController@create')->middleware('auth');
Route::post('/{department}/add_course','CourseController@store')->middleware('auth','logger');
Route::get('/{department}/{course}','CourseController@show');

Auth::routes();


