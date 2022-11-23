<?php
/* -------------------------------------------------------------------------- */
/*                                 route user                                 */
/* -------------------------------------------------------------------------- */

use Illuminate\Support\Facades\Route;

Route::get('/price', 'MasterPriceController@index');
Route::post('/price/create', 'MasterPriceController@store');
Route::post('/price/{id}', 'MasterPriceController@update');
Route::delete('/price/{id}', 'MasterPriceController@destroy');
