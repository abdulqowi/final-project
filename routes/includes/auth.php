<?php

use Illuminate\Support\Facades\Route;

Route::post('/register', 'AuthController@register');
Route::post('/login', 'AuthController@login')->name('login');
Route::group(
    [
        'prefix'    => 'auth',
    ], function () {
    });

Route::group(
    [
        'middleware'    => 'auth:api',
        'prefix'        => 'auth',
    ],
    function() {
        Route::post('/logout', 'AuthController@logout');
    }
);
