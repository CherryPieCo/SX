<?php

namespace App\Modules\Auth\Http\Requests\Restore;

use App\Http\Requests\ApiRequest;

class PasswordConfirmRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'password_reset_token' => 'required|exists:users,password_reset_token',
        ];
    }
}
