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

Route::post('/registro/create', 'RegistrosController@store');
Route::get('/registro/edit/{id}', 'RegistrosController@show');
Route::post('/registro/update/{id}', 'RegistrosController@update');
Route::delete('/registro/delete/{id}', 'RegistrosController@delete');
Route::get('/registros', 'RegistrosController@index');

Route::get('/blacklist', 'RegistrosController@blacklist');
Route::post('/blacklist/delete/{id}', 'RegistrosController@delBlacklist');
Route::post('/blacklist/create/{id}', 'RegistrosController@addBlacklist');