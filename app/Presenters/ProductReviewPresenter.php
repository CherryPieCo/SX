<?php

namespace App\Presenters;

use Yaro\Presenter\AbstractPresenter;

class ProductReviewPresenter extends AbstractPresenter
{
    
    protected $arrayable = [
        'full_name',
        'description',
        'created_at',
    ];
    
}
