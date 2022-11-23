<?php
/* -------------------------------------------------------------------------- */
/*                                 route user                                 */
/* -------------------------------------------------------------------------- */

use Illuminate\Support\Facades\Route;

Route::get('/master', 'MasterController@index');
Route::post('/master/create', 'MasterController@store');
Route::post('/master/{id}', 'MasterController@update');
Route::delete('/master/{id}', 'MasterController@destroy');
