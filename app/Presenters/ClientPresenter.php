<?php

namespace App\Presenters;

use Yaro\Presenter\AbstractPresenter;

class ClientPresenter extends AbstractPresenter
{
    
    protected $arrayable = [
        'id',
        'jwt_token',
        'name',
        'patronymic',
        'surname',
        'salon_title',
        'city',
        'address',
        'phone',
        'phone_extra',
        'email',
        'certificate_image',
    ];
    
}
