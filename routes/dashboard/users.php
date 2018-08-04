<?php

Route::namespace('Users')
    ->group(function() {
        Route::get('/user', 'UsersController@user')->name('dashboard.user');

        Route::prefix('users')
            ->middleware('dashboard.users:adm')
            ->group(function () {
                Route::get('/{id?}', 'UsersController@users')
                    ->where('id', '[0-9]+')
                    ->name('dashboard.users');
                Route::match(['post', 'put'], '/', 'UsersController@store')
                    ->name('dashboard.users.store');
                Route::any('/delete/', 'UsersController@delete')
                    ->name('dashboard.users.delete');
            });

        Route::prefix('users-roles')
            ->middleware('dashboard.users:adm')
            ->group(function () {
                Route::get('/{id?}', 'UsersRolesController@roles')
                    ->where('id', '[0-9]+')
                    ->name('dashboard.users.roles');
                Route::match(['post', 'put'], '/', 'UsersRolesController@store')
                    ->name('dashboard.users.roles.store');
                Route::any('/delete/', 'UsersRolesController@delete')
                    ->name('dashboard.users.roles.delete');
            });

        Route::prefix('user-grants')
            ->middleware('dashboard.users:webmaster')
            ->group(function () {
                Route::get('/{id?}', 'UserGrantsController@grants')
                    ->where('id', '[0-9]+')
                    ->name('dashboard.user.grants');
                Route::match(['post', 'put'], '/', 'UserGrantsController@store')
                    ->name('dashboard.user.grants.store');
                Route::any('/delete/', 'UserGrantsController@delete')
                    ->name('dashboard.user.grants.delete');
            });
        });