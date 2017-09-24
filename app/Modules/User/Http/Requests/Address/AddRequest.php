<?php

namespace App\Modules\User\Http\Requests\Address;

use App\Http\Requests\ApiRequest;

class AddRequest extends ApiRequest
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
            'city' => 'required',
            'street' => 'required',
            'house' => 'required',
            'apartment' => 'required',
            'entrance' => 'required',
            'novapost_office' => 'required',
            'title' => 'required',
        ];
    }
}
