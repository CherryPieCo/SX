<?php

namespace App\Modules\Shop\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use App\Models\Review;
use App\Modules\Shop\Http\Requests\ProductRequest;
use App\Modules\Shop\Http\Requests\Review\ListRequest;
use App\Modules\Shop\Http\Requests\Review\SaveRequest;

class FavouriteListController extends ApiController
{

    /**
     * Get single product.
     *
     * @param int $offset
     */
    public function product($id, ProductRequest $request)
    {
        $product = Product::active()->find($id);

        return $this->success(compact('product'));
    }

    /**
     * Get fav products.
     */
    public function getList($idProduct, ListRequest $request)
    {
        $reviews = Product::find($idProduct)->reviews;

        return $this->success(compact('reviews'));
    }


    /**
     * Add fav product.
     */
    public function add($idProduct, SaveRequest $request)
    {
        $review = Review::create([
            'product_id'  => $idProduct,
            'full_name'   => $request->get('full_name'),
            'description' => $request->get('description'),
        ]);

        return $this->success(compact('review'));
    }

    /**
     * Remove fav product.
     */
    public function remove($idProduct, SaveRequest $request)
    {
        $review = Review::create([
            'product_id'  => $idProduct,
            'full_name'   => $request->get('full_name'),
            'description' => $request->get('description'),
        ]);

        return $this->success(compact('review'));
    }
}
