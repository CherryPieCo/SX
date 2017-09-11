<?php

namespace App\Modules\Auth\Listeners;

use App\Modules\Auth\Events\ClientRegistered;
use Illuminate\Support\Facades\Mail;
use App\Modules\Auth\Mail\NewClientRegisteredNotify;

class NotifyAdminAboutNewClient
{

    public function handle(ClientRegistered $event)
    {
        $user = $event->user;
        // TODO:
        $adminEmails = [];
        
        Mail::to($adminEmails)->send(new NewClientRegisteredNotify($user));
    }
    
}