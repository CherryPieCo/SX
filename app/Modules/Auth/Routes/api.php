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

Route::group(['prefix' => 'auth', 'middleware' => ['api_auth_skip']], function () {
    
    Route::get('/', function(){
        die('hey');
    });
    
    Route::group(['prefix' => 'registration'], function () {
        Route::post('client', 'RegistrationController@client');
        Route::post('specialist', 'RegistrationController@specialist');
    });
    
    Route::group(['prefix' => 'authentication'], function () {
        Route::post('client', 'AuthenticationController@client');
        Route::post('specialist', 'AuthenticationController@specialist');
    });
    
});
