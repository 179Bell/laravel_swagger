<?php

namespace App\Http\Requests;

class OrderRequest extends ApiRequest
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
            'order_date' => 'required|date',
            'quantity' => 'required|string',
            'product_id' => 'required|string|exists:products,id',
            'customer_id' => 'required|string|exists:customers,id',
        ];
    }
}
