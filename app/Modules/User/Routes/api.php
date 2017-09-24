<?php


Route::group(['prefix' => 'user'], function() {

    Route::group(['prefix' => 'personal'], function() {

        Route::patch('/', 'PersonalController@updateInfo');

        Route::group(['prefix' => 'address'], function() {
            Route::get('/', 'AddressController@getList');
            Route::post('/', 'AddressController@add');
            Route::delete('{address_id}', 'AddressController@remove');
        });

        Route::group(['prefix' => 'order'], function() {
            Route::get('/', 'OrderController@getList');
        });
    });

});
