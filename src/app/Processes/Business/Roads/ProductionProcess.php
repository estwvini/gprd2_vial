<?php

namespace App\Processes\Business\Roads;

use App\Models\Business\Roads\Production;
use App\Repositories\Repository\Business\Roads\ProductionRepository;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use App\Repositories\Repository\Business\Roads\Catalogs\CatalogRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Exception;

/**
 * Clase ProductionProcess
 * @package App\Processes\Business\Roads
 */
class ProductionProcess
{
    /**
     * @var ProductionRepository
     */
    protected $productionRepository;

    /**
     * @var GeneralCharacteristicsOfTrackRepository
     */
    protected $generalCharacteristicsOfTrackRepository;

    /**
     * @var CatalogRepository
     */
    protected $catalogRepository;

    /**
     * Constructor de ProductionProcess.
     *
     * @param ProductionRepository $productionRepository
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     * @param CatalogRepository $catalogRepository
     */
    public function __construct(
        ProductionRepository $productionRepository,
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository,
        CatalogRepository $catalogRepository
    )
    {
        $this->productionRepository = $productionRepository;
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
        if ($user->can('show.production.inventory_roads')) {
            $actions['search'] = [
                'route' => 'show.production.inventory_roads',
                'tooltip' => trans('production.labels.details')
            ];
        }
        if ($user->can('edit.production.inventory_roads')) {
            $actions['edit'] = [
                'route' => 'edit.production.inventory_roads',
                'tooltip' => trans('production.labels.update')
            ];
        }
        $dataTable = DataTables::of($this->productionRepository->findByCodeDataTable($code))
            ->setRowId('gid')
            ->addColumn('actions', function (Production $entity) use ($actions) {
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
     * Almacenar nueva producción para una vía.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $entity = $this->productionRepository->createFromArray($request->all());
        if (!$entity) {
            throw new Exception(trans('production.messages.errors.create'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'production' => true
        ];
    }

    /**
     * Retornar data necesaria para mostrar la información de una producción de una vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function show(string $gid)
    {
        $entity = $this->productionRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('production.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de una producción de una vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function edit(string $gid)
    {
        $productiveSectors = $this->catalogRepository->listProductiveSectors();       
        $entity = $this->productionRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('production.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity,
            'productiveSectors' => $productiveSectors
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de una producción de una vía.
     *
     * @param string $code
     *
     * @return array
     */
    public function create(string $code)
    {
        $productiveSectors = $this->catalogRepository->listProductiveSectors();     
        return [
            'code' => $code,
            'productiveSectors' => $productiveSectors
        ];
    }

    /**
     * Actualizar la información de la producción de una vía.
     *
     * @param Request $request
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function update(Request $request, string $gid)
    {
        $entity = $this->productionRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('production.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->productionRepository->updateFromArray($request->all(), $entity);
        if (!$entity) {
            throw new Exception(trans('production.messages.errors.update'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'production' => true
        ];
    }
}