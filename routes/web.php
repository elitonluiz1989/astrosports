<?php
Route::get('/', 'HomeController@index');

Route::get('/avaliacoes', 'AssessmentsController@index');

Route::get('/contato', 'ContactController@index');

// News module
Route::get('/noticias', 'NewsController@index');

// Fotos module
Route::get(config('photos.url.photos'), 'PhotosController@showPhotos');
Route::get(config('photos.url.albums'), 'PhotosController@showAlbums');
Route::get(config('photos.url.albums') . '{id}', 'PhotosController@showAlbum')->where('id', '[0-9]+');
Route::get('storage/photos/{file}', 'PhotosController@getPhoto');

// Schedules module
Route::get('/horarios', 'SchedulesController@index');
Route::get('/horarios/{display?}', 'SchedulesController@index');

Route::get('/videos', 'VideosController@index');

Route::get('/sobre/{display?}', 'AboutController@index');


// Remove production
Route::get('json/{model}', function($model) {
    $class = 'App\\Models\\' . $model;
    return $class::all();
});
