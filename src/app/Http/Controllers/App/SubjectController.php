<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\App\Subject;
use App\Processes\App\SubjectProcess;
use App\Repositories\Repository\Admin\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase SubjectController
 * @package App\Http\Controllers\App
 */
class SubjectController extends Controller
{

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var SubjectProcess
     */
    private $subjectProcess;

    /**
     * Constructor de DepartmentController.
     *
     * @param SubjectProcess $subjectProcess
     */
    public function __construct(SubjectProcess $subjectProcess, UserRepository $userRepository)
    {
        $this->middleware('route')->only('index');
        $this->subjectProcess = $subjectProcess;
        $this->userRepository = $userRepository;
    }

    /**
     * Desplegar lista de faqs.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $response['view'] = view('app.subjects.index')->render();
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
            return $this->subjectProcess->data();
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
            $users = $this->userRepository->findVisible();
            $response['view'] = view('app.subjects.create', compact('users'))->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Almacenar un área temática en la BD.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            Subject::create($request->all());
            $response = [
                'view' => view('app.subjects.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('app/subjects.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Mostrar el formulario para la edición de área temática.
     *
     * @param Subject $subject
     *
     * @return JsonResponse
     */
    public function edit(Subject $subject): JsonResponse
    {
        try {
            $users = $this->userRepository->findVisible();
            $response['view'] = view('app.subjects.update', ['entity' => $subject, 'users' => $users])->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Actualizar el área temática seleccionada en la BD.
     *
     * @param Request $request
     * @param Subject $subject
     *
     * @return JsonResponse
     */
    public function update(Request $request, Subject $subject): JsonResponse
    {
        try {
            $subject->fill($request->all());
            $subject->save();
            $response = [
                'view' => view('app.subjects.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('app/subjects.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }

    /**
     * Remover el área temática seleccionada de la BD.
     *
     * @param Subject $subject
     *
     * @return JsonResponse
     */
    public function destroy(Subject $subject): JsonResponse
    {
        try {
            $subject->load('comments');
            if ($subject->comments->count() > 0) {
                $response = [
                    'view' => view('app.subjects.index')->render(),
                    'message' => [
                        'type' => 'error',
                        'text' => trans('app/subjects.messages.exceptions.has_comments')
                    ]
                ];
            } else {
                $response = [
                    'view' => view('app.subjects.index')->render(),
                    'message' => [
                        'type' => 'success',
                        'text' => trans('app/subjects.messages.success.deleted')
                    ]
                ];
            }
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
        return response()->json($response);
    }
}
