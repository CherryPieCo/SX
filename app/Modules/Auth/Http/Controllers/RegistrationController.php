<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Presenters\SpecialistPresenter;
use App\User;
use App\Http\Controllers\ApiController;
use App\Modules\Auth\Events\ClientRegistered;
use App\Modules\Auth\Events\SpecialistRegistered;
use App\Modules\Auth\Http\Requests\RegisterClientRequest;
use App\Modules\Auth\Http\Requests\RegisterSpecialistRequest;

class RegistrationController extends ApiController
{
    
    /**
     * Register new client account.
     *
     * @param string $name
     * @param string $patronymic
     * @param string $surname
     * @param string $salon_title
     * @param string $city
     * @param string $address
     * @param string $phone
     * @param string $phone_extra
     * @param string $email
     * @param file   $certificate_image
     */
    public function client(RegisterClientRequest $request)
    {
        $user = new User();
        $user->type        = User::TYPE_CLIENT;
        $user->status      = User::STATUS_INACTIVE;
        $user->name        = $request->get('name');
        $user->patronymic  = $request->get('patronymic');
        $user->surname     = $request->get('surname');
        $user->salon_title = $request->get('salon_title');
        $user->city        = $request->get('city');
        $user->address     = $request->get('address');
        $user->phone       = $request->get('phone');
        $user->phone_extra = $request->get('phone_extra');
        $user->email       = $request->get('email');
        $user->certificate_image = $request->file('certificate_image');
        
        $user->save();
        
        event(new ClientRegistered($user));
        
        return $this->success(compact('user'));
    }
    
    /**
     * Register new specialist account.
     *
     * @param string $phone
     * @param string $email
     * @param file   $diploma_image
     */
    public function specialist(RegisterSpecialistRequest $request)
    {
        $user = new User();
        $user->type   = User::TYPE_SPECIALIST;
        $user->status = User::STATUS_INACTIVE;
        $user->phone  = $request->get('phone');
        $user->email  = $request->get('email');
        $user->diploma_image = $request->file('diploma_image');
        
        $user->save();

        event(new SpecialistRegistered($user));

        return $this->success(compact('user'));
    }
    
}
