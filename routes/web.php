<?php
Route::get('/', 'HomeController@index');

Route::get('/avaliacoes', 'AssessmentsController@index');

Route::get('/contato', 'ContactController@index');
Route::get('/contato/email', 'ContactController@email');
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

Route::group(['namespace' => 'Auth'], function() {
    Route::group(['prefix' => 'login'], function() {
        Route::get('/', 'LoginController@showLogin')->name('login');
        Route::post('/', 'LoginController@login')->name('doLogin');
    });

    Route::get('/logout', 'LoginController@logout')->name('logout');
});

Route::group(['middleware' => ['web', 'auth'], 'namespace' => 'Dashboard'], function() {
    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('/', 'DashboardController@index')->name('dashboard.index');

        Route::get('/{page}', 'DashboardController@index');
    });

    Route::group(['prefix' => 'api'], function() {
        Route::get('/user', 'UserController@user')->name('dashboard.user');

        Route::get('/users', 'UserController@users')->name('dashboard.users');
    });
});
