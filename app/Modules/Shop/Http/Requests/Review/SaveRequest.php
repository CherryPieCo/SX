<?php

namespace App\Modules\Shop\Http\Requests\Review;

use App\Http\Requests\ApiRequest;

class SaveRequest extends ApiRequest
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
            'product_id'  => 'required|exists:products,id',
            'full_name'   => 'required',
            'description' => 'required',
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
