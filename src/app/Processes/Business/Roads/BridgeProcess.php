<?php

namespace App\Processes\Business\Roads;

use App\Models\Business\Roads\Bridge;
use App\Repositories\Repository\Business\Roads\CharacteristicsOfTrackRepository;
use App\Repositories\Repository\Business\Roads\BridgeRepository;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use App\Repositories\Repository\Business\Roads\Catalogs\CatalogRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Exception;


/**
 * Clase BridgeProcess
 * @package App\Processes\Business\Roads
 */
class BridgeProcess
{
    /**
     * @var BridgeRepository
     */
    protected $bridgeRepository;

    /**
     * @var CharacteristicsOfTrackRepository
     */
    protected $characteristicsOfTrackRepository;

    /**
     * @var GeneralCharacteristicsOfTrackRepository
     */
    protected $generalCharacteristicsOfTrackRepository;

     /**
     * @var CatalogRepository
     */
    protected $catalogRepository;

    /**
     * Constructor de BridgeProcess.
     *
     * @param BridgeRepository $bridgeRepository
     * @param CharacteristicsOfTrackRepository $characteristicsOfTrackRepository
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     * @param CatalogRepository $catalogRepository
     */
    public function __construct(
        BridgeRepository $bridgeRepository,
        CharacteristicsOfTrackRepository $characteristicsOfTrackRepository,
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository,
        CatalogRepository $catalogRepository
    )
    {
        $this->bridgeRepository = $bridgeRepository;
        $this->characteristicsOfTrackRepository = $characteristicsOfTrackRepository;
        $this->generalCharacteristicsOfTrackRepository = $generalCharacteristicsOfTrackRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * Cargar información de los Puentes de una via.
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
        if ($user->can('show.bridge.inventory_roads')) {
            $actions['search'] = [
                'route' => 'show.bridge.inventory_roads',
                'tooltip' => trans('bridge.labels.details')
            ];
        }
        if ($user->can('edit.bridge.inventory_roads')) {
            $actions['edit'] = [
                'route' => 'edit.bridge.inventory_roads',
                'tooltip' => trans('bridge.labels.update')
            ];
        }
        $dataTable = DataTables::of($this->bridgeRepository->findByCodeDataTable($code))
            ->setRowId('gid')
            ->addColumn('actions', function (Bridge $entity) use ($actions) {
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
     * Almacenar nuevo puente de la vía.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $entity = $this->bridgeRepository->createFromArray($request->all());
        if (!$entity) {
            throw new Exception(trans('bridge.messages.errors.create'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'bridge' => true
        ];
    }

    /**
     * Retornar data necesaria para mostrar la información de un puente de la vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function show(string $gid)
    {
        $entity = $this->bridgeRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('bridge.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de una intersección de la vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function edit(string $gid)
    {
        $entity = $this->bridgeRepository->findByGid($gid);
        $states = $this->catalogRepository->listState();
        $sideProtections = $this->catalogRepository->listSideProtections();
        $rollingLeatherBridges = $this->catalogRepository->listRollingLeatherBridges();
        if (!$entity) {
            throw  new Exception(trans('bridge.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity,
            'states' => $states,
            'sideProtections' => $sideProtections,
            'rollingLeatherBridges' => $rollingLeatherBridges
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de una intersección de la vía.
     *
     * @param string $code
     *
     * @return array
     */
    public function create(string $code)
    {
        $states = $this->catalogRepository->listState();
        $sideProtections = $this->catalogRepository->listSideProtections();
        $rollingLeatherBridges = $this->catalogRepository->listRollingLeatherBridges();
        return [
            'code' => $code,
            'states' => $states,
            'sideProtections' => $sideProtections,
            'rollingLeatherBridges' => $rollingLeatherBridges
        ];
    }

    /**
     * Actualizar la información de una intersección de la vía.
     *
     * @param Request $request
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function update(Request $request, string $gid)
    {
        $entity = $this->bridgeRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('bridge.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->bridgeRepository->updateFromArray($request->all(), $entity);
        if (!$entity) {
            throw new Exception(trans('bridge.messages.errors.update'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'bridge' => true
        ];
    }
}