<?php

namespace App\Http\Requests;

class ProductRequest extends ApiRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'product_name'   => 'required|string',
            'product_origin' => 'required|string',
            'description' => 'required|max:100',
            'category_id' => 'required',
            'price'       => 'required'
        ];
    }
}
