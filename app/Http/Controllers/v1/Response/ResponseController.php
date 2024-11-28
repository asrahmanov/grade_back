<?php

namespace App\Http\Controllers\v1\Response;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ResponseController extends Controller
{
    /**
     * success response method.
     *
     * @param $result
     * @param $message
     * @param $status
     * @return JsonResponse
     */
    public static function sendResponse($result, $message , $status): JsonResponse
    {
        $response = [
            'success' => $status ?? true,
            'message' => $message,
            'data'    => $result,
        ];


        return response()->json($response, 200, [], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }


    /**
     * return error response.
     *
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public static function sendError($error, array $errorMessages = [], int $code = 200): \Illuminate\Http\JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code, [], JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    }
}
