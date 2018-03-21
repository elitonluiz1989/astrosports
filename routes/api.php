<?php

Route::group(['prefix' => 'v1', 'middleware' => 'api', 'namespace' => 'Dashboard'], function() {
    Route::get('/user', 'UserController@user')->where('id', '[0-9]+')->name('dashboard.user');

    Route::get('/users', 'UserController@users')->name('dashboard.users');
});
