<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use App\Processes\Configuration\RoleProcess;
use Illuminate\Http\Request;
use Throwable;

class RoleController extends Controller
{

    /**
     * @var RoleProcess
     */
    protected $roleProcess;


    /**
     * RoleController constructor.
     * @param RoleProcess $roleProcess
     */
    public function __construct(
        RoleProcess $roleProcess)
    {
        $this->roleProcess = $roleProcess;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $response['view'] = view('configuration.role.index')->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Process datatable ajax response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data()
    {
        try {
            return $this->roleProcess->data();

        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $response = $this->roleProcess->show($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Change editable to specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function editable($id)
    {
        try {

            $response = $this->roleProcess->editable($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Change or create an specified permission
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function permissions(Request $request)
    {
        try {
            $response = $this->roleProcess->permissions($request);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Change or create all permissions
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function allPermissions(Request $request)
    {
        try {
            $response = $this->roleProcess->allPermissions($request);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }
}
