<?php

namespace Api\Infrastructure;

class ResponseHandler
{
    /**
     * @param int $codeStatus
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function renderSuccessJson(int $codeStatus, array $data = [])
    {
        return response()->json([
            'meta' => [
                'success' => true,
                'errors' => [],
            ],
            'data'=>$data
        ], $codeStatus);
    }

    /**
     * @param int $codeStatus
     * @param array $error
     * @return \Illuminate\Http\JsonResponse
     */
    public static function renderErrorJson(int $codeStatus, array $error = [])
    {
        return response()->json([
            'meta' => [
                'success' => false,
                'errors' => $error,
            ]
        ], $codeStatus);
    }
}
