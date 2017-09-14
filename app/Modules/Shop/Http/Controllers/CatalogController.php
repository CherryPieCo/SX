<?php

namespace App\Modules\Shop\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends ApiController
{

    /**
     * Get catalog products.
     *
     * @param int $offset
     */
    public function catalog(Request $request)
    {
        $offset = (int) $request->get('offset', 0);
        $products = Product::active()->skip($offset)->take(20);

        return $this->success(compact('products'));
    }

}
