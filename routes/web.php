<?php

Route::get('/', 'HomeController@index');

Route::get('/avaliacoes', 'AssessmentsController@index');

Route::prefix('contato')
    ->group(function () {
        Route::get('/', 'ContactController@index');
        Route::get('/email', 'ContactController@email');
        Route::post('/enviar', 'ContactController@sendEmail');
    });

// News
Route::prefix('noticias')
    ->group(function () {
        Route::get('/', 'NewsController@index');
        Route::get('/{news}', 'NewsController@showNews');
    });

// Photos
Route::get(config('photos.url.photos'), 'PhotosController@photos');
Route::get(config('photos.url.albums'), 'PhotosController@albums');
Route::get(config('photos.url.album') . '{id}', 'PhotosController@album')->where('id', '[0-9]+');

// Schedule
Route::get('/horarios/{display?}', 'SchedulesController@index');

Route::get('/videos', 'VideosController@index');

Route::get('/sobre/{display?}', 'AboutController@index');

// Storage
Route::prefix('storage')
    ->group(function () {
        Route::get('/photos/{file}', 'PhotosController@getPhoto');

        Route::prefix('images')
            ->group(function () {
                Route::get('/view/{image}', 'ImagesController@image')
                    ->name('storage.images.view');
                Route::post('/upload', 'ImagesController@upload');
                Route::any('/delete', 'ImagesController@delete');
            });
    });

// Json
Route::get('/json/{jsonFile}', function ($jsonFile) {
    $jsonPath = storage_path() . '/app/json/' . $jsonFile . '.json';

    return \json_decode(\file_get_contents($jsonPath), true);
});

Route::namespace('Auth')
    ->group(function () {
        Route::prefix('login')
            ->group(function () {
                Route::get('/', 'LoginController@showLogin')->name('login');
                Route::post('/', 'LoginController@login')->name('doLogin');
            });

        Route::get('/logout', 'LoginController@logout')->name('logout');
    });

Route::middleware(['web', 'auth'])
    ->namespace('Dashboard')
    ->group(function () {
        Route::prefix('dashboard')
            ->group(function () {
                Route::get('/', 'DashboardController@index')
                    ->name('dashboard.index');

                Route::get('/{page}', 'DashboardController@index');
            });

        Route::prefix('api')
            ->middleware('api.response')
            ->group(function () {
                require_once __DIR__ . '/dashboard/users.php';

                require_once __DIR__ . '/dashboard/schedules.php';
            });
    });
