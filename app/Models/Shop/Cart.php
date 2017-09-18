<?php

namespace App\Models;

use Yaro\Presenter\PresenterTrait;
use App\Presenters\ProductPresenter;
use JWTAuth;
use Image;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $table = 'shopping_cart';

    protected $fillable = [
        'instance',
        'user_id',
        'products',
    ];

    public function add($product, $qty = 1)
    {
        $idProduct = is_object($product) ? $product->id : $product;
        $data = json_decode($this->products, true) ?: [];

        if (isset($data[$idProduct])) {
            $data[$idProduct] = $data[$idProduct] + $qty;
        } else {
            $data[$idProduct] = $qty;
        }

        $this->products = json_encode($data);
        $this->save();
    }

    public function remove($product, $qty = 1)
    {
        $idProduct = is_object($product) ? $product->id : $product;
        $data = json_decode($this->products, true) ?: [];

        if (isset($data[$idProduct])) {
            $data[$idProduct] = $data[$idProduct] - $qty;
            if ($data[$idProduct] < 1) {
                unset($data[$idProduct]);
            }
        }

        $this->products = json_encode($data);
        $this->save();
    }

    public function getProductsAttribute($value)
    {
        $collection = collect([]);

        $ids = array_keys(json_decode($value, true));
        if ($ids) {
            $collection = Product::wereIn('id', $ids)->get();
        }

        return $collection;
    } // end products

    public function total()
    {
        return $this->products->sum('sale_price');
    }



}
