<?php

namespace App\Http\Controllers\Configuration;


use App\Http\Controllers\Controller;
use App\Processes\Configuration\PermissionProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

class PermissionController extends Controller
{

    /**
     * @var PermissionProcess
     */
    protected $permissionProcess;

    /**
     * PermissionController constructor.
     * @param PermissionProcess $permissionProcess
     */
    public function __construct(
        PermissionProcess $permissionProcess)
    {
        $this->permissionProcess = $permissionProcess;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {

            $response['view'] = view('configuration.permission.index')->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Process datatable ajax response
     *
     * @return string
     */
    public function data()
    {
        try {

            return $this->permissionProcess->data();

        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {

            $response['view'] = view('configuration.permission.create')->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {

            $response = $this->permissionProcess->store($request);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        try {

            $response = $this->permissionProcess->show($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return JsonResponse
     */
    public function edit($id)
    {
        try {

            $response = $this->permissionProcess->edit($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {

            $response = $this->permissionProcess->update($request, $id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {

            $response = $this->permissionProcess->destroy($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param Request $request
     * @return String json
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $response = $this->permissionProcess->bulkDestroy($request);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}
