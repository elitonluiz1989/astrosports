<?php

Route::prefix('v1')
    ->middleware('api')
    ->group(function() {
        Route::match(['get', 'post'], '/test', function() {
            return ['done!'];
        });
        
        #Login
        Route::namespace('Auth')
            ->group(function () {
                Route::post('/login', 'LoginController@login')->name('api.login');
            });       

        Route::get('/user', 'UsersController@user')->where('id', '[0-9]+')->name('dashboard.user');

        Route::get('/users', 'UsersController@users')->name('dashboard.users');
    });