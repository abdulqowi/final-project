<?php

use Illuminate\Support\Facades\Route;


Route::get('/schedule/{id}','SchedulesController@show');
Route::post('/schedule/create', 'SchedulesController@store');
Route::post('/schedule/{id}', 'SchedulesController@update');
Route::delete('/schedule/{id}','SchedulesController@destroy');


