<?php

namespace App\Http\Requests;

use App\Constants\HttpStatus;
use App\Helpers\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaserRequest extends FormRequest
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
            //
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw Response::error(HttpStatus::BAD_REQUEST, $validator->errors()->messages());
    }
}
