<?php

namespace App\Processes\Business\Planning;


use App\Models\Business\PlanIndicator;
use App\Repositories\Repository\Business\IndicatorGoalsRepository;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

/**
 * Clase PlanIndicatorProcess
 * @package App\Processes\Business\Planning
 */
class IndicatorGoalsProcess
{
    /**
     * @var IndicatorGoalsRepository
     */
    protected $indicatorGoalsRepository;
    protected $planIndicatorRepository;

    /**
     * Constructor de IndicatorGoalsProcess.
     *
     * @param IndicatorGoalsRepository $indicatorGoalsRepository
     * @param PlanIndicatorRepository $planIndicatorRepository
     */
    public function __construct(
        IndicatorGoalsRepository $indicatorGoalsRepository,
        PlanIndicatorRepository $planIndicatorRepository
    ) {
        $this->indicatorGoalsRepository = $indicatorGoalsRepository;
        $this->planIndicatorRepository = $planIndicatorRepository;
    }

    /**
     * Crear un datatable con el listado de Metas de un Indicador.
     *
     * @param int $planElementId
     *
     * @return mixed
     */
    public function data(int $planElementId)
    {

    }

    /**
     * Cargar la vista correspondiente a la creación de Metas.
     *
     * @param int $planElementId
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function create(int $planElementId)
    {
        $response['view'] = view('business.planning.indicators.create', [
            'measuringUnits' => PlanIndicator::measuringUnits(),
            'types' => PlanIndicator::types(),
            'goalTypes' => PlanIndicator::goalTypes(),
            'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
            'planElementId' => $planElementId
        ])->render();

        return $response;
    }

    /**
     * Guarda nuevas metas de Indicador en la Base de Datos
     *
     * @param Request $request
     * @param int $indicatorId
     *
     * @return array
     * @throws \Throwable
     */
    public function store(Request $request, int $indicatorId)
    {

        $indicatorAux = $this->planIndicatorRepository->find($indicatorId);

        $year = $indicatorAux->indicatorable->plan->start_year;

        $entity = $this->indicatorGoalsRepository->createFromArray($request->all(), $indicatorId, $year, $indicatorAux);

        if (!$entity) {
            throw new \Exception(trans('plan_indicators.messages.errors.create'), 1000);
        }

        $response = [
            'view' => view('business.planning.indicators.goals', [

                'measuringUnit' => PlanIndicator::measuringUnits()[$entity->measuring_unit],
                'types' => PlanIndicator::types(),
                'goalTypes' => PlanIndicator::goalTypes(),
                'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
                'entity' => $entity,
            ])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('plan_indicators.messages.success.updated')
            ],
            'success' => true
        ];

        return $response;
    }

    /**
     *
     *
     * @param int $planElementId
     * @param int $id
     *
     * @return mixed
     */
    public function show(int $planElementId, int $id)
    {

    }

    /**
     *
     *
     * @param int $planElementId
     * @param int $id
     *
     * @return mixed
     * @throws \Throwable
     */
    public function edit(int $planElementId, int $id)
    {
        $entity = $this->planIndicatorRepository->find($id);

        if (!$entity) {
            throw  new \Exception(trans('plan_indicators.messages.exceptions.not_found'), 1000);
        }

        $response['view'] = view('business.planning.indicators.update', [
            'entity' => $entity,
            'measuringUnits' => PlanIndicator::measuringUnits(),
            'types' => PlanIndicator::types(),
            'goalTypes' => PlanIndicator::goalTypes(),
            'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
            'planElementId' => $planElementId
        ])->render();

        return $response;
    }

    /**
     *
     *
     * @param Request $request
     * @param int $planElementId
     * @param int $id
     *
     * @return array
     * @throws \App\Repositories\Library\Exceptions\ModelException
     * @throws \Throwable
     */
    public function update(Request $request, int $planElementId, int $id)
    {
        $entity = $this->planIndicatorRepository->find($id);

        if (!$entity) {
            throw  new \Exception(trans('plan_indicators.messages.exceptions.not_found'), 1000);
        }

        $this->indicatorGoalsRepository->deleteAll($id);

        $entity = $this->indicatorGoalsRepository->createFromArray($request->all(), $id, $entity);

        $response = [
            'view' => view('business.planning.indicators.index', [
                'entity' => $entity,
                'planElementId' => $entity->plan_element_id
            ])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('plan_indicators.messages.success.updated')
            ]
        ];

        return $response;
    }

    /**
     *
     *
     * @param int $planElementId
     * @param int $id
     *
     * @return void
     */
    public function destroy(int $planElementId, int $id)
    {

    }

    /**
     *
     *
     * @param int $planElementId
     * @param int $id
     *
     * @return mixed
     */
    public function status(int $planElementId, int $id)
    {

    }
}