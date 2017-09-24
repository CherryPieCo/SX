<?php

namespace App;

use App\Models\Shop\Order;
use App\Models\Shop\Product;
use App\Models\Shop\Cart;
use App\Models\User\Address;
use App\Presenters\SpecialistPresenter;
use Backpack\CRUD\CrudTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Yaro\Presenter\PresenterTrait;
use App\Presenters\ClientPresenter;
use JWTAuth;
use Image;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{

    use CrudTrait;
    use PresenterTrait;

    const TYPE_CLIENT = 'client';
    const TYPE_SPECIALIST = 'specialist';

    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    protected $table = 'users';

    protected $fillable = [];

    private static $carts = [];

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
     * `phone` mutator.
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = '+' . preg_replace('~[^\d]~', '', $value);
    }

    /**
     * `phone_extra` mutator.
     */
    public function setPhoneExtraAttribute($value)
    {
        $this->attributes['phone_extra'] = '+' . preg_replace('~[^\d]~', '', $value);
    }

    /**
     * `certificate_image` mutator.
     */
    public function setCertificateImageAttribute($image)
    {
        $filename = $image->hashName();

        Image::make($image)->save(storage_path('certificate_images') . DIRECTORY_SEPARATOR . $filename);

        $this->attributes['certificate_image'] = $filename;
    }

    /**
     * `diploma_image` mutator.
     */
    public function setDiplomaImageAttribute($image)
    {
        $filename = $image->hashName();

        Image::make($image)->save(storage_path('diploma_images') . DIRECTORY_SEPARATOR . $filename);

        $this->attributes['diploma_image'] = $filename;
    }

    public function getCertificateImageBase64Attribute($value)
    {
        $path = storage_path('certificate_images') . DIRECTORY_SEPARATOR . $this->certificate_image;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);

        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }

    public function getDiplomaImageBase64Attribute($value)
    {
        $path = storage_path('diploma_images') . DIRECTORY_SEPARATOR . $this->diploma_image;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);

        return 'data:image/' . $type . ';base64,' . base64_encode($data);
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

    public function cart(string $instance = 'default')
    {
        if (isset(self::$carts[$instance])) {
            return self::$carts[$instance];
        }

        $cart = Cart::where('instance', $instance)->first();
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => $this->id,
                'instance' => $instance,
                'products' => json_encode([]),
            ]);
        }

        return $cart;
    }

    public function favourites()
    {
        return $this->belongsToMany(Product::class, 'user_favourite_products');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->id;
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
