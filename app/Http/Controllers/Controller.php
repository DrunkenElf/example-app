<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function successResponse(array|JsonResource $data = [], int $code = 200, $checkStatus = true): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'status' => $code,
            'status_check' => $checkStatus
        ], $code);
    }
}
