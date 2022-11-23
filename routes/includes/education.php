<?php
/* -------------------------------------------------------------------------- */
/*                                 route user                                 */
/* -------------------------------------------------------------------------- */
use Illuminate\Support\Facades\Route;

    Route::post('/education/create','EducationsController@store');
    Route::post('/education/{id}', 'EducationsController@update');
    Route::delete('/education/{id}','EducationsController@destroy');
