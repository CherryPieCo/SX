<?php

namespace App\Modules\Auth\Http\Requests;

use App\Http\Requests\ApiRequest;

class RegisterSpecialistRequest extends ApiRequest
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
            'phone' => 'required|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'diploma_image' => 'required|image',
        ];
    }
}
