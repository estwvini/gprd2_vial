<?php

namespace App\Http\Controllers\Configuration;


use App\Http\Controllers\Controller;
use App\Processes\Configuration\SettingProcess;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    /**
     * @var SettingProcess
     */
    protected $settingProcess;

    /**
     * SettingController constructor.
     * @param SettingProcess $settingProcess
     */
    public function __construct(SettingProcess $settingProcess)
    {
        $this->settingProcess = $settingProcess;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $response['view'] = view('configuration.setting.index')->render();

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
            return $this->settingProcess->data();

        } catch (\Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
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

            $response = $this->settingProcess->edit($id);

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

            $response = $this->settingProcess->update($request, $id);

        } catch (\Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

}
