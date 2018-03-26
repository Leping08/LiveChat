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

Auth::routes();

Route::get('/', 'PostController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::post('/', 'PostController@store');
    Route::get('/chat', 'MessageController@index');
    Route::post('/chat', 'MessageController@store');
    Route::get('/the-good-stuff/', 'PostController@index');
    Route::get('/the-good-stuff/{id}/', 'PostController@show');
    Route::post('/the-good-stuff/{id}/', 'CommentController@store');
    Route::get('/profile/', 'ProfileController@index');
});
