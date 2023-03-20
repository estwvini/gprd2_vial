<?php

namespace App\Http\Controllers\App\Api;

use App\Http\Controllers\App\Resources\FaqResource;
use App\Models\App\Faq;
use Illuminate\Http\JsonResponse;

class FaqController extends Controller
{

    /**
     * Retrieve a collection of departments.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->jsonResource(FaqResource::collection(Faq::publish()->get()));
    }
}
