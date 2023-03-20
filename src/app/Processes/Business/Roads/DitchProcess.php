<?php

namespace App\Processes\Business\Roads;

use App\Models\Business\Roads\Ditch;
use App\Repositories\Repository\Business\Roads\DitchRepository;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use App\Repositories\Repository\Business\Roads\Catalogs\CatalogRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Exception;

/**
 * Clase DitchProcess
 * @package App\Processes\Business\Roads
 */
class DitchProcess
{
    /**
     * @var DitchRepository
     */
    protected $ditchRepository;

    /**
     * @var GeneralCharacteristicsOfTrackRepository
     */
    protected $generalCharacteristicsOfTrackRepository;

    /**
     * @var CatalogRepository
     */
    protected $catalogRepository;

    /**
     * Constructor de DitchProcess.
     *
     * @param DitchRepository $ditchRepository
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     * @param CatalogRepository $catalogRepository
     */
    public function __construct(
        DitchRepository $ditchRepository,
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository,
        CatalogRepository $catalogRepository
    )
    {
        $this->ditchRepository = $ditchRepository;
        $this->generalCharacteristicsOfTrackRepository = $generalCharacteristicsOfTrackRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * Cargar información de las cunetas de una vía.
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
        if ($user->can('show.ditch.inventory_roads')) {
            $actions['search'] = [
                'route' => 'show.ditch.inventory_roads',
                'tooltip' => trans('ditch.labels.details')
            ];
        }
        if ($user->can('edit.ditch.inventory_roads')) {
            $actions['edit'] = [
                'route' => 'edit.ditch.inventory_roads',
                'tooltip' => trans('ditch.labels.update')
            ];
        }
        $dataTable = DataTables::of($this->ditchRepository->findByCodeDataTable($code))
            ->setRowId('gid')
            ->addColumn('actions', function (Ditch $entity) use ($actions) {
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
     * Almacenar nueva cuneta para una vía.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $entity = $this->ditchRepository->createFromArray($request->all());
        if (!$entity) {
            throw new Exception(trans('ditch.messages.errors.create'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'ditch' => true
        ];
    }

    /**
     * Retornar data necesaria para mostrar la información de las cunetas de una vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function show(string $gid)
    {
        $entity = $this->ditchRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('ditch.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de las cunetas de una vía.
     *
     * @param string $code
     *
     * @return array
     */
    public function create(string $code)
    {
        $states = $this->catalogRepository->listState();
        $typeDitches = $this->catalogRepository->listTypeDitches();
        $sides = $this->catalogRepository->listSides();
        return [
            'code' => $code,
            'states' => $states,
            'typeDitches' => $typeDitches,
            'sides' => $sides
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de las cunetas de una vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function edit(string $gid)
    {
        $states = $this->catalogRepository->listState();
        $typeDitches = $this->catalogRepository->listTypeDitches();
        $sides = $this->catalogRepository->listSides();
        $entity = $this->ditchRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('ditch.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity,
            'states' => $states,
            'typeDitches' => $typeDitches,
            'sides' => $sides
        ];
    }

    /**
     * Actualizar la información de la cuneta de una vía.
     *
     * @param Request $request
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function update(Request $request, string $gid)
    {
        $entity = $this->ditchRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('ditch.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->ditchRepository->updateFromArray($request->all(), $entity);

        if (!$entity) {
            throw new Exception(trans('ditch.messages.errors.update'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'ditch' => true
        ];
    }
}