<?php

namespace App\Http\Controllers\Business\Library;

use App\Processes\Business\Library\DocumentProcess;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Throwable;
/**
 * Clase librariesController
 * @package App\Http\Controllers\Business\Library
 */
class DocumentController extends Controller
{
      /**
     * @var DocumentProcess
     */
    protected $documentProcess;

    /**
     * Constructor documentController.
     * @param DocumentProcess $documentProcess
     */
    public function __construct(
        DocumentProcess $documentProcess
    )
    {
        $this->documentProcess = $documentProcess;
    }

    /**
     * Mostrar vista de listado de documentos
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('dashboard.library.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de un documento
     *
     * @return mixed|string
     */
    public function data(Request $request)
    {
        try {
            return $this->documentProcess->data($request->all()['filters']);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de un documento.
     *
     * @return JsonResponse
     */
    public function create(string $type_id)
    {
        try {
            $response['modal_st'] = view('dashboard.library.create',[
                'type_id' => $type_id])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar nuevo documento.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        
        try {
            $response = $this->documentProcess->store($request);          
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

  /**
     * Llamada al proceso para mostrar el formulario de edición de un documento.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {
            $response['modal'] = view('dashboard.library.update',
                $this->documentProcess->edit($id)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de un documento.
     *
     * @param Request $request
     * @param  int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        try {
            $entity = $this->documentProcess->update($request, $id);
            $response = [
                'view' => view('dashboard.library.index',[
                    'type_id' => $request->input('type')])->render(),
                'message' => [
                    'type' => $entity['message']['type'],
                    'text' => $entity['message']['text']
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar un documento.
     *
     * @param  int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $response = $this->documentProcess->destroy($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

     /**
     * Llamada al proceso para descargar un documento.
     *
     * @param int $id
     *
     * @return JsonResponse|mixed
     */
    public function download(int $id)
    {
        try {
            return $this->documentProcess->download($id);
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }
  
}
