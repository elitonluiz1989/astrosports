<?php
Route::get('/', 'HomeController@index');

Route::get('/avaliacoes', 'AssessmentsController@index');

Route::get('/contato/{subject?}', 'ContactController@index');
Route::post('/contato/enviar', 'ContactController@sendEmail');

// News
Route::get('/noticias', 'NewsController@index');
Route::get('/noticias/{news}', 'NewsController@showNews');

// Photos
Route::get(config('photos.url.photos'), 'PhotosController@photos');
Route::get(config('photos.url.albums'), 'PhotosController@albums');
Route::get(config('photos.url.album') . '{id}', 'PhotosController@album')->where('id', '[0-9]+');
Route::get('storage/photos/{file}', 'PhotosController@getPhoto');

// Schedules
Route::get('/horarios/{display?}', 'SchedulesController@index');

Route::get('/videos', 'VideosController@index');

Route::get('/sobre/{display?}', 'AboutController@index');


// Json
Route::get('/json/{jsonFile}', function($jsonFile) {
    $jsonPath = storage_path() . '/app/json/' . $jsonFile . '.json';

    return \json_decode(\file_get_contents($jsonPath), true);
});