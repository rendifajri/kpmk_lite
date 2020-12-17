<?php

use Illuminate\Support\Facades\Route;

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

Route::get ('/', 'DashboardController@index');
Route::get ('dashboard', 'DashboardController@f_index');
Route::get ('backend/dashboard', 'DashboardController@index');

Route::get ('user/login', 'UserController@login');
Route::post('user/login/post', 'UserController@login_post');
Route::get ('user/logout', 'UserController@logout');
Route::get ('user', 'UserController@f_index');
Route::get ('user/profile/{id}', 'UserController@profile');
Route::post('user/profile/post', 'UserController@profile_post');
Route::get ('backend', 'UserController@index');
Route::get ('backend/user', 'UserController@index');
Route::post('backend/user/add/post', 'UserController@add_post');
Route::put ('backend/user/edit/post', 'UserController@edit_post');
Route::get ('backend/user/delete/{id}', 'UserController@delete');
Route::get ('backend/user/reset_password/{id}', 'UserController@reset_password');

Route::get ('program', 'ProgramController@f_index');
Route::get ('program/detail/{id}', 'ProgramController@f_detail');
Route::get ('program/detail/assignment/{topic_id}/{user_id}', 'ProgramController@assignment');

Route::get ('backend/assignment', 'AssignmentController@index');
Route::get ('backend/assignment/lock/{id}/{lock}/{div_id}', 'AssignmentController@lock');
Route::post('assignment/add/post', 'AssignmentController@add_post');
Route::post('assignment/comment/add/post', 'AssignmentController@comment_add_post');

Route::get ('backend/program', 'ProgramController@index');
Route::post('backend/program/add/post', 'ProgramController@add_post');
Route::put ('backend/program/edit/post', 'ProgramController@edit_post');
Route::get ('backend/program/delete/{id}', 'ProgramController@delete');

Route::get ('backend/topic', 'TopicController@index');
Route::post('backend/topic/add/post', 'TopicController@add_post');
Route::put ('backend/topic/edit/post', 'TopicController@edit_post');
Route::get ('backend/topic/delete/{id}', 'TopicController@delete');

Route::get ('backend/setting', 'SettingController@index');
Route::post('backend/setting/add/post', 'SettingController@add_post');
