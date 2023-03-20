<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Processes\Admin\RoleProcess;
use Illuminate\Http\JsonResponse;
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
     *
     * @param RoleProcess $roleProcess
     */
    public function __construct(
        RoleProcess $roleProcess
    ) {
        $this->roleProcess = $roleProcess;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('admin.role.index')->render();

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
            return $this->roleProcess->data();

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
            $response['view'] = view('admin.role.create')->render();

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
            $response = $this->roleProcess->store($request->all());

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return JsonResponse
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
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit($id)
    {
        try {
            $response = $this->roleProcess->edit($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $response = $this->roleProcess->update($request->all(), $id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $response = $this->roleProcess->destroy($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resources from storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function bulkDestroy(Request $request)
    {
        try {
            $response = $this->roleProcess->bulkDestroy($request);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Change status to specified resource from storage.
     *
     * @param $id
     *
     * @return JsonResponse
     */
    public function status($id)
    {
        try {
            $response = $this->roleProcess->status($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Change status to specified resources from the storage
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function bulkStatus(Request $request)
    {
        try {
            $response = $this->roleProcess->bulkStatus($request);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Change editable to specified resource from storage.
     *
     * @param $id
     *
     * @return JsonResponse
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
     * Show the permissions.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function permissions($id)
    {
        try {
            $response = $this->roleProcess->permissions($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Change or create an specified permission
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function onePermissions(Request $request)
    {
        try {
            $response = $this->roleProcess->onePermissions($request);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Change or create all permissions
     *
     * @param Request $request
     *
     * @return JsonResponse
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

    /**
     *  Check if role name exists
     *
     **/
    public function checkNameExists(Request $request)
    {
        $name = $request->input('name');
        $id = $request->input('id');
        $result = $this->roleProcess->checkNameExists($name, $id);
        return json_encode(!$result);
    }
}
