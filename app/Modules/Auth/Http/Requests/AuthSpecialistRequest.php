<?php

namespace App\Modules\v1\Auth\Http\Requests;

use App\Http\Requests\ApiRequest;

class AuthClientRequest extends ApiRequest
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
            'phone' => 'required|string',
            'password' => 'required|string',
        ];
    }
}
