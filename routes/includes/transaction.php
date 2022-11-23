<?php

use Illuminate\Support\Facades\Route;

Route::post('/transaction', 'TransactionsController@store');
Route::post('/transaction/{id}', 'TransactionsController@update');
Route::delete('transaction/{id}','TransactionsController@destroy');

