<?php

namespace App\Modules\Auth\Http\Controllers;

use JWTAuth;
use App\Http\Controllers\ApiController;
use App\Modules\Auth\Http\Requests\AuthClientRequest;
use App\Modules\Auth\Http\Requests\AuthSpecialistRequest;

class AuthenticationController extends ApiController
{
    
    /**
     * Auth client.
     *
     * @param string $phone
     * @param string $password
     */
    public function client(AuthClientRequest $request)
    {
        $credentials = $request->only('phone', 'password');

        try {
            $token = JWTAuth::attempt($credentials);
            JWTAuth::setToken($token);
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            return $this->errors([
                'password' => [
                    trans('auth::user.not_found')
                ]
            ]);
        }

        return $this->success(compact('user'));
    }
    
    /**
     * Auth specialist.
     *
     * @param string $code
     */
    public function specialist(AuthSpecialistRequest $request)
    {
        
    }
    
}
