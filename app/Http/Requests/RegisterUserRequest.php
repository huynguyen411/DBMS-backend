<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class RegisterUserRequest extends FormRequest
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
            // 'role_id' => 'required',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:8|max:20|confirmed'

        ];
    }

    public function messages()
    {
        return [
            // 'role_id.required' => __('Chưa nhập thể loại.'),
            'name.required' => __('Chưa nhập tên người dùng.'),
            'address.required' => __('Chưa nhập địa chỉ.'),
            'email.required' => __('Chưa nhập email.'),
            'password.confirmed' =>__('Nhập lại mật khẩu không giống không trùng nhau'),
            'email.unique'=>__('Email đã tồn tại'),
        ];
    }

    public function filters()
    {
        return [
            'email' => 'trim|lowercase',
            'name' => 'trim|capitalize|escape'
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
