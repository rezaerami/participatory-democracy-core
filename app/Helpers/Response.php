<?php


namespace App\Helpers;

use App\Constants\HttpStatus;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class Response
{
    public static function error($statusCode, $errors = []){
        $statusCode = in_array($statusCode, array_keys(HttpStatus::TITLE))
            ? $statusCode :
            HttpStatus::INTERNAL_SERVER_ERROR;

        $response = [
            "code" => $statusCode,
            "status" => HttpStatus::TITLE[$statusCode],
            "errors" => $errors
        ];

        return new HttpResponseException(response()->json($response, $statusCode));
    }

    /**
     * @param array $results
     * @param array $metadata
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function success($results = [], $metadata = [], $statusCode = HttpStatus::OK){
        $response = [
            "code" => $statusCode,
            "status" => HttpStatus::TITLE[$statusCode],
            "results" => $results,
            "metadata" => $metadata,
        ];
        return response()->json($response);
    }
}
