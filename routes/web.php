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
Route::get('destinations/{id}', 'DestinationController@show')->name('destinations.show');
Route::get('contact', 'PagesController@getContact')->name('home.contact');
Route::get('about', 'PagesController@getAbout')->name('home.about');
Route::resource('places', 'PlacesController');
Route::resource('category','CategoryController', ['except' => ['create', 'edit']]);
Route::resource('tags', 'TagController');

Route::post('reviews/{place_id}', 'ReviewController@store')->name('reviews.store');

Route::get('photos', 'PhotoController@index')->name('photos.index');
Route::post('photos/place/{place_id}', 'PhotoController@store')->name('photos.store');
Route::get('photos/place/{place_id}', 'PhotoController@showPlace')->name('photos.showplace');
Route::get('photos/place/{place_id}/add', 'PhotoController@add')->name('photos.add');
Route::delete('photos/{id}', 'PhotoController@destroy')->name('photos.destroy');
Route::get('photos/{id}', 'PhotoController@show')->name('photos.show');




Auth::routes();

Route::get('home', 'HomeController@index');
