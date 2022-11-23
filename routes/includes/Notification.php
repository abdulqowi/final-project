<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('/notification' , 'NotificationController')->except('store','update','index');
Route::post('/notification/create','NotificationController@store');
Route::post('/notification/edit/{id}','NotificationController@update');
Route::post('/notification/send/{id}','NotificationController@send');
