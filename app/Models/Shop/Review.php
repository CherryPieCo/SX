<?php

namespace App\Models;

use Yaro\Presenter\PresenterTrait;
use App\Presenters\ProductPresenter;
use JWTAuth;
use Image;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use PresenterTrait;

    const STATUS_ACTIVE   = 'active';
    const STATUS_INACTIVE = 'inactive';

    protected $presenter = ProductReviewPresenter::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
}
