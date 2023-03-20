<?php

namespace App\Http\Controllers\App\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    /**
     * Formatted response helper
     *
     * @param array $data
     * @param int $code
     *
     * @return JsonResponse
     */
    public function response(array $data = [], int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['data' => $data], $code);
    }

    /**
     * Formatted resource response helper
     *
     * @param JsonResource $jsonResource
     * @param int $code
     * @param array $additional
     *
     * @return JsonResponse
     */
    public function jsonResource(JsonResource $jsonResource, int $code = Response::HTTP_OK, array $additional = []): JsonResponse
    {
        return $jsonResource->additional($additional)->response()->setStatusCode($code);
    }
}
