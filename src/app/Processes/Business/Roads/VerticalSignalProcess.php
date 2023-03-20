<?php

namespace App\Processes\Business\Roads;

use App\Models\Business\Roads\VerticalSignal;
use App\Repositories\Repository\Business\Roads\VerticalSignal_Repository;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use App\Repositories\Repository\Business\Roads\Catalogs\CatalogRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Exception;

/**
 * Clase VerticalSignalProcess
 * @package App\Processes\Business\Roads
 */
class VerticalSignalProcess
{
    /**
     * @var VerticalSignal_Repository
     */
    protected $verticalSignalRepository;

    /**
     * @var GeneralCharacteristicsOfTrackRepository
     */
    protected $generalCharacteristicsOfTrackRepository;

    /**
     * @var CatalogRepository
     */
    protected $catalogRepository;

    /**
     * Constructor de VerticalSignalProcess.
     *
     * @param VerticalSignal_Repository $verticalSignalRepository
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     * @param CatalogRepository $catalogRepository
     */
    public function __construct(
        VerticalSignal_Repository $verticalSignalRepository,
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository,
        CatalogRepository $catalogRepository
    )
    {
        $this->verticalSignalRepository = $verticalSignalRepository;
        $this->generalCharacteristicsOfTrackRepository = $generalCharacteristicsOfTrackRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * Cargar información de la senalización vertical de una vía.
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
        if ($user->can('show.signal_vertical.inventory_roads')) {
            $actions['search'] = [
                'route' => 'show.signal_vertical.inventory_roads',
                'tooltip' => trans('signal_vertical.labels.details')
            ];
        }
        if ($user->can('edit.signal_vertical.inventory_roads')) {
            $actions['edit'] = [
                'route' => 'edit.signal_vertical.inventory_roads',
                'tooltip' => trans('signal_vertical.labels.update')
            ];
        }
        $dataTable = DataTables::of($this->verticalSignalRepository->findByCodeDataTable($code))
            ->setRowId('gid')
            ->addColumn('actions', function (VerticalSignal $entity) use ($actions) {
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
     * Almacenar nueva senalización vertical para una vía.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $entity = $this->verticalSignalRepository->createFromArray($request->all());
        if (!$entity) {
            throw new Exception(trans('signal_vertical.messages.errors.create'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'signal_vertical' => true
        ];
    }

    /**
     * Retornar data necesaria para mostrar la información de la senalización vertical de una vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function show(string $gid)
    {
        $entity = $this->verticalSignalRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('signal_vertical.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de la senalización vertical de una vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function edit(string $gid)
    {
        $states = $this->catalogRepository->listState();
        $sides =  $this->catalogRepository->listSides();
        $typeVerticalSignals = $this->catalogRepository->listVerticalSignalType();
        $entity = $this->verticalSignalRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('signal_vertical.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity,
            'states' => $states,
            'sides' => $sides,
            'typeVerticalSignals' => $typeVerticalSignals
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de la senalización vertical de una vía.
     *
     * @param string $code
     *
     * @return array
     */
    public function create(string $code)
    {
        $states = $this->catalogRepository->listState();
        $sides =  $this->catalogRepository->listSides();
        $typeVerticalSignals = $this->catalogRepository->listVerticalSignalType();
        return [
            'code' => $code,
            'states' => $states,
            'sides' => $sides,
            'typeVerticalSignals' => $typeVerticalSignals
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
        $entity = $this->verticalSignalRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('signal_vertical.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->verticalSignalRepository->updateFromArray($request->all(), $entity);
        if (!$entity) {
            throw new Exception(trans('signal_vertical.messages.errors.update'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'signal_vertical' => true
        ];
    }
}