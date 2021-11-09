<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => 'required|min:8|max:20',
            'new_password' => 'required|confirmed|min:8:max:20',

        ];
    }

    public function messages()
    {
        return [
            'old_password.required' => 'Bạn chưa nhập mật khẩu cũ',
            'old_password.min' => 'Mật khẩu tối thiểu có 8 ký tự',
            'old_password.max' => 'Mật khẩu tối đa có 20 ký tự',
            'new_password.min' => 'Mật khẩu tối thiểu có 8 ký tự',
            'new_password.max' => 'Mật khẩu tối đa có 20 ký tự',
            'new_password.confirmed' => 'Xác nhận mật khẩu không trùng khớp',

        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json([
            'errors' => $errors
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
