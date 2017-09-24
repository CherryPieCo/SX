<?php

namespace App\Models\User;

use App\Presenters\User\AddressPresenter;
use App\User;
use Yaro\Presenter\PresenterTrait;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use PresenterTrait;

    protected $presenter = AddressPresenter::class;

    protected $table = 'addresses';

    protected $fillable = [
        'city',
        'street',
        'house',
        'apartment',
        'entrance',
        'novapost_office',
        'title',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
