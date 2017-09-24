<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Models\User\Address;
use App\Modules\User\Http\Requests\Address\AddRequest;
use App\Modules\User\Http\Requests\Address\RemoveRequest;
use Illuminate\Http\Request;

class AddressController extends ApiController
{

    /**
     * List user's addresses.
     *
     * @param int $offset
     */
    public function getList(Request $request)
    {
        $offset = (int) $request->get('offset', 0);
        $addresses = auth()->user()->addresses()->take(20)->skip($offset)->get();

        return $this->success(compact('addresses'));
    }

    /**
     * Add new address for user.
     *
     * @param string $city
     * @param string $street
     * @param string $house
     * @param string $apartment
     * @param string $entrance
     * @param string $novapost_office
     * @param string $title
     */
    public function add(AddRequest $request)
    {
        $user = auth()->user();
        $address = $user->addresses()->create($request->only([
            'city',
            'street',
            'house',
            'apartment',
            'entrance',
            'novapost_office',
            'title',
        ]));

        return $this->success(compact('address'));
    }

    /**
     * Remove user's address.
     */
    public function remove($idAddress, RemoveRequest $request)
    {
        Address::destroy($idAddress);

        return $this->success();
    }



}
