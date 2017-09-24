<?php

namespace App\Presenters\User;

use Yaro\Presenter\AbstractPresenter;

class AddressPresenter extends AbstractPresenter
{
    
    protected $arrayable = [
        'city',
        'street',
        'house',
        'apartment',
        'entrance',
        'novapost_office',
        'title',
    ];
    
}
