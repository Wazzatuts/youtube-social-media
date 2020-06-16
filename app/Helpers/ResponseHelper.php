<?php


namespace App\Helpers;


class ResponseHelper
{
    /**
     * @param $success
     * @param $message
     * @param $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($success, $message, $data)
    {
        return response()->json([
            'data' => [
                'success' => $success,
                'message' => $message,
                'data' => $data,
            ]
        ]);
    }

    /**
     * @param $success
     * @param $message
     * @param $errorCode
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse($success, $message, $errorCode)
    {
        return response()->json([
            'data' => [
                'error' => [
                    'success' => $success,
                    'message' => $message
                ]
            ]
        ], $errorCode);
    }

}
