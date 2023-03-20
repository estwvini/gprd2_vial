<?php

namespace App\Processes\Business\Roads;

use App\Models\Business\Roads\CharacteristicsOfTrack;
use App\Repositories\Repository\Business\Roads\CharacteristicsOfTrackRepository;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use App\Repositories\Repository\Business\Roads\Catalogs\CatalogRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Exception;


/**
 * Clase CharacteristicsOfTrackProcess
 * @package App\Processes\Business\Roads
 */
class CharacteristicsOfTrackProcess
{
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
     * 
     * Constructor de CharacteristicsOfTrackProcess.
     *
     * @param CharacteristicsOfTrackRepository $characteristicsOfTrackRepository
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     * @param CatalogRepository $catalogRepository
     */
    public function __construct(
        CharacteristicsOfTrackRepository $characteristicsOfTrackRepository,
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository,
        CatalogRepository $catalogRepository
    )
    {
        $this->characteristicsOfTrackRepository = $characteristicsOfTrackRepository;
        $this->generalCharacteristicsOfTrackRepository = $generalCharacteristicsOfTrackRepository;
        $this->catalogRepository = $catalogRepository;
    }

    /**
     * Cargar información de las caracteristicas de la vía.
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
        if ($user->can('show.characteristics_of_track.inventory_roads')) {
            $actions['search'] = [
                'route' => 'show.characteristics_of_track.inventory_roads',
                'tooltip' => trans('characteristics_of_track.labels.details')
            ];
        }
        if ($user->can('edit.characteristics_of_track.inventory_roads')) {
            $actions['edit'] = [
                'route' => 'edit.characteristics_of_track.inventory_roads',
                'tooltip' => trans('characteristics_of_track.labels.update')
            ];
        }
        $dataTable = DataTables::of($this->characteristicsOfTrackRepository->findByCodeDataTable($code))
            ->setRowId('gid')
            ->addColumn('actions', function (CharacteristicsOfTrack $entity) use ($actions) {
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
     * Almacenar nueva caracteristicas de la vía.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $entity = $this->characteristicsOfTrackRepository->createFromArray($request->all());
        if (!$entity) {
            throw new Exception(trans('characteristics_of_track.messages.errors.create'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo)
        ];
    }

    /**
     * Retornar data necesaria para mostrar la información de la caracteristicas de la vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function show(string $gid)
    {
        $entity = $this->characteristicsOfTrackRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('characteristics_of_track.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de la caracteristicas de la vía.
     *
     * @param string $code
     *
     * @return array
     */
    public function create(string $code)
    {
        $states = $this->catalogRepository->listState();
        $lanes = $this->catalogRepository->listLanes();
        $roundSurfaceTypes = $this->catalogRepository->listRoundSurface();
        $typeOfLands = $this->catalogRepository->listLands();
        $useRoads = $this->catalogRepository->listUseRoads();
        $horizontalSignalTypes = $this->catalogRepository->listHorizontalSignalType();
        $verticalSignalTypes = $this->catalogRepository->listVerticalSignalType();
        return [
            'code' => $code,
            'states' => $states,
            'lanes' => $lanes,
            'roundSurfaceTypes' => $roundSurfaceTypes,
            'typeOfLands' => $typeOfLands,
            'useRoads' => $useRoads,
            'horizontalSignalTypes' => $horizontalSignalTypes,
            'verticalSignalTypes' => $verticalSignalTypes
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de la caracteristicas de la vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function edit(string $gid)
    {
        $states = $this->catalogRepository->listState();
        $lanes = $this->catalogRepository->listLanes();
        $roundSurfaceTypes = $this->catalogRepository->listRoundSurface();
        $typeOfLands = $this->catalogRepository->listLands();
        $useRoads = $this->catalogRepository->listUseRoads();
        $horizontalSignalTypes = $this->catalogRepository->listHorizontalSignalType();
        $verticalSignalTypes = $this->catalogRepository->listVerticalSignalType();
        $entity = $this->characteristicsOfTrackRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('characteristics_of_track.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity,
            'states' => $states,
            'lanes' => $lanes,
            'roundSurfaceTypes' => $roundSurfaceTypes,
            'typeOfLands' => $typeOfLands,
            'useRoads' => $useRoads,
            'horizontalSignalTypes' => $horizontalSignalTypes,
            'verticalSignalTypes' => $verticalSignalTypes
        ];
    }

    /**
     * Actualizar la información de la caracteristicas de la vía.
     *
     * @param Request $request
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function update(Request $request, string $gid)
    {
        $entity = $this->characteristicsOfTrackRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('characteristics_of_track.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->characteristicsOfTrackRepository->updateFromArray($request->all(), $entity);
        if (!$entity) {
            throw new Exception(trans('characteristics_of_track.messages.errors.update'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo)
        ];
    }
}