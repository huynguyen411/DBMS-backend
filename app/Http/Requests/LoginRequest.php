<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Route;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class LoginRequest extends FormRequest
{

    // protected $redirectRoute = 'login';
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
            'email' => 'required|max:100',
            'password' => 'required|min:8|max:20'
        ];
        // return [];
    }

    public function messages()
    {
        return [
            'email.required' => __('Bạn chưa nhập Email.'),
            'password.required' => __('Bạn chưa nhập Mật khẩu.'),
            'email.max' => __('Email phải không được vượt quá 100 ký tự.'),
            'password.min' => __('Mật khẩu phải hơn 8 ký tự.'),
            'password.max' => __('Mật khẩu phải không được vượt quá 20 ký tự.')
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