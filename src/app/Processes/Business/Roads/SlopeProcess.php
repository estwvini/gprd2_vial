<?php

namespace App\Processes\Business\Roads;

use App\Models\Business\Roads\Slope;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use App\Repositories\Repository\Business\Roads\SlopeRepository;
use App\Repositories\Repository\Business\Roads\Catalogs\CatalogRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Exception;

/**
 * Clase SlopeProcess
 * @package App\Processes\Business\Roads
 */
class SlopeProcess
{
    /**
     * @var SlopeRepository
     */
    protected $slopeRepository;

    /**
     * @var GeneralCharacteristicsOfTrackRepository
     */
    protected $generalCharacteristicsOfTrackRepository;

    /**
     * @var CatalogRepository
     */
    protected $catalogRepository;
    /**
     * Constructor de SlopeProcess.
     *
     * @param SlopeRepository $slopeRepository
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     * @param CatalogRepository $catalogRepository
     */
    public function __construct(
        SlopeRepository $slopeRepository,
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository,
        CatalogRepository $catalogRepository
    )
    {
        $this->slopeRepository = $slopeRepository;
        $this->generalCharacteristicsOfTrackRepository = $generalCharacteristicsOfTrackRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * Cargar información de los talud de una vía.
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
        if ($user->can('show.slope.inventory_roads')) {
            $actions['search'] = [
                'route' => 'show.slope.inventory_roads',
                'tooltip' => trans('slope.labels.details')
            ];
        }
        if ($user->can('edit.slope.inventory_roads')) {
            $actions['edit'] = [
                'route' => 'edit.slope.inventory_roads',
                'tooltip' => trans('slope.labels.update')
            ];
        }
        $dataTable = DataTables::of($this->slopeRepository->findByCodeDataTable($code))
            ->setRowId('gid')
            ->addColumn('actions', function (Slope $entity) use ($actions) {
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
     * Almacenar nuevo talud para una vía.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $entity = $this->slopeRepository->createFromArray($request->all());
        if (!$entity) {
            throw new Exception(trans('slope.messages.errors.create'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'slope' => true
        ];
    }

    /**
     * Retornar data necesaria para mostrar la información del talud de una vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function show(string $gid)
    {
        $entity = $this->slopeRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('slope.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación del talud de una vía.
     *
     * @param string $code
     *
     * @return array
     * @throws Exception
     */
    public function create(string $code)
    {
        $states =  $this->catalogRepository->listState();
        $typeSlopes = $this->catalogRepository->listTypeSlopes();
        return [
            'code' => $code,
            'states' => $states,
            'typeSlopes' => $typeSlopes
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición del talud de una vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function edit(string $gid)
    {
        $states =  $this->catalogRepository->listState();
        $typeSlopes = $this->catalogRepository->listTypeSlopes();
        $entity = $this->slopeRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('slope.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity,
            'states' => $states,
            'typeSlopes' => $typeSlopes
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición del talud de una vía.
     *
     * @param string $code
     *
     * @return array
     * @throws Exception
     */
    public function createcreación(string $code)
    {
        $states =  $this->catalogRepository->listState();
        $typeSlopes = $this->catalogRepository->listTypeSlopes();
        return [
            'code' => $code,
            'states' => $states,
            'typeSlopes' => $typeSlopes
        ];
    }

    /**
     * Actualizar la información del talud de una vía.
     *
     * @param Request $request
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function update(Request $request, string $gid)
    {
        $entity = $this->slopeRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('slope.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->slopeRepository->updateFromArray($request->all(), $entity);
        if (!$entity) {
            throw new Exception(trans('slope.messages.errors.update'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'slope' => true
        ];
    }
}