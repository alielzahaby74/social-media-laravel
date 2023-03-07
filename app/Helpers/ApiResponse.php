<?php


namespace App\Helpers;

class ApiResponse
{
    private $message;

    private $status;

    private $data;


    public static function success($message, $data = null, $status = 200)
    {
        $response_array = [
            "message" => $message,
            "status" => $status,
            "data" => $data
        ];


        return response()->json($response_array);
    }

    public static function failed($message, $statusCode = 500)
    {
        $response_array = [
            "message" => $message,
            "status" => $statusCode,
        ];
        return response()->json($response_array);
    }
}
