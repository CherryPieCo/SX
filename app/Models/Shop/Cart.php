<?php

namespace App\Models\Shop;

use App\Models\Shop\Cart\CartInterface;
use App\Models\Shop\Cart\CartItem;
use App\Models\Shop\Shipping\CourierShipping;
use App\Models\Shop\Shipping\NovaPostShipping;
use App\Models\Shop\Shipping\PickupShipping;
use App\Presenters\Shop\CartPresenter;
use Illuminate\Database\Eloquent\Model;
use Yaro\Presenter\PresenterTrait;

class Cart extends Model implements CartInterface
{

    use PresenterTrait;

    protected $table = 'shopping_cart';

    protected $presenter = CartPresenter::class;

    protected $fillable = [
        'instance',
        'user_id',
        'products',
        'shipping_method',
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
        $collection = [];

        $products = json_decode($value, true);
        foreach ($products as $id => $qty) {
            $product = Product::active()->where('id', $id)->first();
            if ($product) {
                $collection[] = new CartItem($product, $product->sale_price, $qty);
            }
        }

        return collect($collection);
    } // end products

    public function subtotal()
    {
        $sum = 0;
        foreach ($this->products as $cartItem) {
            $sum += $cartItem->total();
        }

        return $sum;
    }

    public function total()
    {
        return $this->subtotal() + $this->shipping()->total();
    }

    public function shipping()
    {
        switch ($this->shipping_method) {
            case 'courier':
                return new CourierShipping($this);
            case 'novapost':
                return new NovaPostShipping($this);
            case 'pickup':
            default:
                return new PickupShipping($this);
        }
    }

    public function setShipping($method)
    {
        $this->shipping_method = $method;
        $this->save();
    }



}
