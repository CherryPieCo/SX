<?php

namespace App\Modules\Auth\Listeners;

use App\Modules\Auth\Events\SpecialistRegistered;
use Illuminate\Support\Facades\Mail;
use App\Modules\Auth\Mail\NewSpecialistRegisteredNotify;

class NotifyAdminAboutNewSpecialist
{

    public function handle(SpecialistRegistered $event)
    {
        $user = $event->user;
        // TODO:
        $adminEmails = [];
        
        Mail::to($adminEmails)->send(new NewSpecialistRegisteredNotify($user));
    }
    
}