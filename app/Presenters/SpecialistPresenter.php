<?php

namespace App\Presenters;

use Yaro\Presenter\AbstractPresenter;

class ClientPresenter extends AbstractPresenter
{
    
    protected $arrayable = [
        'phone',
        'email',
        'diploma_image',
    ];
    
}
