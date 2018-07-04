<?php

Route::get('/', 'HomeController@index');

Route::get('/avaliacoes', 'AssessmentsController@index');

Route::prefix('contato')
    ->group(
        function () {
            Route::get('/', 'ContactController@index');
            Route::get('/email', 'ContactController@email');
            Route::post('/enviar', 'ContactController@sendEmail');
        }
    );

// News
Route::prefix('noticias')
    ->group(
        function () {
            Route::get('/', 'NewsController@index');
            Route::get('/{news}', 'NewsController@showNews');
        }
    );

// Photos
Route::get(config('photos.url.photos'), 'PhotosController@photos');
Route::get(config('photos.url.albums'), 'PhotosController@albums');
Route::get(config('photos.url.album') . '{id}', 'PhotosController@album')
    ->where('id', '[0-9]+');

// Schedule
Route::get('/horarios/{display?}', 'SchedulesController@index');

Route::get('/videos', 'VideosController@index');

Route::get('/sobre/{display?}', 'AboutController@index');

// Storage
Route::prefix('storage')
    ->group(
        function () {
            Route::get('/photos/{file}', 'PhotosController@getPhoto');

            Route::prefix('images')
                ->group(
                    function () {
                        Route::get('/view/{image}', 'ImagesController@image')
                            ->name('storage.images.view');
                        Route::post('/upload', 'ImagesController@upload');
                        Route::any('/delete', 'ImagesController@delete');
                    }
                );
        }
    );

// Json
/*Route::get('/json/{jsonFile}', function ($jsonFile) {
        $jsonPath = storage_path() . '/app/json/' . $jsonFile . '.json';

        return \json_decode(\file_get_contents($jsonPath), true);
    });*/

Route::namespace('Auth')
    ->group(
        function () {
            Route::prefix('login')
                ->group(
                    function () {
                        Route::get('/', 'LoginController@showLogin')->name('login');
                        Route::post('/', 'LoginController@login')->name('doLogin');
                    }
                );

            Route::get('/logout', 'LoginController@logout')->name('logout');
        }
    );

Route::middleware(['web', 'auth'])
    ->namespace('Dashboard')
    ->group(
        function () {
            Route::prefix('dashboard')
                ->group(
                    function () {
                        Route::get('/', 'DashboardController@index')
                            ->name('dashboard.index');

                        Route::get('/{page}', 'DashboardController@index');
                    }
                );

            Route::prefix('api')
                ->group(
                    function () {
                        Route::get('/user', 'UserController@user')
                            ->name('dashboard.user');

                        Route::get('/users', 'UserController@users')
                            ->name('dashboard.users');

                        Route::namespace('Schedules')
                            ->group(
                                function () {
                                    Route::prefix('schedules')
                                        ->group(
                                            function () {
                                                Route::get('/{id?}', 'SchedulesController@schedules')
                                                    ->where('id', '[0-9]+')
                                                    ->name('dashboard.schedules');
                                                Route::match(['post', 'put'], '/', 'SchedulesController@store')
                                                    ->name('dashboard.schedules.store');
                                                Route::any('/delete/', 'SchedulesController@delete')
                                                    ->name('dashboard.schedules.delete');
                                            }
                                        );

                                        Route::prefix('schedules-poles')
                                            ->group(
                                                function () {
                                                    Route::get('/{id?}', 'SchedulesPolesController@poles')
                                                        ->where('id', '[0-9]+')
                                                        ->name('dashboard.schedules.poles');
                                                    Route::match(['post', 'put'], '/', 'SchedulesPolesController@store')
                                                        ->name('dashboard.schedules.poles.store');
                                                    Route::any('/delete/', 'SchedulesPolesController@delete')
                                                        ->name('dashboard.schedules.poles.delete');
                                                }
                                            );

                                    Route::prefix('schedules-categories')
                                        ->group(
                                            function () {
                                                Route::get('/{id?}', 'SchedulesCategoriesController@categories')
                                                    ->where('id', '[0-9]+')
                                                    ->name('dashboard.schedules.categories');
                                                Route::match(['post', 'put'], '/', 'SchedulesCategoriesController@store')
                                                    ->name('dashboard.schedules.categories.store');
                                                Route::any('/delete/', 'SchedulesCategoriesController@delete')
                                                    ->name('dashboard.schedules.categories.delete');
                                            }
                                        );
                                }
                            );
                    }
                );
        }
    );
