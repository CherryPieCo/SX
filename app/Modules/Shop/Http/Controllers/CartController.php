<?php

namespace App\Modules\Shop\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use App\Modules\Shop\Http\Requests\Cart\AddRequest;
use Illuminate\Http\Request;

class CartController extends ApiController
{

    /**
     * Add product to cart.
     *
     * @param int $product_id
     * @param int $qty
     */
    public function add(AddRequest $request)
    {
        $cart = auth()->user()->cart();
        $cart->add($request->get('product_id'), $request->get('qty', 1));
        $products = $cart->products;

        return $this->success(compact('products'));
    }

    /**
     * Remove product from cart.
     *
     * @param int $product_id
     * @param int $qty
     */
    public function remove(RemoveRequest $request)
    {
        $cart = auth()->user()->cart();
        $cart->remove($request->get('product_id'), $request->get('qty', 1));
        $products = $cart->products;

        return $this->success(compact('products'));
    }

    /**
     * Get cart products.
     *
     * @param int $product_id
     * @param int $qty
     */
    public function content()
    {
        $cart = auth()->user()->cart();
        $products = $cart->products;

        return $this->success(compact('products'));
    }

}
