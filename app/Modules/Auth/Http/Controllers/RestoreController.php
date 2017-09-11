<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\ApiController;
use App\Modules\Auth\Events\Restore\ForgotPassword;
use App\Modules\Auth\Http\Requests\Restore\PasswordForgotRequest;
use App\Modules\Auth\Http\Requests\Restore\PasswordConfirmRequest;
use App\User;

class RestoreController extends ApiController
{

    /**
     * Send email with `restore password` link.
     *
     * @param string $email
     */
    public function passwordForgot(PasswordForgotRequest $request)
    {
        $user = User::where('email', $request->get('email'))->first();
        if ($user) {
            event(new ForgotPassword($user));
        }

        return $this->success();
    }

    /**
     * Change password to new one.
     *
     * @param string $password
     * @param string $confirm_password
     * @param string $password_reset_token
     */
    public function passwordConfirm(PasswordConfirmRequest $request)
    {
        $user = User::where('password_reset_token', $request->get('password_reset_token'))->first();
        $user->password = $request->get('password');
        $user->invalidateResetPasswordToken();
        $user->save();

        return $this->success();
    }
    
}
