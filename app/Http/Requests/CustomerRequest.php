<?php

namespace App\Http\Requests;

class CustomerRequest extends ApiRequest
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
            'prefecture' => 'required|string',
            'city'       => 'required|string',
            'address'    => 'required|string',
            'customer_name' => 'required|string'
        ];
    }
}
