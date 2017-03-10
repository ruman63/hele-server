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

Route::get('/', 'PagesController@getIndex')->name('home');
Route::get('destinations', 'DestinationController@getDestinations')->name('destinations.index');
Route::get('contact', 'PagesController@getContact')->name('home.contact');
Route::get('about', 'PagesController@getAbout')->name('home.about');
Route::resource('places', 'PlacesController');
Route::resource('category','CategoryController', ['except' => ['create', 'edit']]);
Route::resource('tags', 'TagController');
Route::resource('reviews', 'ReviewController');

Auth::routes();

Route::get('home', 'HomeController@index');

//api
Route::get('api/all', 'ApiController@getAll');
