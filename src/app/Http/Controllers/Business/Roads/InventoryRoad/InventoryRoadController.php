<?php

namespace App\Http\Controllers\Business\Roads\InventoryRoad;

use App\Http\Controllers\Controller;
use App\Repositories\Repository\Configuration\SettingRepository;
use App\Processes\Business\Roads\GeneralCharacteristicsOfTrackProcess;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use Illuminate\Http\Request;
use Throwable;
use Illuminate\Http\JsonResponse;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NewRoadsExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

/**
 * Clase InventoryRoadController
 * @package App\Http\Controllers\Business\Roads\InventoryVial
 */
class InventoryRoadController extends Controller
{
    /**
     * @var GeneralCharacteristicsOfTrackProcess
     */
    protected $generalCharacteristicsOfTrackProcess;

    /**
     * @var GeneralCharacteristicsOfTrackRepository
     */
    protected $generalCharacteristicsOfTrackRepository;

    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * Constructor de InventoryRoadController.
     *
     * @param GeneralCharacteristicsOfTrackProcess $generalCharacteristicsOfTrackProcess
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     * @param SettingRepository $settingRepository
     */
    public function __construct(
        GeneralCharacteristicsOfTrackProcess $generalCharacteristicsOfTrackProcess,
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository,
        SettingRepository $settingRepository
    )
    {
        $this->generalCharacteristicsOfTrackProcess = $generalCharacteristicsOfTrackProcess;
        $this->generalCharacteristicsOfTrackRepository = $generalCharacteristicsOfTrackRepository;
        $this->settingRepository = $settingRepository;
    }

    /**
     * Mostrar vista de listado de caracteristicas generales de la vía.
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $response['view'] = view('business.roads.general_characteristics_of_track.index')->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de todas las caracteristicas generales de la vía.
     *
     * @return mixed|string
     */
    public function data()
    {
        try {
            return $this->generalCharacteristicsOfTrackProcess->data();
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar el formulario de creación de una caracteristica general de la vía.
     *
     * @return JsonResponse
     */
    public function create()
    {
        try {
            $response['view'] = view('business.roads.general_characteristics_of_track.create',
                $this->generalCharacteristicsOfTrackProcess->create()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }

        return response()->json($response);
    }

    /**
     * Verificar si un código ya existe en el registro de una caracteristica general de la vía.
     *
     * @param Request $request
     *
     * @return false|string
     */
    public function checkCodeGeneralCharacteristicsOfTrack(Request $request)
    {
        try {
            $result = $this->generalCharacteristicsOfTrackProcess->checkCodeGeneralCharacteristicsOfTrack($request);
        } catch (Throwable $e) {
            $result = defaultCatchHandler($e);
        }
        return json_encode(!$result);
    }

    /**
     * Llamada al proceso para almacenar nueva caracteristica general de la vía.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $this->generalCharacteristicsOfTrackProcess->store($request);
            $response = [
                'view' => view('business.roads.general_characteristics_of_track.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('general_characteristics_of_track.messages.success.created')
                ]
            ];
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }

        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar la información de una caracteristica general de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function show(string $code)
    {
        try {
            $response['view'] = view('business.roads.general_characteristics_of_track.show_components',
                $this->generalCharacteristicsOfTrackProcess->edit($code)
            )->render();

        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de edición de una caracteristica general de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function edit(string $code)
    {
        try {
            $response['view'] = view('business.roads.general_characteristics_of_track.update',
                $this->generalCharacteristicsOfTrackProcess->edit($code)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para actualizar la información de una caracteristica general de la vía.
     *
     * @param Request $request
     * @param  string $code
     *
     * @return JsonResponse
     */
    public function update(Request $request, string $code)
    {
        try {
            $this->generalCharacteristicsOfTrackProcess->update($request, $code);

            $response = [
                'view' => view('business.roads.general_characteristics_of_track.index')->render(),
                'message' => [
                    'type' => 'success',
                    'text' => trans('general_characteristics_of_track.messages.success.updated')
                ]
            ];
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar el formulario de creacion de componentes de una caracteristica general de la vía.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function editComponents(string $code)
    {
        try {
            $response['view'] = view('business.roads.general_characteristics_of_track.edit_components',
                $this->generalCharacteristicsOfTrackProcess->edit($code)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para mostrar los reportes de vias.
     *
     * @return JsonResponse
     */
    public function indexReport()
    {
        try {
            $response['view'] = view('business.reports.roads.inventory',
                $this->generalCharacteristicsOfTrackProcess->indexReport()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para cargar información de las vías por filtros.
     *
     * @param string $canton
     * @param string $parish
     *
     * @return mixed|string
     */
    public function dataReportRoads(string $canton, string $parish)
    {
        try {
            return $this->generalCharacteristicsOfTrackProcess->dataReport($canton, $parish);
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para mostrar vista para generar archivo para el hdm4.
     *
     * @return JsonResponse
     */
    public function indexHdm4()
    {
        try {
            $response['view'] = view('business.roads.general_characteristics_of_track.hdm4',
                $this->generalCharacteristicsOfTrackProcess->indexReport()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Llamada al proceso para importar y generar archivo del HDM4.
     *
     * @param Request $request
     *
     * @return string|BinaryFileResponse
     */
    public function importHdm4(Request $request)
    {
        try {
            $this->generalCharacteristicsOfTrackProcess->importHdm4($request);
            return Excel::download(new NewRoadsExport, $request->files->get('hdm4_file')->getClientOriginalName());
        } catch (Throwable $e) {
            return datatableEmptyResponse($e, $e);
        }
    }

    /**
     * Llamada al proceso para cargar las parroquias dado un cantón.
     *
     * @param string $name
     *
     * @return JsonResponse|mixed
     */
    public function loadParishes(string $name)
    {
        try {
            return str_replace("\u0022", "\\\\\"", json_encode($this->generalCharacteristicsOfTrackProcess->getParishes($name), JSON_HEX_APOS | JSON_HEX_QUOT));
        } catch (Throwable $e) {
            return response()->json(defaultCatchHandler($e));
        }
    }

    /**
     * Mostrar vista de shapes para una via por codigo.
     *
     * @param string $code
     *
     * @return JsonResponse
     */
    public function shapes(string $code)
    {
        try {
            $response['view'] = view('business.roads.general_characteristics_of_track.shapes',
                $this->generalCharacteristicsOfTrackProcess->indexShapes($code)
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

    /**
     * Mostrar vista de shapes para una provincia.
     *
     * @return JsonResponse
     */
    public function allShapes()
    {
        try {
            $response['view'] = view('business.roads.general_characteristics_of_track.shapes',
                $this->generalCharacteristicsOfTrackProcess->allShapes()
            )->render();
        } catch (Throwable $e) {
            $response = defaultCatchHandler($e);
        }
        return response()->json($response);
    }

   
}
