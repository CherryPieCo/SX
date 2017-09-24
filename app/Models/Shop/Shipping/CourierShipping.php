<?php

namespace App\Models\Shop\Shipping;

use App\Models\Shop\Shipping\ShippingInterface;

class CourierShipping implements ShippingInterface
{
    const FREE_SHIPPING_OVER = 1000;

    private $cart;

    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    public function total()
    {
        if ($this->cart->subtotal() >= self::FREE_SHIPPING_OVER) {
            return 0;
        }

        // TODO: clarification.
        return 0;
    }
}