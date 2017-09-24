<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\ApiController;

class PersonalController extends ApiController
{

    /**
     * Update user info.
     *
     * @param string $name
     * @param string $patronymic
     * @param string $surname
     * @param string $salon_title
     * @param string $city
     * @param string $address
     * @param string $phone
     * @param string $password
     * @param string $password_confirmation
     */
    public function updateInfo(UpdateRequest $request)
    {
        $data = $request->only([
            'name',
            'patronymic',
            'surname',
            'salon_title',
            'city',
            'address',
            'phone',
            'password',
        ]);
        $user = auth()->user();

        foreach ($data as $key => $val) {
            $user->{$key} = $val;
        }
        $user->save();

        return $this->success(compact('user'));
    }

}
