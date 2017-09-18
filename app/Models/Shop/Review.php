<?php

namespace App\Models;

use App\Presenters\ProductReviewPresenter;
use Yaro\Presenter\PresenterTrait;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use PresenterTrait;

    const STATUS_ACTIVE   = 'active';
    const STATUS_INACTIVE = 'inactive';

    protected $presenter = ProductReviewPresenter::class;

    protected $table = 'product_reviews';

    protected $fillable = [
        'full_name',
        'description',
    ];

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function isActive()
    {
        return $this->status == self::STATUS_ACTIVE;
    }


    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
