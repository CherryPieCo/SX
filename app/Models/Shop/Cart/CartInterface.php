<?php

namespace App\Models\Shop\Cart;

interface CartInterface
{
    public function subtotal();

    public function total();
}
