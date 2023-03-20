<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\App\Faq;
use App\Processes\App\FaqProcess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;

/**
 * Clase FaqController
 * @package App\Http\Controllers\App
 */
class FaqController extends Controller
{
    /**
     * @var FaqProcess
     */
    private $faqProcess;

    /**
     * Constructor de DepartmentController.
     *
     * @param FaqProcess $faqProcess
     */
    public function __construct(FaqProcess $faqProcess)
    {
        $this->middleware('route')->only('index');
        $this->faqProcess = $faqProcess;
    }

    /**
     * Desplegar lista de faqs.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $response['view'] = view('app.faqs.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Procesar la respuesta ajax de datatables
     *
     * @return JsonResponse|string
     */
    public function data()
    {
        try {
            return $this->faqProcess->data();
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
            $response['view'] = view('app.faqs.create')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Almacenar un departamento creado en la BD.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            Faq::create($request->all());
            $response = [
                'view' => view('app.faqs.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('app/faqs.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Mostrar el formulario para la edición de la pregunta frecuente.
     *
     * @param Faq $faq
     *
     * @return JsonResponse
     */
    public function edit(Faq $faq): JsonResponse
    {
        try {
            $response['view'] = view('app.faqs.update', ['entity' => $faq])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Actualizar el departamento seleccionado en la BD.
     *
     * @param Request $request
     * @param Faq $faq
     *
     * @return JsonResponse
     */
    public function update(Request $request, Faq $faq): JsonResponse
    {
        try {
            $faq->fill($request->all());
            $faq->save();
            $response = [
                'view' => view('app.faqs.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('app/faqs.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    /**
     * Remover el departamento seleccionado de la BD.
     *
     * @param Faq $faq
     *
     * @return JsonResponse
     */
    public function destroy(Faq $faq): JsonResponse
    {
        try {
            $faq->delete();
            $response = [
                'view' => view('app.faqs.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('app/faqs.messages.success.deleted')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    /**
     * Actualizar el estado de la pregunta frecuente.
     *
     * @param Faq $faq
     *
     * @return JsonResponse
     */
    public function publish(Faq $faq)
    {
        try {
            $faq->publish = !$faq->publish;
            $faq->save();
            $response = [
                'view' => view('app.faqs.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('app/faqs.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }
}
