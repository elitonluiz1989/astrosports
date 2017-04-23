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

Route::get('/', 'HomeController@index');
Route::get('/avaliacoes', 'AssessmentsController@index');
Route::get('/contato', 'ContactController@index');

// Fotos module
Route::get('/fotos/{page?}', 'PhotosController@displayPhotos')->where('page', '[0-9]+');
Route::get('/fotos/albuns/{page?}', 'PhotosController@displayAlbums')->where('page', '[0-9]+');
Route::get('/fotos/album/{id}/{page?}', 'PhotosController@displayAlbum')->where('page', '[0-9]+');
Route::get('storage/photos/{file}', 'PhotosController@getPhoto');

Route::get('/horarios', 'SchedulesController@index');
Route::get('/videos', 'VideosController@index');
Route::get('/sobre', 'AboutController@index');
