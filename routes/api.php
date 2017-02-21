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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('jwt.auth');

Route::post('auth','api\AuthenticateController@authenticate');
Route::get('auth/me','api\AuthenticateController@getAuthenticatedUser');

Route::get('jabatan/{code}/golongan.json', function($code)
{
    return \App\Golongan::where('jabatan_id', $code)->get();
});