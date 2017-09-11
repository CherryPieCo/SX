<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Modules\Auth\Events\ClientRegistered::class => [
            \App\Modules\Auth\Listeners\NotifyAdminAboutNewClient::class,
        ],
        \App\Modules\Auth\Events\SpecialistRegistered::class => [
            \App\Modules\Auth\Listeners\NotifyAdminAboutNewSpecialist::class,
        ],
        \App\Modules\Auth\Events\Restore\ForgotPassword::class => [
            \App\Modules\Auth\Listeners\SendResetPasswordEmail::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
