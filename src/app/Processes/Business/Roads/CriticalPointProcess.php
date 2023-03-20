<?php

namespace App\Processes\Business\Roads;

use App\Models\Business\Roads\CriticalPoint;
use App\Repositories\Repository\Business\Roads\CriticalPointRepository;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use App\Repositories\Repository\Business\Roads\Catalogs\CatalogRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Exception;

/**
 * Clase CriticalPointProcess
 * @package App\Processes\Business\Roads
 */
class CriticalPointProcess
{
    /**
     * @var CriticalPointRepository
     */
    protected $criticalPointRepository;

    /**
     * @var GeneralCharacteristicsOfTrackRepository
     */
    protected $generalCharacteristicsOfTrackRepository;

    /**
     * @var CatalogRepository
     */
    protected $catalogRepository;

    /**
     * Constructor de CriticalPointProcess.
     *
     * @param CriticalPointRepository $criticalPointRepository
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     * @param CatalogRepository $catalogRepository
     */
    public function __construct(
        CriticalPointRepository $criticalPointRepository,
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository,
        CatalogRepository $catalogRepository
    )
    {
        $this->criticalPointRepository = $criticalPointRepository;
        $this->generalCharacteristicsOfTrackRepository = $generalCharacteristicsOfTrackRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * Cargar información de los puntos críticos de una vía.
     *
     * @param string $code
     *
     * @return mixed
     * @throws Exception
     */
    public function data(string $code)
    {
        $user = currentUser();
        $actions = [];
        if ($user->can('show.critical_point.inventory_roads')) {
            $actions['search'] = [
                'route' => 'show.critical_point.inventory_roads',
                'tooltip' => trans('critical_point.labels.details')
            ];
        }
        if ($user->can('edit.critical_point.inventory_roads')) {
            $actions['edit'] = [
                'route' => 'edit.critical_point.inventory_roads',
                'tooltip' => trans('critical_point.labels.update')
            ];
        }
        $dataTable = DataTables::of($this->criticalPointRepository->findByCodeDataTable($code))
            ->setRowId('gid')
            ->addColumn('actions', function (CriticalPoint $entity) use ($actions) {
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
     * Almacenar nuevo punto crítico para una vía.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $entity = $this->criticalPointRepository->createFromArray($request->all());
        if (!$entity) {
            throw new Exception(trans('critical_point.messages.errors.create'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'critical_point' => true
        ];
    }

    /**
     * Retornar data necesaria para mostrar la información de un punto crítico de una vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function show(string $gid)
    {
        $entity = $this->criticalPointRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('critical_point.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de un punto crítico de una vía.
     *
     * @param string $code
     *
     * @return array
     */
    public function create(string $code)
    {
        $typeCriticalPoints = $this->catalogRepository->listTypeCriticalPoints();
        return [
            'code' => $code,
            'typeCriticalPoints' => $typeCriticalPoints
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de un punto crítico de una vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function edit(string $gid)
    {
        $typeCriticalPoints = $this->catalogRepository->listTypeCriticalPoints();
        $entity = $this->criticalPointRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('critical_point.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity,
            'typeCriticalPoints' => $typeCriticalPoints
        ];
    }

    /**
     * Actualizar la información de la senalización vertical de una vía.
     *
     * @param Request $request
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function update(Request $request, string $gid)
    {
        $entity = $this->criticalPointRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('critical_point.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->criticalPointRepository->updateFromArray($request->all(), $entity);
        if (!$entity) {
            throw new Exception(trans('critical_point.messages.errors.update'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'critical_point' => true
        ];
    }
}