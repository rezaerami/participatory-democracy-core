<?php

namespace App\Http\Requests\AuthRequests;

use App\Http\Requests\BaseRequest;

class AuthRefreshTokenRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => "required",
        ];
    }
}
