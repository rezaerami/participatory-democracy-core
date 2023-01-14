<?php

namespace App\Http\Requests\TopicRequests;

use App\Constants\FileConstants;
use App\Http\Requests\BaseRequest;

class TopicCreateRequest extends BaseRequest
{
    public function rules()
    {
        return [
            "title" => "required|string",
            "description" => "string|max:255|nullable",
            "content" => "required|string",
            "image" => [
                "required",
                "image",
                'mimes:' . FileConstants::ALLOWED_IMAGE_MIMES,
                'max:' . FileConstants::ALLOWED_IMAGE_SIZE,
            ]
        ];
    }
}
