<?php

namespace App\Models\Shop\Shipping;

use App\Models\Shop\Cart\CartInterface;
use App\Models\Shop\Shipping\ShippingInterface;

class PickupShipping implements ShippingInterface
{
    private $cart;

    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    public function total()
    {
        return 0;
    }
}