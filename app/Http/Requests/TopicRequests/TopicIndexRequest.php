<?php

namespace App\Http\Requests\TopicRequests;

use App\Constants\RequestConstants;
use App\Http\Requests\BaseRequest;

class TopicIndexRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "limit" => "numeric|min:1|max:" . RequestConstants::MAX_LIMIT,
            "offset" => "numeric|min:0|max:" . RequestConstants::MAX_OFFSET,
        ];
    }
}
