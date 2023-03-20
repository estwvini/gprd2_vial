<?php

namespace App\Http\Controllers\Configuration;


use App\Http\Controllers\Controller;
use App\Processes\Configuration\MenuProcess;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    /**
     * @var MenuProcess
     */
    protected $menuProcess;

    /**
     * MenuController constructor.
     *
     * @param MenuProcess $menuProcess
     */
    public function __construct(MenuProcess $menuProcess)
    {
        $this->menuProcess = $menuProcess;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $response['view'] = view('configuration.menu.index')->render();

        } catch (\Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Process datatables ajax response
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function data()
    {
        try {
            return $this->menuProcess->data();

        } catch (\Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {

            $response = $this->menuProcess->create();

        } catch (\Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $response = $this->menuProcess->store($request);

        } catch (\Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
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

            $response = $this->menuProcess->show($id);

        } catch (\Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            $response = $this->menuProcess->edit($id);

        } catch (\Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $response = $this->menuProcess->update($request, $id);

        } catch (\Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $response = $this->menuProcess->destroy($id);

        } catch (\Throwable $e) {
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

            $response = $this->menuProcess->bulkDestroy($request);

        } catch (\Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Change status to specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function status($id)
    {
        try {

            $response = $this->menuProcess->status($id);

        } catch (\Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Change status to specified resources from the storage
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function bulkStatus(Request $request)
    {
        try {

            $response = $this->menuProcess->bulkStatus($request);

        } catch (\Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

}
