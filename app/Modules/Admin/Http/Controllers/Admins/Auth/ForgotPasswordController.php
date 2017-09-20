<?php

namespace App\Modules\Admin\Http\Controllers\Admins\Auth;

use Backpack\Base\app\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    protected $data = []; // the information we send to the view

    protected $guard = 'admin';
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    protected function guard()
    {
        return Auth::guard($this->guard);
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    // -------------------------------------------------------
    // Laravel overwrites for loading backpack views
    // -------------------------------------------------------

    /**
     * Display the form to request a password reset link.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        $this->data['title'] = trans('backpack::base.reset_password'); // set the page title

        return view('backpack::auth.passwords.email', $this->data);
    }
}
