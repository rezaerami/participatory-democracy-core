<?php

namespace App\Http\Requests\AuthRequests;

use App\Constants\CommonEnums;
use App\Constants\HttpStatus;
use App\Helpers\Response;
use App\Http\Requests\BaseRequest;

class AuthSsoCallbackRequest extends BaseRequest
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
            throw new \Error(HttpStatus::TITLE[HttpStatus::BAD_REQUEST], HttpStatus::BAD_REQUEST);
        }

        return true;
        } catch (\Exception $e) {
            throw Response::error($e->getCode(), $e->getMessage());
        }
    }
}
