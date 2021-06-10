<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('index/', 'App\Http\Controllers\Controller@indexPage');

Route::get('adduser/', 'App\Http\Controllers\UserController@addUserPage');
Route::post('adduserconfirm/', 'App\Http\Controllers\UserController@addUserConfirm');
Route::get('showusers/', 'App\Http\Controllers\UserController@showUsers');
Route::get('deleteUser{id}', 'App\Http\Controllers\UserController@deleteUser');
Route::get('editUser{id}', 'App\Http\Controllers\UserController@editUser');
Route::post('editUserConfirm', 'App\Http\Controllers\UserController@editUserConfirm');
Route::get('showAdminPanel', 'App\Http\Controllers\UserController@showAdminPanel');
Route::post('changeAdminData', 'App\Http\Controllers\UserController@changeAdminData');

Route::get('groupDetails{id}', 'App\Http\Controllers\GroupController@groupDetails');
Route::get('addGroup', 'App\Http\Controllers\GroupController@addGroup');
Route::post('addGroupConfirm', 'App\Http\Controllers\GroupController@addGroupConfirm');
Route::post('addToGroupConfirm', 'App\Http\Controllers\GroupController@addToGroupConfirm');

Route::get('showQuestions', 'App\Http\Controllers\QuestionController@showQuestions');
Route::post('addQuestionConfirm', 'App\Http\Controllers\QuestionController@addQuestionConfirm');

Route::get('showTests', 'App\Http\Controllers\TestController@showTests');
Route::post('addTestConfirm', 'App\Http\Controllers\TestController@addTestConfirm');
Route::get('testDetails{id}', 'App\Http\Controllers\TestController@testDetails');
Route::post('addQuestionToTestConfirm', 'App\Http\Controllers\TestController@addQuestionToTestConfirm');
Route::post('assignStudentToTest', 'App\Http\Controllers\TestController@assignStudentToTest');
Route::post('assignGroupToTest', 'App\Http\Controllers\TestController@assignGroupToTest');

Route::get('showUserTests', 'App\Http\Controllers\TestController@showStudentTests');
Route::get('showTestToSolve{id}', 'App\Http\Controllers\TestController@showTestToSolve');
Route::post('showTestToSolveValidate', 'App\Http\Controllers\TestController@showTestToSolveValidate');
