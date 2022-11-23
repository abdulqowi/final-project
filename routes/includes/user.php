<?php
/* -------------------------------------------------------------------------- */
/*                                 route user                                 */
/* -------------------------------------------------------------------------- */
use Illuminate\Support\Facades\Route;

Route::get('/user', 'UserController@index');

Route::delete('/user/{id}', 'UserController@destroy');
