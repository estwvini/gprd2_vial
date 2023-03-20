<?php

namespace App\Http\Controllers\App\Api;

use App\Http\Controllers\App\Resources\CantonResource;
use App\Http\Controllers\App\Resources\ClientGroupLocationResource;
use App\Models\Business\Catalogs\GeographicLocation;
use Illuminate\Http\JsonResponse;
use Exception;
use App\Models\App\Client;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CantonController extends Controller
{

    /**
     * Retrieve a collection of departments.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->jsonResource(CantonResource::collection(GeographicLocation::type(GeographicLocation::TYPE_CANTON)->app()->get()));
    }

    public function getGroupClientsCanton()
    {
        try {
            $user_info = Client::groupBy('canton')->select('canton', DB::raw('count(*) as total'))->get();
            return $this->jsonResource(ClientGroupLocationResource::collection($user_info));
        } catch (Exception $ex) {
            return $this->response(['error' => '' . $ex], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
