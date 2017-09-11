<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Yaro\Presenter\PresenterTrait;
use App\Presenters\ClientPresenter;

class User extends Authenticatable
{
    use PresenterTrait;
    
    const TYPE_CLIENT     = 'client';
    const TYPE_SPECIALIST = 'specialist';
    
    const STATUS_ACTIVE   = 'active';
    const STATUS_INACTIVE = 'inactive';

    protected $presenter = ClientPresenter::class;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
