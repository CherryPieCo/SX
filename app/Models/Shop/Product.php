<?php

namespace App\Models\Shop;

use Yaro\Presenter\PresenterTrait;
use App\Presenters\ProductPresenter;
use JWTAuth;
use Image;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use PresenterTrait;

    const STATUS_ACTIVE   = 'active';
    const STATUS_INACTIVE = 'inactive';

    protected $presenter = ProductPresenter::class;

    protected $table = 'products';

    protected $fillable = [
        'sku',
        'title',
        'description',
        'price',
        'discount',
        'sale_price',
        'image',
        'quantity',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function isActive()
    {
        return $this->status == self::STATUS_ACTIVE;
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->orderBy('created_at', 'desc');
    }


}
