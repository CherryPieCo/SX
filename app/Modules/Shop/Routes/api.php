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


Route::group(['prefix' => 'shop'], function() {

    Route::get('catalog', 'CatalogController@catalog');

    Route::group(['prefix' => 'product/{id}'], function() {
        Route::get('/', 'ProductController@product');
        Route::get('review', 'ProductController@getReviews');
        Route::post('review', 'ProductController@saveReview');
    });


    Route::group(['prefix' => 'basket/{id}'], function() {
        Route::get('increase', 'BasketController@increase');
        Route::get('decrease', 'BasketController@decrease');
        Route::get('remove', 'BasketController@remove');
    });

});
