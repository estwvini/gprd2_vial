<?php

namespace App\Processes\Business\Roads;

use App\Models\Business\Roads\EnvironmentalInformation;
use App\Repositories\Repository\Business\Roads\EnvironmentalInformationRepository;
use App\Repositories\Repository\Business\Roads\GeneralCharacteristicsOfTrackRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use Exception;
use Throwable;

/**
 * Clase EnvironmentalInformationProcess
 * @package App\Processes\Business\Roads
 */
class EnvironmentalInformationProcess
{
    /**
     * @var EnvironmentalInformationRepository
     */
    protected $environmentalInformationRepository;

    /**
     * @var GeneralCharacteristicsOfTrackRepository
     */
    protected $generalCharacteristicsOfTrackRepository;

    /**
     * Constructor de EnvironmentalInformationProcess.
     *
     * @param EnvironmentalInformationRepository $environmentalInformationRepository
     * @param GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
     */
    public function __construct(
        EnvironmentalInformationRepository $environmentalInformationRepository,
        GeneralCharacteristicsOfTrackRepository $generalCharacteristicsOfTrackRepository
    )
    {
        $this->environmentalInformationRepository = $environmentalInformationRepository;
        $this->generalCharacteristicsOfTrackRepository = $generalCharacteristicsOfTrackRepository;
    }

    /**
     * Cargar información de todas los informes ambientales de una vía.
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
        if ($user->can('show.environmental_information.inventory_roads')) {
            $actions['search'] = [
                'route' => 'show.environmental_information.inventory_roads',
                'tooltip' => trans('environmental_information.labels.details')
            ];
        }
        if ($user->can('edit.environmental_information.inventory_roads')) {
            $actions['edit'] = [
                'route' => 'edit.environmental_information.inventory_roads',
                'tooltip' => trans('environmental_information.labels.update')
            ];
        }
        $dataTable = DataTables::of($this->environmentalInformationRepository->findByCodeDataTable($code))
            ->setRowId('codigo')
            ->addColumn('actions', function (EnvironmentalInformation $entity) use ($actions) {              
                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->editColumn('participa', function ($entity) {
                return $entity->participa === 'T' ? 'SI' : 'NO';
            })
            ->editColumn('eval_riesg', function ($entity) {
                return $entity->eval_riesg === 'T' ? 'SI' : 'NO';
            })
            ->editColumn('riesg_pot', function ($entity) {
                return $entity->riesg_pot === 'T' ? 'SI' : 'NO';
            })
            ->editColumn('reserv_nat', function ($entity) {
                return $entity->reserv_nat === 'T' ? 'SI' : 'NO';
            })
            ->editColumn('pueb_indig', function ($entity) {
                return $entity->pueb_indig === 'T' ? 'SI' : 'NO';
            })
            ->editColumn('prot_cuenc', function ($entity) {
                return $entity->prot_cuenc === 'T' ? 'SI' : 'NO';
            })
            ->editColumn('resforest', function ($entity) {
                return $entity->resforest === 'T' ? 'SI' : 'NO';
            })
            ->editColumn('act_ambie', function ($entity) {
                return $entity->act_ambie === 'T' ? 'SI' : 'NO';
            })
            ->rawColumns(['actions'])
            ->make(true);
        return $dataTable;
    }

    /**
     * Almacenar nueva necesidad de los informes ambientales una vía.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function store(Request $request)
    {
        $entity = $this->environmentalInformationRepository->createFromArray($request->all());
        if (!$entity) {
            throw new Exception(trans('environmental_information.messages.errors.create'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($request->codigo),
            'environmental_information' => true
        ];
    }

    /**
     * Retornar data necesaria para mostrar la información de los informes ambientales.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function show(string $gid)
    {
        $entity = $this->environmentalInformationRepository->findByCodeFirst($gid);
        if (!$entity) {
            throw  new Exception(trans('environmental_information.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de los informes ambientales.
     *
     * @param string $code
     *
     * @return array
     * @throws Throwable
     */
    public function create(string $code)
    {
        $environmentalInformation = $this->environmentalInformationRepository->findByCode($code);
        if (count($environmentalInformation) > 0) {
            $response = [
                'message' => [
                    'type' => 'danger',
                    'text' => trans('environmental_information.messages.errors.register_exist')
                ]
            ];
        } else {
            $response['modal'] = view('business.roads.environmental_information.create',
                [
                    'code' => $code
                ]
            )->render();
        }
        return $response;
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de los informes ambientales.
     *
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function edit(string $gid)
    {
        $entity = $this->environmentalInformationRepository->findByCodeFirst($gid);
        if (!$entity) {
            throw  new Exception(trans('environmental_information.messages.exceptions.not_found'), 1000);
        }
        return [
            'entity' => $entity
        ];
    }

    /**
     * Actualizar la información de los informes ambientales de una vía.
     *
     * @param Request $request
     * @param string $gid
     *
     * @return array
     * @throws Exception
     */
    public function update(Request $request, string $gid)
    {
        $entity = $this->environmentalInformationRepository->findByCodeFirst($gid);
        if (!$entity) {
            throw  new Exception(trans('environmental_information.messages.exceptions.not_found'), 1000);
        }
        $entity = $this->environmentalInformationRepository->updateFromArray($request->all(), $entity);
        if (!$entity) {
            throw new Exception(trans('environmental_information.messages.errors.update'), 1000);
        }
        return [
            'entity' => $this->generalCharacteristicsOfTrackRepository->findByCode($entity->codigo),
            'environmental_information' => true
        ];
    }
}