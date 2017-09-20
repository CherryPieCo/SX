<?php

namespace App\Modules\Auth\Http\Requests;

use App\Http\Requests\ApiRequest;

class RegisterClientRequest extends ApiRequest
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
            'name' => 'required|string',
            'patronymic' => 'required|string',
            'surname' => 'required|string',
            'salon_title' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|unique:users,phone',
            'phone_extra' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'certificate_image' => 'required|image',
        ];
    }
}
