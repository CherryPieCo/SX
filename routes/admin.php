<?php

Route::group(
[
    'namespace'  => 'App\Modules\Admin\Http\Controllers\Admins',
    'middleware' => 'web',
    'prefix'     => config('backpack.base.route_prefix'),
],
function () {
    // if not otherwise configured, setup the auth routes
    if (config('backpack.base.setup_auth_routes')) {
        Route::auth();
        Route::get('logout', 'Auth\LoginController@logout');
    }
});

