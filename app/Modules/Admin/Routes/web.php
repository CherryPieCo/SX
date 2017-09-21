<?php

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin', 'web']], function() {



});
