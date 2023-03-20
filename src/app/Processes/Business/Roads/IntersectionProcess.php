<?php

namespace App\Processes\Business\Roads;

use App\Models\Business\Roads\Intersection;
use App\Repositories\Repository\Business\Roads\IntersectionRepository;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Exception;

/**
 * Clase IntersectionProcess
 * @package App\Processes\Business\Roads
 */
class IntersectionProcess
{
    /**
     * @var IntersectionRepository
     */
    protected $intersectionRepository;

    /**
     * @var GeneralCharacteristicsOfTrackRepository
     */
    protected $generalCharacteristicsOfTrackRepository;

    /**
     * Constructor de IntersectionProcess.
     *
     * @param IntersectionRepository $intersectionRepository
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     */
    public function __construct(
        IntersectionRepository $intersectionRepository,
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
    )
    {
        $this->intersectionRepository = $intersectionRepository;
        $this->generalCharacteristicsOfTrackRepository = $generalCharacteristicsOfTrackRepository;
    }

    /**
     * Cargar información de las intersecciones de una via.
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
        if ($user->can('show.intersection.inventory_roads')) {
            $actions['search'] = [
                'route' => 'show.intersection.inventory_roads',
                'tooltip' => trans('intersection.labels.details')
            ];
        }
        if ($user->can('edit.intersection.inventory_roads')) {
            $actions['edit'] = [
                'route' => 'edit.intersection.inventory_roads',
                'tooltip' => trans('intersection.labels.update')
            ];
        }
        $dataTable = DataTables::of($this->intersectionRepository->findByCodeDataTable($code))
            ->setRowId('gid')
            ->addColumn('actions', function (Intersection $entity) use ($actions) {
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
     * Almacenar nuevo interseccione de la vía.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $entity = $this->intersectionRepository->createFromArray($request->all());
        if (!$entity) {
            throw new Exception(trans('intersection.messages.errors.create'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'intersection' => true
        ];
    }

    /**
     * Retornar data necesaria para mostrar la información de una intersección de la vía.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function show(string $gid)
    {
        $entity = $this->intersectionRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('intersection.messages.exceptions.not_found'), 1000);
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
        $entity = $this->intersectionRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('intersection.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
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
        $entity = $this->intersectionRepository->findByGid($gid);
        if (!$entity) {
            throw  new Exception(trans('intersection.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->intersectionRepository->updateFromArray($request->all(), $entity);
        if (!$entity) {
            throw new Exception(trans('intersection.messages.errors.update'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'intersection' => true
        ];
    }
}