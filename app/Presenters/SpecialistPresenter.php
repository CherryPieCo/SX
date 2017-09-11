<?php

namespace App\Presenters;

use Yaro\Presenter\AbstractPresenter;

class SpecialistPresenter extends AbstractPresenter
{
    
    protected $arrayable = [
        'id',
        'jwt_token',
        'phone',
        'email',
        'diploma_image',
    ];
    
}
