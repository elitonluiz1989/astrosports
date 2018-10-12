<?php

Route::group(['prefix' => 'v1', 'middleware' => 'api', 'namespace' => 'Dashboard'], function() {
    Route::get('/user', 'UsersController@user')->where('id', '[0-9]+')->name('dashboard.user');

    Route::get('/users', 'UsersController@users')->name('dashboard.users');
});
