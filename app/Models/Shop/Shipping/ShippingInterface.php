<?php

namespace App\Models\Shop\Shipping;

interface ShippingInterface
{
    public function __construct(CartInterface $cart);
    public function total();
}