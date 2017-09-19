<?php

namespace App\Models\Shop;

use App\Presenters\ProductReviewPresenter;
use Yaro\Presenter\PresenterTrait;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use PresenterTrait;

    protected $presenter = ProductReviewPresenter::class;

    protected $table = 'product_reviews';

    protected $fillable = [
        'product_id',
        'full_name',
        'description',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
