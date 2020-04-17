<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/todo', 'TodoAPIController@index');
Route::get('/todo/{id}', 'TodoAPIController@show');
Route::post('/todo', 'TodoAPIController@store');
Route::patch('/todo/{id}', 'TodoAPIController@update');
Route::delete('/todo/{id}', 'TodoAPIController@destroy');