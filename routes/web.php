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
use Notes\Http\Middleware\filevalidator;
use Notes\Http\Middleware\Logger;

Route::get('/',['uses' => 'Controller@mainPage', 'as' => 'main']);
Route::get('/login','Controller@loginPage');
Route::get('/register','Controller@registerPage');
Route::get('/profile',['uses' => 'Controller@myProfilePage', 'as' => 'profile'])->middleware('auth');
Route::get('/user/{user}','Controller@profilePage');
Route::post('/follow','Controller@follow')->middleware('auth');

Auth::routes();
/*






Route::get('/{department}/{course}/{section}/videos','SectionController@show_videos');
Route::get('/{department}/{course}/{section}/add_video','VideoController@create')->middleware('auth');
Route::post('/{department}/{course}/{section}/add_video','VideoController@store')->middleware('auth');



*/
Route::get('/add_department','DepartmentController@create')->middleware('auth');
Route::post('/add_department','DepartmentController@store')->middleware('auth','slug');

Route::get('/d/{department}-{name}','DepartmentController@show')->middleware('checkURL');
Route::get('/d/{department}-{name}/edit','DepartmentController@edit')->middleware('auth');
Route::get('/d/{department}-{name}/add_course','CourseController@create')->middleware('auth');


Route::get('/c/{course}-{name}','CourseController@show');
Route::get('/c/{course}-{name}/edit','CourseController@edit')->middleware('auth');
Route::get('/c/{course}-{name}/add_section','SectionController@create')->middleware('auth');

Route::get('/s/{section}-{name}','SectionController@show');
Route::get('/s/{section}-{name}/edit','SectionController@edit')->middleware('auth');
Route::get('/s/{section}-{name}/add_note','NoteController@create')->middleware('auth');

Route::get('/s/{section}-{name}/videos','SectionController@show_videos');
Route::get('/s/{section}-{name}/add_video','VideoController@create')->middleware('auth');

Route::post('/d/{department}-{name}/edit','DepartmentController@update')->middleware('auth','slug');
Route::post('/d/{department}-{name}/add_course','CourseController@store')->middleware('auth','slug');
Route::post('/c/{course}-{name}/edit','CourseController@update')->middleware('auth','slug');
Route::post('/c/{course}-{name}/add_section','SectionController@store')->middleware('auth','filevalidator','slug');
Route::post('/s/{section}-{name}/edit','SectionController@update')->middleware('auth','slug');
Route::post('/s/{section}-{name}/add_note','NoteController@store')->middleware('auth');
Route::post('/s/{section}-{name}/add_video','VideoController@store')->middleware('auth');

