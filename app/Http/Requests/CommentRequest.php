<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'borrower_id' => 'required',
            'book_id' => 'required',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'borrower_id.required' => __('Chưa nhập người dùng.'),
            'book_id.required' => __('Chưa nhập sách.'),
            'content.required' => __('Chưa nhập nội dung bình luận.'),
        ];
    }
}