<?php

namespace App\Presenters\Shop;

use Yaro\Presenter\AbstractPresenter;

class CartPresenter extends AbstractPresenter
{
    
    protected $arrayable = [
        'instance',
        'subtotal',
        'total',
        'shipping_method',
        'products',
    ];

    public function getSubtotalPresenter()
    {
        return $this->model->subtotal();
    }

    public function getTotalPresenter()
    {
        return $this->model->total();
    }
    
}
