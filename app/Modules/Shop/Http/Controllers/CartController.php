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

        return $this->success(compact('cart'));
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

        return $this->success(compact('cart'));
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

        return $this->success(compact('cart'));
    }

    /**
     * Set shipping.
     *
     * @param string $shipping_method
     */
    public function shipping(SetShippingRequest $request)
    {
        $cart = auth()->user()->cart();
        $cart->setShipping($request->get('shipping_method'));

        return $this->success(compact('cart'));
    }

}
