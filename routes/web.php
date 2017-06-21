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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'HomeController@index')->name('home');

Route::group(['prefix' => 'queues', 'namespace' => 'Queue'], function() {
    Route::get('/', 'QueuesController@queues');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'UserController@index');
    Route::get('/create', 'UserController@create');
    Route::post('/create', 'UserController@store');
    Route::get('/update/{id}', 'UserController@edit');
    Route::post('/update/{id}', 'UserController@update');
    Route::delete('/{id}', 'UserController@destroy');
    Route::get('/{id}', 'UserController@show');
});