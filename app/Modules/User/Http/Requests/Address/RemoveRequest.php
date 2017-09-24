<?php

namespace App\Modules\User\Http\Requests\Address;

use App\Http\Requests\ApiRequest;

class RemoveRequest extends ApiRequest
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
            'address_id' => 'required|exists:addresses,id|belongs_to_user:addresses',
        ];
    }

    /**
     * Add parameters to be validated
     *
     * @return array
     */
    public function all()
    {
        return array_replace_recursive(
            parent::all(),
            $this->route()->parameters()
        );
    }
}
