<?php

use Illuminate\Support\Facades\Route;

Route::post('/poster/create', 'PosterController@store');
Route::post('/poster/{id}', 'PosterController@update');
Route::delete('poster/{id}','PosterController@destroy');

