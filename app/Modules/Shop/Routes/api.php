<?php


Route::group(['prefix' => 'shop'], function() {

    Route::get('catalog', 'CatalogController@catalog');

    Route::group(['prefix' => 'product/{product_id}'], function() {
        Route::get('/', 'ProductController@product');
        Route::get('review', 'ProductController@getReviews');
        Route::post('review', 'ProductController@saveReview');
    });


    Route::group(['prefix' => 'cart/{product_id}'], function() {
        Route::post('increase', 'CartController@increase');
        Route::post('decrease', 'CartController@decrease');
        Route::post('remove', 'CartController@remove');
    });

    Route::put('cart/shipping', 'CartController@shipping');


});
