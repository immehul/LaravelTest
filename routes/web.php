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

Route::get('/home', 'HomeController@index')->name('home');

//Route::view('/{path?}', 'app');

//User Search Route
Route::post('/user/search', 'UserController@searchUser')->name('search');

//Sent User Request.
Route::get('/user/send/request/{id}', 'UserController@sendRequest');

//Get the list of my connection user
Route::get('myconnectionlist', 'UserController@getConnectionList');
