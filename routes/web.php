<?php
Route::get('/', 'HomeController@index');

Route::get('/avaliacoes', 'AssessmentsController@index');

Route::get('/contato/{subject?}', 'ContactController@index');

// News
Route::get('/noticias', 'NewsController@index');

// Photos
Route::get(config('photos.url.photos'), 'PhotosController@showPhotos');
Route::get(config('photos.url.albums'), 'PhotosController@showAlbums');
Route::get(config('photos.url.albums') . '{id}', 'PhotosController@showAlbum')->where('id', '[0-9]+');
Route::get('storage/photos/{file}', 'PhotosController@getPhoto');

// Schedules
Route::get('/horarios/{display?}', 'SchedulesController@index');

Route::get('/videos', 'VideosController@index');

Route::get('/sobre/{display?}', 'AboutController@index');


// Remove production
Route::get('json/{model}', function($model) {
    $class = 'App\\Models\\' . $model;
    return $class::all();
});
