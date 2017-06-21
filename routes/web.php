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
Route::post('/dashboard', 'HomeController@createAppointment');

Route::group(['prefix' => 'queues', 'namespace' => 'Queue'], function() {
    Route::get('/', 'QueuesController@queues');
    Route::post('/', 'QueuesController@addQueue');
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'UserController@index');
    Route::get('/create', 'UserController@create');
    Route::post('/create', 'UserController@store');
    Route::get('/update/{id}', 'UserController@edit');
    Route::post('/update/{id}', 'UserController@update');
    Route::delete('/{id}', 'UserController@destroy');
});

Route::group(['prefix' => 'patients'], function () {
    Route::get('/', 'PatientController@index');
    Route::get('/create', 'PatientController@create');
    Route::post('/create', 'PatientController@store');
    Route::get('/update/{id}', 'PatientController@edit');
    Route::post('/update/{id}', 'PatientController@update');
    Route::delete('/{id}', 'PatientController@destroy');
});