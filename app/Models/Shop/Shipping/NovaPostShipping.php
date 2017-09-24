<?php

namespace App\Models\Shop\Shipping;

use App\Models\Shop\Shipping\ShippingInterface;

class NovaPostShipping implements ShippingInterface
{
    private $cart;

    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    public function total()
    {
        // TODO: clarification
        return 0;
    }
}