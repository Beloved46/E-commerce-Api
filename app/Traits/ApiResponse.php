<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * api response 
 */
trait ApiResponse
{
    public function successResponse($message = null,$data=[],  $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function errorResponse($message = null, $code = 400, $errors = []): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
    // public function successResponse($data, $code)
    // {
    //     return response()->json($data, $code);
    // }


    // public function errorResponse($message, $code)
    // {
    //     return response()->json(['error' => $message, 'code' => $code], $code);
    // }


    public function showAll($message = null, Collection $collection, $code = 200)
    {
        $this->successResponse(['message' => $message, 'data' => $collection], $code);
    }

    public function showOne(Model $model, $code = 200)
    {
        $this->successResponse(['data' => $model], $code);
    }
}
