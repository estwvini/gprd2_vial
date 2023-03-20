<?php

namespace App\Processes\Business\Planning;

use App\Models\Business\PlanIndicator;
use App\Models\System\File;
use App\Repositories\Repository\Business\IndicatorGoalsRepository;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Throwable;
use Exception;
use App\Repositories\Library\Exceptions\ModelException;

/**
 * Clase PlanIndicatorProcess
 * @package App\Processes\Business\Planning
 */
class PlanIndicatorProcess
{
    /**
     * @var PlanIndicatorRepository
     */
    protected $planIndicatorRepository;

    protected $indicatorGoalsRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * Constructor de PlanIndicatorProcess.
     *
     * @param PlanIndicatorRepository $planIndicatorRepository
     * @param IndicatorGoalsRepository $indicatorGoalsRepository
     * @param FiscalYearRepository $fiscalYearRepository
     */
    public function __construct(
        PlanIndicatorRepository $planIndicatorRepository,
        IndicatorGoalsRepository $indicatorGoalsRepository,
        FiscalYearRepository $fiscalYearRepository
    ) {
        $this->planIndicatorRepository = $planIndicatorRepository;
        $this->indicatorGoalsRepository = $indicatorGoalsRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
    }

    /**
     * Guarda un nuevo Indicador en la Base de Datos
     *
     * @param Request $request
     * @param Model $indicatorableEntity
     * @param int $goalsCount
     * @param int $year
     *
     * @return array
     * @throws Exception
     */
    public function storeFullIndicator(Request $request, Model $indicatorableEntity, int $goalsCount, int $year)
    {
        $entity = $this->planIndicatorRepository->createFromArray($request->all());

        $entity = $indicatorableEntity->indicators()->save($entity);

        $this->indicatorGoalsRepository->createFromArray($request->all(), $entity->id, $year, $goalsCount);

        if (!$entity) {
            throw new Exception(trans('plan_indicators.messages.errors.create'), 1000);
        }

        $data = $request->all();

        if (isset($data['justifiableMultiple']) && $data['justifiableMultiple']) {
            $entity->justifications()->save(storeJustification($data, $entity, true));
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('plan_indicators.messages.success.created')
            ]
        ];

        return $response;
    }

    /**
     * Guarda un nuevo Indicador reducido en la Base de Datos
     *
     * @param Request $request
     * @param Model $indicatorableEntity
     *
     * @return array
     * @throws \Throwable
     */
    public function storeSmallIndicator(Request $request, Model $indicatorableEntity)
    {
        $entity = $this->planIndicatorRepository->createFromArray($request->all());

        $entity = $indicatorableEntity->indicators()->save($entity);

        if (!$entity) {
            throw new Exception(trans('plan_indicators.messages.errors.create'), 1000);
        }

        return [
            'message' => [
                'type' => 'success',
                'text' => trans('plan_indicators.messages.success.created')
            ]
        ];
    }

    /**
     * Devuelve la vista de editar con los datos del Indicador segun Id
     *
     * @param int $id
     * @param string $url
     *
     * @return mixed
     * @throws Throwable
     */
    public function edit(int $id, string $url)
    {
        $entity = $this->planIndicatorRepository->find($id);

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$entity) {
            throw  new Exception(trans('plan_indicators.messages.exceptions.not_found'), 1000);
        }

        $response['view'] = view('business.planning.indicators.update', [
            'entity' => $entity,
            'measuringUnits' => PlanIndicator::measuringUnits(),
            'types' => PlanIndicator::types(),
            'goalTypes' => PlanIndicator::goalTypes(),
            'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
            'url' => $url,
            'currentFiscalYear' => $currentFiscalYear
        ])->render();

        return $response;
    }

    /**
     * Actualiza Indicador segun Id
     *
     * @param Request $request
     * @param int $id
     * @param int $goalsCount
     *
     * @param int $startYear
     *
     * @return array
     * @throws ModelException
     * @throws Exception
     */
    public function update(Request $request, int $id, int $goalsCount, int $startYear)
    {
        $entity = $this->planIndicatorRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('plan_indicators.messages.exceptions.not_found'), 1000);
        }

        $data = $request->all();
        $justification = null;

        if (isset($data['justifiableMultiple']) && $data['justifiableMultiple']) {
            $justification = storeJustification($data, $entity, true);
        }

        if (!isset($data['type'])) {
            $data['type'] = $entity->type;
        }

        $entity = $this->planIndicatorRepository->updateFromArray($data, $entity);
        $this->indicatorGoalsRepository->createFromArray($data, $entity->id, $startYear, $goalsCount);

        if (isset($data['justifiableMultiple']) && $data['justifiableMultiple'] && isset($justification)) {
            $entity->justifications()->save($justification);
        }

        if (!$entity) {
            throw new Exception(trans('plan_indicators.messages.errors.update'), 1000);
        }

        return [
            'message' => [
                'type' => 'success',
                'text' => trans('plan_indicators.messages.success.updated')
            ]
        ];
    }

    /**
     * Elimina un indicador de la base de datos
     *
     * @param int $id
     * @param Request $request
     *
     * @return bool
     * @throws Exception
     */
    public function destroy(int $id, Request $request)
    {
        $entity = $this->planIndicatorRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('plan_indicators.messages.exceptions.not_found'), 1000);
        }

        $data = $request->all();
        $justification = null;

        if (isset($data['justifiableMultiple']) && $data['justifiableMultiple']) {
            $justification = storeJustification($data, $entity, true);
        }

        if ($entity->hasProgress()) {
            throw new Exception(trans('plan_indicators.messages.exceptions.has_children'), 1000);
        }

        if (!$this->planIndicatorRepository->delete($entity)) {
            throw new Exception(trans('plan_indicators.messages.errors.delete'), 1000);
        }

        if (isset($data['justifiableMultiple']) && $data['justifiableMultiple'] && isset($justification)) {
            $entity->justifications()->save($justification);
        }

        return true;
    }

    /**
     * Actualiza un Indicador reducido en la Base de Datos
     *
     * @param int $id
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function updateSmallIndicator(int $id, Request $request)
    {
        $entity = $this->planIndicatorRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('plan_indicators.messages.exceptions.not_found'), 1000);
        }

        $entity = $this->planIndicatorRepository->updateFromArray($request->all(), $entity);

        if (!$entity) {
            throw new Exception(trans('plan_indicators.messages.errors.update'), 1000);
        }

        return $entity;
    }

    /**
     * Descargar un archivo.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function download(int $id)
    {
        $entity = $this->planIndicatorRepository->find($id);

        $path = env('INDICATORS_PATH') . '/' . $entity->technical_file;

        if (!file_exists($path)) {
            throw new Exception(trans('files.messages.exceptions.not_found'), 1000);
        } else {
            $headers = array(
                'Content-Type: application/pdf'
            );
            return Response::download($path, 'archivo_tecnico.pdf', $headers);
        }
    }

    /**
     * Procesar elementos enviados antes de guardarlos en la Base de Datos.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function deleteFile(int $id)
    {

        $entity = $this->planIndicatorRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('files.messages.exceptions.not_found'), 1000);
        }

        $path = env('INDICATORS_PATH') . '/' . $entity->technical_file;
        if (!file_exists($path)) {
            throw new Exception(trans('files.messages.exceptions.not_found'), 1000);
        } else {
            unlink($path);
            $entity->technical_file = null;
            $entity->save();
            if ($entity->indicatorable_type == PlanIndicator::INDICATORABLE_ACTIVITY_ROUTE) {
                $vista = 'business.planning.projects.logic_frame.components.indicators.partial.inputs';
            } else {
                $vista = 'business.planning.indicators.partial.inputs';
            }
        }
        return [
            'view' => view($vista, ['entity' => $entity->fresh()])->render(),
            'message' => [
                'type' => 'success',
                'text' => trans('attachments.messages.success.deleted')
            ]
        ];
    }
}