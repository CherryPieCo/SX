<?php

namespace App\Modules\Auth\Http\Controllers;

use App\User;
use App\Http\Controllers\ApiController;
use App\Modules\Auth\Events\ClientRegistered;
use App\Modules\Auth\Events\SpecialistRegistered;
use App\Modules\Auth\Http\Requsts\RegisterClientRequest;
use App\Modules\Auth\Http\Requsts\RegisterSpecialistRequest;

class RegistrationController extends ApiController
{
    
    /**
     * Register new client account.
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
        //TODO: image
        
        $user->save();
        
        event(new ClientRegistered($user));
        
        $this->success(compact('user'));
    }
    
    /**
     * Register new specialist account.
     */
    public function specialist(RegisterSpecialistRequest $request)
    {
        $user = new User();
        $user->type   = User::TYPE_SPECIALIST;
        $user->status = User::STATUS_INACTIVE;
        $user->phone  = $request->get('phone');
        $user->email  = $request->get('email');
        //TODO: image
        
        $user->save();
        
        event(new SpecialistRegistered($user));
        
        $this->success(compact('user'));
    }
    
}
