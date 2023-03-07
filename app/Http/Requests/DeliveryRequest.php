<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class DeliveryRequest extends FormRequest
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
            'delivery_date' => 'required|date',
            'quantity' => 'required|string',
            'product_id' => 'required|string|exists:products,id',
            'customer_id' => 'required|string|exists:customers,id',
        ];
    }

    /**
     * バリデーションエラーをリクエスト先に返す
     *
     * @param Validator $validator
     * @return HttpResponseException
     */
    public function failedValidation(Validator $validator): HttpResponseException
    {
        $response = response()->json([
            'summary' => 'エラーが発生しました',
            'status'  => 422,
            'errors'  => $validator->errors()->toArray(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
