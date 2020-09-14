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

Route::group(['middleware' => 'locale'], function() {
    Route::get('lang/{lang}', 'LangController@changeLang')->name('lang');
    Route::post('add-user/{id}', 'TaskController@addUser')->name('task-add-user');
    Route::delete('delete-user/{task_id}/{user_id}', 'TaskController@deleteUser')->name('task-delete-user');
    Route::resource('tasks', 'TaskController');
    Route::resource('users', 'UserController');
});
