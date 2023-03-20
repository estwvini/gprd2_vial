<?php

namespace App\Http\Controllers\App\Api;

use App\Http\Controllers\App\Resources\SubjectResource;
use App\Models\App\Subject;
use Illuminate\Http\JsonResponse;

class SubjectController extends Controller
{

    /**
     * Retrieve a collection of departments.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->jsonResource(SubjectResource::collection(Subject::all()));
    }
}
