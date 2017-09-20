<?php

Route::get('/docs', function() {
    return ApiDocs::show();
})->middleware(['apidocs.auth.basic']);

Route::get('/', function () {
    return view('welcome');
});
