<?php

namespace App\Presenters;

use Yaro\Presenter\AbstractPresenter;

class ProductPresenter extends AbstractPresenter
{
    
    protected $arrayable = [
        'id',
        'sku',
        'title',
        'description',
        'price',
        'discount',
        'sale_price',
        'image',
        'quantity',
    ];
    
}
