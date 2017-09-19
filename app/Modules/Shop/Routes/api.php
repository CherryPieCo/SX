<?php


Route::group(['prefix' => 'shop'], function() {

    Route::get('catalog', 'CatalogController@catalog');

    Route::group(['prefix' => 'product/{product_id}'], function() {
        Route::get('/', 'ProductController@product');
        Route::get('review', 'ProductController@getReviews');
        Route::post('review', 'ProductController@saveReview');
    });


    Route::group(['prefix' => 'basket/{product_id}'], function() {
        Route::get('increase', 'BasketController@increase');
        Route::get('decrease', 'BasketController@decrease');
        Route::get('remove', 'BasketController@remove');
    });

});
