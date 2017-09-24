<?php

namespace App\Models\Shop;

use App\User;
use Yaro\Presenter\PresenterTrait;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use PresenterTrait;

    const STATUS_PENDING   = 'pending';
    const STATUS_PAYED     = 'payed';
    const STATUS_SHIPPED   = 'shipped';
    const STATUS_COMPLETED = 'completed';


    protected $presenter = OrderPresenter::class;

    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
