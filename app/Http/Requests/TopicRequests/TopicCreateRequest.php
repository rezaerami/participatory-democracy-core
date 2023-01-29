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
            "description" => "required|string|max:255",
            "content" => "required|string",
            "image" => [
                "required",
                "image",
                'mimes:' . FileConstants::ALLOWED_IMAGE_MIMES,
                'max:' . FileConstants::ALLOWED_IMAGE_SIZE,
            ],
            "polis_description" => "required|string|max:255",
            "polis_comments" => "array|max:10",
            "polis_comments.*" => "required|string|max:255",
        ];
    }
}
