<?php

namespace App\Http\Controllers\Business\Roads\Catalogs;

use App\Processes\Business\Roads\Catalogs\CatalogProcess;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Log;
/**
 * Clase CatalogsController
 * @package App\Http\Controllers\Business\Roads\Catalogs
 */
class CatalogController extends Controller
{
      /**
     * @var CatalogProcess
     */
    protected $catalogProcess;

    /**
     * Constructor CatalogController.
     * @param CatalogController $catalogController
     */
    public function __construct(
        CatalogProcess $catalogProcess
    )
    {
        $this->catalogProcess = $catalogProcess;
    }

    /**
     * Mostrar vista de listado de catálogos
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.roads.catalogs.catalog.index',[
            'catalogs' => $this->catalogProcess->getFatherCatalog()
            ])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de un catálogo
     *
     * @return mixed|string
     */
    public function data(Request $request)
    {
        try {
            return $this->catalogProcess->data($request->all()['filters']);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de un catálogo.
     *
     * @return JsonResponse
     */
    public function create(int $parent_id)
    {
        try {
            $response['modal_st'] = view('business.roads.catalogs.catalog.create',
            $this->catalogProcess->findById($parent_id))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar nuevo catálogo.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        
        try {
            $this->catalogProcess->store($request);

            $response = [
                'view' => view('business.roads.catalogs.catalog.index', [
                'catalogs' => $this->catalogProcess->getFatherCatalog(),
                'parent_id' => $request->input('padre_id')
            ])->render(),               
                'message' => [
                    'type' => 'success',
                    'text' => trans('hdm4.messages.success.catalog_created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

  
}
