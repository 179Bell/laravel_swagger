<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
