<?php

namespace App\Http\Controllers\Configuration;

use App\Http\Controllers\Controller;
use App\Processes\Configuration\UIProcess;
use Illuminate\Http\Request;

class UIController extends Controller
{

    /**
     * @var UIProcess
     */
    protected $uiProcess;

    /**
     * UIController constructor.
     * @param UIProcess $uiProcess
     */
    public function __construct(UIProcess $uiProcess)
    {
        $this->uiProcess = $uiProcess;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        try {
            $response = $this->uiProcess->edit();

        } catch (\Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $response = $this->uiProcess->update($request);

        } catch (\Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        header("Refresh:0");
        return response()->json($response);
    }
}
