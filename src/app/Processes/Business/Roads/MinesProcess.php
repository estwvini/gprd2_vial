<?php

namespace App\Processes\Business\Roads;

use App\Models\Business\Roads\Mines;
use App\Repositories\Repository\Business\Roads\MinesRepository;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use App\Repositories\Repository\Business\Roads\Catalogs\CatalogRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Exception;

/**
 * Clase MinesProcess
 * @package App\Processes\Business\Roads
 */
class MinesProcess
{
    /**
     * @var MinesRepository
     */
    protected $minesRepository;

    /**
     * @var GeneralCharacteristicsOfTrackRepository
     */
    protected $generalCharacteristicsOfTrackRepository;

    /**
     * @var CatalogRepository
     */
    protected $catalogRepository;

    /**
     * Constructor de MinesProcess.
     *
     * @param MinesRepository $minesRepository
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     * @param CatalogRepository $catalogRepository
     */
    public function __construct(
        MinesRepository $minesRepository,
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository,
        CatalogRepository $catalogRepository
    )
    {
        $this->minesRepository = $minesRepository;
        $this->generalCharacteristicsOfTrackRepository = $generalCharacteristicsOfTrackRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * Cargar información de las minas de una vía.
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
        if ($user->can('show.mines.inventory_roads')) {
            $actions['search'] = [
                'route' => 'show.mines.inventory_roads',
                'tooltip' => trans('mines.labels.details')
            ];
        }
        if ($user->can('edit.mines.inventory_roads')) {
            $actions['edit'] = [
                'route' => 'edit.mines.inventory_roads',
                'tooltip' => trans('mines.labels.update')
            ];
        }
        $dataTable = DataTables::of($this->minesRepository->findByCodeDataTable($code))
            ->setRowId('gid')
            ->addColumn('actions', function (Mines $entity) use ($actions) {
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
     * Almacenar nueva mina para una vía.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $entity = $this->minesRepository->createFromArray($request->all());
        if (!$entity) {
            throw new Exception(trans('mines.messages.errors.create'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'mines' => true
        ];
    }

    /**
     * Retornar data necesaria para mostrar la información de la mina de una vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function show(string $gid)
    {
        $entity = $this->minesRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('mines.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de la mina de una vía.
     *
     * @param string $code
     *
     * @return array
     * @throws Exception
     */
    public function crate(string $code)
    {
        $sources = $this->catalogRepository->listSources();
        $typeMines = $this->catalogRepository->listTypeMines();
        $materialMines = $this->catalogRepository->listMaterialMines();
        return [
            'code' => $code,
            'sources' => $sources,
            'typeMines' => $typeMines,
            'materialMines' => $materialMines
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de la mina de una vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function edit(string $gid)
    {
        $sources = $this->catalogRepository->listSources();
        $typeMines = $this->catalogRepository->listTypeMines();
        $materialMines = $this->catalogRepository->listMaterialMines();
        $entity = $this->minesRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('mines.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity,
            'sources' => $sources,
            'typeMines' => $typeMines,
            'materialMines' => $materialMines
        ];
    }

    /**
     * Actualizar la información de la mina de una vía.
     *
     * @param Request $request
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function update(Request $request, string $gid)
    {
        $entity = $this->minesRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('mines.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->minesRepository->updateFromArray($request->all(), $entity);

        if (!$entity) {
            throw new Exception(trans('mines.messages.errors.update'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'mines' => true
        ];
    }
}