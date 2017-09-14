<?php

namespace App;

use App\Presenters\SpecialistPresenter;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Yaro\Presenter\PresenterTrait;
use App\Presenters\ClientPresenter;
use JWTAuth;
use Image;

class User extends Authenticatable
{
    use PresenterTrait;
    
    const TYPE_CLIENT     = 'client';
    const TYPE_SPECIALIST = 'specialist';
    
    const STATUS_ACTIVE   = 'active';
    const STATUS_INACTIVE = 'inactive';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];


    public function toArray()
    {
        $presenter = ClientPresenter::class;
        if ($this->type == self::TYPE_SPECIALIST) {
            $presenter = SpecialistPresenter::class;
        }

        $presenter = new $presenter($this);
        return $presenter->toArray();
    }

    /**
     * `password` mutator.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * `certificate_image` mutator.
     */
    public function setCertificateImageAttribute($image)
    {
        $filename = $image->hashName() .'.'. $image->getClientOriginalExtension();

        $destinationPath = storage_path('/certificate_images');
        Image::make($image)->save($destinationPath .'/'. $filename);

        $this->attributes['certificate_image'] = $filename;
    }

    /**
     * `diploma_image` mutator.
     */
    public function setDiplomaImageAttribute($image)
    {
        $filename = $image->hashName() .'.'. $image->getClientOriginalExtension();

        $destinationPath = storage_path('/diploma_images');
        Image::make($image)->save($destinationPath .'/'. $filename);

        $this->attributes['diploma_image'] = $filename;
    }

    /**
     * virtual `jwt_token` accessor.
     */
    public function getJwtTokenAttribute($value)
    {
        return JWTAuth::fromUser($this);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function generateNewResetPasswordToken($needSave = false)
    {
        do {
            $token = str_random(16);
        } while (self::where('password_reset_token', $token)->count());

        $this->password_reset_token = $token;
        if ($needSave) {
            $this->save();
        }

        return $this;
    }

    public function invalidateResetPasswordToken($needSave = false)
    {
        $this->password_reset_token = null;
        if ($needSave) {
            $this->save();
        }

        return $this;
    }

    public function isActive()
    {
        return $this->status == self::STATUS_ACTIVE;
    }
}
