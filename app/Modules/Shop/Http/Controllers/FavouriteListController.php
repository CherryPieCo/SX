<?php

namespace App\Modules\Shop\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Modules\Shop\Http\Requests\Favourites\AddRequest;
use App\Modules\Shop\Http\Requests\Favourites\RemoveRequest;

class FavouriteListController extends ApiController
{

    /**
     * Get fav products.
     */
    public function getList()
    {
        $favourites = auth()->user()->favourites;

        return $this->success(compact('favourites'));
    }


    /**
     * Add fav product.
     */
    public function add($idProduct, AddRequest $request)
    {
        $user = auth()->user();
        $user->favourites()->attach($idProduct);
        $favourites = $user->favourites;

        return $this->success(compact('favourites'));
    }

    /**
     * Remove fav product.
     */
    public function remove($idProduct, RemoveRequest $request)
    {
        $user = auth()->user();
        $user->favourites()->detach($idProduct);
        $favourites = $user->favourites;

        return $this->success(compact('favourites'));
    }
}
