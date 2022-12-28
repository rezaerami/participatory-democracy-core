<?php

namespace App\Http\Requests\AuthRequests;

use App\Constants\CommonEnums;
use App\Constants\HttpStatus;
use App\Helpers\Response;
use App\Http\Requests\BaserRequest;

class AuthSsoCallbackRequest extends BaserRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        try {
            if (!in_array($this->route()->service, array_values(CommonEnums::SOCIALITE_SERVICES))) {
                throw Response::error(HttpStatus::BAD_REQUEST);
            }
            return true;
        } catch (\Exception $e) {
            throw Response::error($e->getCode(), $e->getMessage());
        }
    }
}
