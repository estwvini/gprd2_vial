<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Processes\Admin\UserProcess;
use App\Processes\Profile\FiscalYearProcess;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use JsonException;
use Throwable;

/**
 * Clase UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    /**
     * @var UserProcess
     */
    protected $userProcess;

    /**
     * @var FiscalYearProcess
     */
    private $fiscalYearProcess;

    /**
     * Constructor de UserController.
     *
     * @param UserProcess $userProcess
     * @param FiscalYearProcess $fiscalYearProcess
     */
    public function __construct(
        UserProcess $userProcess,
        FiscalYearProcess $fiscalYearProcess
    ) {
        $this->userProcess = $userProcess;
        $this->fiscalYearProcess = $fiscalYearProcess;
    }

    /**
     * Mostrar vista de listado de usuarios.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {

            $response['view'] = view('admin.user.index')->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de usuarios.
     *
     * @return string
     * @throws JsonException
     */
    public function data()
    {
        try {

            return $this->userProcess->data();

        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de usuario.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {

            $response = $this->userProcess->create();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para almacenar nuevo usuario.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {

            $response = $this->userProcess->store($request->all());

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }


    /**
     * Llamada al proceso para mostrar la información de usuario.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function show(int $id)
    {
        try {

            $response = $this->userProcess->show($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de usuario.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function edit(int $id)
    {
        try {

            $response = $this->userProcess->edit($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de usuario en la BD.
     *
     * @param Request $request
     * @param int $id
     *
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        try {

            $response = $this->userProcess->update($request->all(), $id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para eliminar lógicamente un usuario.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $response = $this->userProcess->destroy($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }


    /**
     * Llamada al proceso para cambiar de estado un usuario.
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function status(int $id)
    {
        try {
            $response = $this->userProcess->status($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la contraseña
     *
     * @param int $id
     *
     * @return JsonResponse
     */
    public function updatePassword(int $id)
    {
        try {
            $response = $this->userProcess->resetPassword($id);

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para verificar si el nombre de usuario ya existe.
     *
     * @param Request $request
     *
     * @return false|string
     * @throws JsonException
     */
    public function checkUsernameExists(Request $request)
    {
        $result = $this->userProcess->checkUsernameExists($request);
        return json_encode(!$result, JSON_THROW_ON_ERROR);
    }

    /**
     * Show modal to change fiscal year
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function changeFiscalYear()
    {
        $auxArray = $this->fiscalYearProcess->indexPlanning();

        try {
            $response['modal'] = view('admin.user.change_fiscal_year', [
                'fiscalYearPlan' => $auxArray[0],
                'fiscalYearExec' => $auxArray[1],
            ])->render();

        } catch (Throwable $e) {
            $response = $e;
        }

        return response()->json($response);
    }

    /**
     * Store in session fiscal years
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function setFiscalYearOnUserSession(Request $request)
    {
        try {
            session()->put('fiscalYearPlanning', $request->planning);
            session()->put('fiscalYearExecution', $request->execution);

            $response = [
                'message' => [
                    'type' => 'success',
                    'text' => trans('app.messages.success.fiscal_year_changed')
                ]
            ];

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

}
