<?php

Route::namespace('Schedules')
    ->group(function () {
        Route::prefix('schedules')
            ->group(function () {
                Route::get('/{id?}', 'SchedulesController@schedules')
                    ->where('id', '[0-9]+')
                    ->name('dashboard.schedules');
                Route::match(['post', 'put'], '/', 'SchedulesController@store')
                    ->name('dashboard.schedules.store');
                Route::any('/delete/', 'SchedulesController@delete')
                    ->name('dashboard.schedules.delete');
            });

        Route::prefix('schedules-poles')
            ->group(function () {
                Route::get('/{id?}', 'SchedulesPolesController@poles')
                    ->where('id', '[0-9]+')
                    ->name('dashboard.schedules.poles');
                Route::match(['post', 'put'], '/', 'SchedulesPolesController@store')
                    ->name('dashboard.schedules.poles.store');
                Route::any('/delete/', 'SchedulesPolesController@delete')
                    ->name('dashboard.schedules.poles.delete');
            });

        Route::prefix('schedules-categories')
            ->group(function () {
                Route::get('/{id?}', 'SchedulesCategoriesController@categories')
                    ->where('id', '[0-9]+')
                    ->name('dashboard.schedules.categories');
                Route::match(['post', 'put'], '/', 'SchedulesCategoriesController@store')
                    ->name('dashboard.schedules.categories.store');
                Route::any('/delete/', 'SchedulesCategoriesController@delete')
                    ->name('dashboard.schedules.categories.delete');
            });
    });