<?php
Route::get('/', 'HomeController@index');
Route::get('/avaliacoes', 'AssessmentsController@index');
Route::get('/contato', 'ContactController@index');

// Fotos module
Route::get('/fotos/{page?}', 'PhotosController@displayPhotos')->where('page', '[0-9]+');
Route::get('/fotos/albuns/{page?}', 'PhotosController@displayAlbums')->where('page', '[0-9]+');
Route::get('/fotos/album/{id}/{page?}', 'PhotosController@displayAlbum')->where('page', '[0-9]+');
Route::get('storage/photos/{file}', 'PhotosController@getPhoto');

Route::get('/horarios', 'SchedulesController@schedules');
Route::get('/horarios/polos', 'SchedulesController@poles');
Route::get('/horarios/categorias', 'SchedulesController@categories');

Route::get('/videos', 'VideosController@index');
Route::get('/sobre', 'AboutController@index');

Route::get('json/{model}', function($model) {
    $class = 'App\\Models\\' . $model;
    return $class::all();
});
