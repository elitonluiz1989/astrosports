<?php

Route::namespace('Commission')
    ->group(function () {
        Route::prefix('commission')
            ->middleware('dashboard.users:adm')
            ->group(function () {
                Route::get('/{id?}', 'CommissionController@commission')
                    ->where('id', '[0-9]+')
                    ->name('dashboard.commission');
                Route::post('/', 'CommissionController@store')
                    ->name('dashboard.commission.store');
                Route::any('/delete/', 'CommissionController@delete')
                    ->name('dashboard.commission.delete');
            });

        Route::prefix('commission-roles')
            ->middleware('dashboard.users:adm')
            ->group(function () {
                Route::get('/{id?}', 'CommissionRolesController@roles')
                    ->where('id', '[0-9]+')
                    ->name('dashboard.commission.roles');
                Route::match(['post', 'put'], '/', 'CommissionRolesController@store')
                    ->name('dashboard.commission.roles.store');
                Route::any('/delete/', 'CommissionRolesController@delete')
                    ->name('dashboard.commission.roles.delete');
            });
        });