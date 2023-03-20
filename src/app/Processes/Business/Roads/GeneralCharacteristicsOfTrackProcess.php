<?php

namespace App\Processes\Business\Roads;


use App\Models\Business\Roads\GeneralCharacteristicsOfTrack;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RoadsExport;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use App\Repositories\Repository\Business\Roads\ShapeRepository;
use App\Repositories\Repository\Business\Roads\MainShapeRepository;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackHdm4Repository;
use App\Repositories\Repository\Configuration\SettingRepository;
use App\Repositories\Repository\Business\Roads\Catalogs\CatalogRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Exception;

/**
 * Clase GeneralCharacteristicsOfTrackProcess
 * @package App\Processes\Business\Roads
 */
class GeneralCharacteristicsOfTrackProcess
{
    /**
     * @var GeneralCharacteristicsOfTrackRepository
     */
    protected $generalCharacteristicsOfTrackRepository;

    /**
     * @var ShapeRepository
     */
    protected $shapeRepository;

    /**
     * @var MainShapeRepository
     */
    protected $mainShapeRepository;

    /**
     * @var GeneralCharacteristicsOfTrackHdm4Repository
     */
    protected $generalCharacteristicsOfTrackHdm4Repository;

    /**
     * @var SettingRepository
     */
    protected $settingRepository;

    /**
     * @var CatalogRepository
     */
    protected $catalogRepository;

    /**
     * Constructor de GeneralCharacteristicsOfTrackProcess.
     *
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     * @param ShapeRepository $shapeRepository
     * @param GeneralCharacteristicsOfTrackHdm4Repository $generalCharacteristicsOfTrackHdm4Repository
     * @param SettingRepository $settingRepository
     * @param MainShapeRepository $mainShapeRepository
     * @param CatalogRepository $catalogRepository
     */
    public function __construct(
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository,
        ShapeRepository $shapeRepository,
        GeneralCharacteristicsOfTrackHdm4Repository $generalCharacteristicsOfTrackHdm4Repository,
        SettingRepository $settingRepository,
        MainShapeRepository $mainShapeRepository,
        CatalogRepository $catalogRepository
    )
    {
        $this->generalCharacteristicsOfTrackRepository = $generalCharacteristicsOfTrackRepository;
        $this->shapeRepository = $shapeRepository;
        $this->generalCharacteristicsOfTrackHdm4Repository = $generalCharacteristicsOfTrackHdm4Repository;
        $this->settingRepository = $settingRepository;
        $this->mainShapeRepository = $mainShapeRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * Cargar información de la vía.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];
        if ($user->can('show.inventory_roads')) {
            $actions['search'] = [
                'route' => 'show.inventory_roads',
                'tooltip' => trans('general_characteristics_of_track.labels.details')
            ];
        }
        if ($user->can('edit.inventory_roads')) {
            $actions['edit'] = [
                'route' => 'edit.inventory_roads',
                'tooltip' => trans('general_characteristics_of_track.labels.update')
            ];
        }
        if ($user->can('edit_components.inventory_roads')) {
            $actions['barcode'] = [
                'route' => 'edit_components.inventory_roads',
                'tooltip' => trans('general_characteristics_of_track.labels.roads_components')
            ];
        }
        $dataTable = DataTables::of($this->generalCharacteristicsOfTrackRepository->findAllDataTable())
            ->setRowId('codigo')
            ->addColumn('actions', function (GeneralCharacteristicsOfTrack $entity) use ($actions) {
                $actions['search']['params'] = [
                    'road' => $entity
                ];
                $actions['edit']['params'] = [
                    'road' => $entity
                ];
                $actions['barcode']['params'] = [
                    'code' => $entity->codigo
                ];
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions'])
            ->make(true);
        return $dataTable;
    }

    /**
     * Cargar información de la vía por filtros.
     *
     * @param string $canton
     * @param string $parish
     *
     * @return mixed
     * @throws Exception
     */
    public function dataReport(string $canton, string $parish)
    {
        $user = currentUser();
        $actions = [];
        if ($user->can('show.inventory_roads')) {
            $actions['search'] = [
                'route' => 'show.inventory_roads',
                'tooltip' => trans('general_characteristics_of_track.labels.details')
            ];
        }
        if ($user->can('edit.inventory_roads')) {
            $actions['edit'] = [
                'route' => 'edit.inventory_roads',
                'tooltip' => trans('general_characteristics_of_track.labels.update')
            ];
        }
        if ($user->can('edit_components.inventory_roads')) {
            $actions['barcode'] = [
                'route' => 'edit_components.inventory_roads',
                'tooltip' => trans('general_characteristics_of_track.labels.roads_components')
            ];
        }
        if ($canton === '0' && $parish === '0') {
            $report = $this->generalCharacteristicsOfTrackRepository->findAllDataTable();
        } else {
            $report = $this->generalCharacteristicsOfTrackRepository->findFilters($canton, $parish);
        }        
        $dataTable = DataTables::of($report)
            ->setRowId('codigo')
            ->addColumn('actions', function ($entity) use ($actions) {
                $actions['search']['params'] = [
                    'road' => $entity
                ];
                $actions['edit']['params'] = [
                    'road' => $entity
                ];
                $actions['barcode']['params'] = [
                    'code' => $entity->codigo
                ];
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['actions'])
            ->make(true);
        return $dataTable;
    }

    /**
     * Almacenar nueva vía.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $gad = $this->settingRepository->findByKey('gad');
        $requestData = $request->all();
        $requestData['prov'] = $gad->value['province_short_name'];
        $entity = $this->generalCharacteristicsOfTrackRepository->createFromArray($requestData);

        if (!$entity) {
            throw new Exception(trans('general_characteristics_of_track.messages.errors.create'), 1000);
        }

        return $entity;
    }

    /**
     * Retornar data necesaria para mostrar la información de la vía.
     *
     * @param string $code
     *
     * @return array
     * @throws Exception
     */
    public function show(string $code)
    {        
        $entity = $this->generalCharacteristicsOfTrackRepository->findByCode($code);
        if (!$entity) {
            throw  new Exception(trans('general_characteristics_of_track.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de una vía.
     *
     * @return array
     */
    public function create()
    {
        $gad = $this->settingRepository->findByKey('gad');
        $climaticConditions = $this->catalogRepository->listClimaticConditions();
        $typeInterconnections = $this->catalogRepository->listTypeInterconnections();
        return [
            'climaticConditions' => $climaticConditions,
            'typeInterconnections' => $typeInterconnections,
            'gad' => $gad->value
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de reportes de una vía.
     *
     * @return array
     */
    public function indexReport()
    {
        $gad = $this->settingRepository->findByKey('gad');
        $cantons = $this->generalCharacteristicsOfTrackRepository->getCantons();
        $surfaceTypes = $this->catalogRepository->listSurfaceTypes();
        $status = $this->catalogRepository->listStateActive();

        return [
            'gad' => $gad->value,
            'cantons' => $cantons,
            'rollingSurfaces' => $surfaceTypes,
            'status' => $status
        ];
    }

    /**
     * Verificar si un código ya existe en el registro de una caracteristica general de la vía.
     *
     * @param Request $request
     *
     * @return bool|mixed
     */
    public function checkCodeGeneralCharacteristicsOfTrack(Request $request)
    {
        if ($request->type === 'create') {
            $result = $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo);
        } else {
            if ($request->actualValue === $request->codigo) {
                $result = false;
            } else {
                $result = $this->generalCharacteristicsOfTrackRepository->findByCodeEdit($request->codigo, $request->actualValue);
            }
        }
        return $result;
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de una vía.
     *
     * @param string $code
     *
     * @return array
     * @throws Exception
     */
    public function edit(string $code)
    {        
        $climaticConditions = $this->catalogRepository->listClimaticConditions();
        $typeInterconnections = $this->catalogRepository->listTypeInterconnections();
        $entity = $this->generalCharacteristicsOfTrackRepository->findByCode($code);
        if (!$entity) {
            throw  new Exception(trans('general_characteristics_of_track.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity,
            'climaticConditions' => $climaticConditions,
            'typeInterconnections' => $typeInterconnections
        ];
    }

    /**
     * Actualizar la información de la vía.
     *
     * @param Request $request
     * @param string $code
     *
     * @return array
     * @throws Exception
     */
    public function update(Request $request, string $code)
    {
        $entity = $this->generalCharacteristicsOfTrackRepository->findByCode($code);
        if (!$entity) {
            throw  new Exception(trans('general_characteristics_of_track.messages.exceptions.not_found'), 1000);
        }
        $gad = $this->settingRepository->findByKey('gad');
        $requestData = $request->all();
        $requestData['prov'] = $gad->value['province_short_name'];
        $entity = $this->generalCharacteristicsOfTrackRepository->updateFromArray($requestData, $entity);
        if (!$entity) {
            throw new Exception(trans('general_characteristics_of_track.messages.errors.update'), 1000);
        }
        return $entity;
    }

    /**
     * Crear archivo para hdm4.
     *
     * @param Request $request
     *
     * @return false|string
     */
    public function importHdm4(Request $request)
    {
        $file = $request->file('hdm4_file')->store('images');
        $this->generalCharacteristicsOfTrackHdm4Repository->truncateTable();
        Excel::import(new RoadsExport, $file);
        $photoPath = storage_path() . env('IMAGES_HDM4_PATH') . $file;
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }
        return $file;
    }

    /**
     * Obtener las parroquias de un cantón.
     *
     * @param string $name
     *
     * @return Collection
     */
    public function getParishes(string $name)
    {
        return $this->generalCharacteristicsOfTrackRepository->findByCanton($name);
    }

    /**
     * Retornar data necesaria para mostrar la vista de shapes.
     *
     * @param string $code
     *
     * @return array
     */
    public function indexShapes(string $code)
    {
        $shapes = $this->shapeRepository->findByCode($code);
        $shapesBackground = $this->shapeRepository->shapesBackground($code);
        
        return [
            'shapes' => $shapes,
            'shapesDefault' => ($shapesBackground) ? [$shapesBackground] : []
        ];
    }

    /**
     * Retornar data necesaria para mostrar todos los Shape de la provincia.
     *
     * @return array
     */
    public function allShapes()
    {
        $shapes = $this->mainShapeRepository->allShapes();
        $shapesBackground = $this->mainShapeRepository->shapesBackground();   
        $gad = $this->settingRepository->findByKey('gad');
        $codePrv = $gad->value['code'];
        return [
            'shapes' => $shapes,
            'shapesDefault' => ($shapesBackground) ? [$shapesBackground] : [],
            'codePrv' => $codePrv
        ];
    }
     
}