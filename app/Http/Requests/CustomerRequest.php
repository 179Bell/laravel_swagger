<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CustomerRequest extends FormRequest
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
