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
Route::get('/profile',['uses' => 'Controller@myprofilePage', 'as' => 'profile'])->middleware('auth');
Route::get('/settings',['uses' => 'Controller@settingsPage', 'as' => 'settings'])->middleware('auth');
Route::get('/profile/{user}','Controller@profilePage');


Auth::routes();


Route::post('/follow','Controller@follow')->middleware('auth');
// Cannot add department without authentication.
Route::get('/add_department','DepartmentController@create')->middleware('auth');
Route::post('/add_department',["uses" => "DepartmentController@store"])->middleware('auth','slug');

Route::get('/{department}','DepartmentController@show');
Route::get('/{department}/edit','DepartmentController@edit')->middleware('auth');
Route::post('/{department}/edit','DepartmentController@update')->middleware('auth','slug');

Route::get('/{department}/add_course','CourseController@create')->middleware('auth');
Route::post('/{department}/add_course','CourseController@store')->middleware('auth','slug');
Route::get('/{department}/{course}','CourseController@show');
Route::get('/{department}/{course}/edit','CourseController@edit')->middleware('auth');
Route::post('/{department}/{course}/edit','CourseController@update')->middleware('auth','slug');
Route::get('/{department}/{course}/add_section','SectionController@create')->middleware('auth');
Route::post('/{department}/{course}/add_section','SectionController@store')->middleware('auth','filevalidator','slug');
Route::get('/{department}/{course}/{section}','SectionController@show');
Route::get('/{department}/{course}/{section}/edit','SectionController@edit')->middleware('auth');
Route::post('/{department}/{course}/{section}/edit','SectionController@update')->middleware('auth','slug');
Route::get('/{department}/{course}/{section}/add_note','NoteController@create')->middleware('auth');
Route::post('/{department}/{course}/{section}/add_note','NoteController@store')->middleware('auth');
Route::get('/{department}/{course}/{section}/videos','SectionController@show_videos');
Route::get('/{department}/{course}/{section}/add_video','VideoController@create')->middleware('auth');
Route::post('/{department}/{course}/{section}/add_video','VideoController@store')->middleware('auth');








