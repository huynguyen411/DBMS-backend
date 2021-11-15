<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckIdBook;
use App\Rules\CheckIdUser;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class RentalRequest extends FormRequest
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
            'book_id' => [new CheckIdBook],
            'rental_date' => 'required|date',
            'promissory_date' => 'required|date|after_or_equal:from_date',
            'user_id' => ['required', new CheckIdUser]
        ];
    }

    public function messages()
    {
        return [
            'rental_date.required' => "Ngày mượn không được để trống",
            'rental_date.date' => "Ngày mượn có kiểu dữ liệu datetime",
            'promissory_date.required' => "Ngày trả không được để trống",
            'promissory_date.date' => "Ngày hứa trả có kiểu dữ liệu datetime",
            'promissory_date.after_or_equal' => "Ngày hứa trả phải lớn hơn hoặc bằng ngày mượn",
            'user_id.required' => 'Id người mượn không được để trống',

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