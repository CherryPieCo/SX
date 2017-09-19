<?php

namespace App\Models\Shop\Cart;

use App\Models\Shop\Product;

class CartItem
{

    private $product;
    private $price;
    private $qty;

    public function __construct(Product $product, $price, $qty)
    {
        $this->product = $product;
        $this->price = $price;
        $this->qty = $qty;
    }

    public function total()
    {
        return $this->price * $this->qty;
    }

}
