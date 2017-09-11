<?php

namespace App\Modules\Auth\Listeners;

use App\Modules\Auth\Events\Restore\ForgotPassword;
use Illuminate\Support\Facades\Mail;
use App\Modules\Auth\Mail\ResetPasswordEmail;

class SendResetPasswordEmail
{

    public function handle(ForgotPassword $event)
    {
        $user = $event->user;
        $user->generateNewResetPasswordToken(true);

        Mail::to($user->email)->send(new ResetPasswordEmail($user));
    }
    
}