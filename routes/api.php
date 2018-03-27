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

Route::get('/chat', 'MessageController@index');

Route::get('/chat/history/{id}', 'MessageController@history');

Route::post('/chat', 'MessageController@store');