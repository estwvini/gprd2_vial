<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Imports\History\History;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Throwable;

class HistoryController extends Controller
{

    public function import(Request $request)
    {
        try {

            Excel::import(new History(), $request->file('file'));

            $response['message'] = [
                'type' => 'success',
                'text' => 'Transacción completada correctamente'
            ];
            return response()->json($response);
        } catch (ValidationException $e) {
            $response['message'] = [
                'type' => 'error',
                'text' => 'Transacción incompleta'
            ];
            return response()->json($response);
        } catch (Throwable $e) {
            return defaultCatchHandler($e);
        }
    }
}
