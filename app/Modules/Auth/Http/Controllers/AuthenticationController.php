<?php

namespace App\Modules\Auth\Http\Controllers;

use App\User;
use App\Http\Controllers\ApiController;
use App\Modules\Auth\Events\ClientRegistered;
use App\Modules\Auth\Events\SpecialistRegistered;
use App\Modules\Auth\Http\Requsts\AuthClientRequest;
use App\Modules\Auth\Http\Requsts\AuthSpecialistRequest;

class AuthenticationController extends ApiController
{
    
    /**
     * Auth client.
     */
    public function client(AuthClientRequest $request)
    {
        
    }
    
    /**
     * Auth specialist.
     */
    public function specialist(AuthSpecialistRequest $request)
    {
        
    }
    
}
