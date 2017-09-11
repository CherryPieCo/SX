<?php

namespace App\Modules\Auth\Events\Restore;

use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class ForgotPassword
{
    use Dispatchable, SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @param  Order  $order
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
