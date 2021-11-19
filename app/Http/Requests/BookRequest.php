<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

use App\Rules\CheckIdType;
use App\Rules\CheckIdCountry;

class BookRequest extends FormRequest
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
            'name' => 'required',
            'author' => 'required',
            'publisher' => 'max:100',
            'publication_year' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'type_id.required' => __('Chưa nhập thể loại.'),
            'type_id.min' => __('Thể loại sách không tồn tại.'),
            'type_id.max' => __('Thể loại sách không tồn tại.'),
            'name_book.required' => __('Chưa nhập tên sách.'),
            'price.gte' => __('Giá sách phải lớn hơn hoặc bằng 0.'),
            'author.required' => __('Chưa nhập tên tác giả.'),
            'publication_date.date' => __('Kiểu dữ liệu phải là date.'),
            'book_image.image' => 'File phải là ảnh',
            'book_image.mimes' => 'File phải thuộc 1 trong các kiểu jpeg, png, jpg',
            'book_image.max' => 'Kích thước tối đa của file là :max kb',


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