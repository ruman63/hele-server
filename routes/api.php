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

Route::any('/places', 'ApiController@allPlaces');
Route::get('/places/refine', 'ApiController@showRefine');
Route::post('/places/refine', 'ApiController@refinePlaces');
Route::get('/categories', 'ApiController@allCategories');
Route::get('/places/{id}', 'ApiController@details')->where('id', '[0-9]+');
