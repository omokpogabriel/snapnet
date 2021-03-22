<?php


namespace App\CustomService;


class ResponseMessage
{
    public static function errorMessage(string $message, $data= null) :array{
        return [
            'status' => 'failed',
            'message' => $message,
            'data' => $data
            ];
    }

    public static function successMessage(string $message, $data= null) :array{
        return [
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ];
    }
}
