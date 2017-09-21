<?php

Route::group(['prefix' => 'admin', 'middleware' => ['admin', 'web']], function() {

    Route::get('/', function(){
        dd(auth()->user());
    });

    CRUD::resource('clients', 'Clients\CrudController');
    CRUD::resource('specialists', 'Specialists\CrudController');

});
