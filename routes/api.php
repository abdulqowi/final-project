<?php

use Illuminate\Support\Facades\Route;

require_once('includes/auth.php');
Route::get('/education', 'EducationsController@index');

Route::group(
    ['middleware' => 'auth:api'],
    function () {
        Route::post('/user/edit', 'UserController@update');
        Route::post('/user/editpassword', 'UserController@changePassword');
        Route::get('/notification','NotificationController@index');
        Route::get('/poster','PosterController@index');
            Route::get('/schedule/payment','SchedulesController@payment');
                Route::get('/schedule/pickup','SchedulesController@pickup');
        Route::get('/transaction/user','TransactionsController@show');
        Route::get('/transaction','TransactionsController@index');
        Route::get('/user/{id}', 'UserController@show');
        Route::middleware('admin')->group(function () {
            require_once('includes/user.php');
        Route::get('/schedule','SchedulesController@index');
        Route::post('/transaction/payment/{id}', 'TransactionsController@payment');
            require_once('includes/transaction.php');
            require_once('includes/education.php');
            require_once('includes/master.php');
            require_once('includes/schedule.php');
            require_once('includes/masterPrice.php');
            require_once ('includes/Notification.php');
            require_once('includes/poster.php');
            
        });
    }
);
