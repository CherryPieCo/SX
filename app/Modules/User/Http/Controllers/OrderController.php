<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class OrderController extends ApiController
{

    /**
     * List user's orders.
     *
     * @param int $offset
     */
    public function getList(Request $request)
    {
        $offset = (int) $request->get('offset', 0);
        $orders = auth()->user()->orders()->take(20)->skip($offset)->get();

        return $this->success(compact('orders'));
    }

}
