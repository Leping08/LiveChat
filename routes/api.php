<?php

use Illuminate\Http\Request;
use App\Message;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/chat', 'Api\MessageController@index');

Route::get('/chat/history/{id}', 'Api\MessageController@history');

Route::post('/chat', 'Api\MessageController@store');

Route::get('/events', 'Api\EventController@index');