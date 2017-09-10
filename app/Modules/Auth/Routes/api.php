<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'auth'], function () {
    
    Route::group(['prefix' => 'registration'], function () {
    
        Route::post('client', 'RegistrationController@registerClient');
        Route::post('specialist', 'RegistrationController@registerSpecialist');
        
    });
    
});
