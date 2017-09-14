<?php

namespace App\Modules\Shop\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends ApiController
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
     * Get product reviews.
     */
    public function getReviews($idProduct, Request $request)
    {

    }


    /**
     * Save new review.
     */
    public function saveReview($idProduct,  Request $request)
    {

    }
}
