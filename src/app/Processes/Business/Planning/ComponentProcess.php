<?php

namespace App\Processes\Business\Planning;

use App\Models\Business\Component;
use App\Models\Business\Plan;
use App\Models\Business\PlanIndicator;
use App\Models\Business\Project;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Repository\Business\Catalogs\AreaRepository;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use App\Repositories\Repository\Business\ComponentRepository;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use Exception;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase ComponentProcess
 * @package App\Processes\Business\Planning
 */
class ComponentProcess
{

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * @var AreaRepository
     */
    private $areaRepository;

    /**
     * @var ComponentRepository
     */
    protected $componentRepository;

    /**
     * @var PlanIndicatorProcess
     */
    private $indicatorProcess;

    /**
     * @var PlanIndicatorRepository
     */
    private $indicatorRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * Constructor de ComponentProcess.
     *
     * @param ProjectRepository $projectRepository
     * @param AreaRepository $areaRepository
     * @param ComponentRepository $componentRepository
     * @param PlanIndicatorProcess $indicatorProcess
     * @param PlanIndicatorRepository $indicatorRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     */
    public function __construct(
        ProjectRepository $projectRepository,
        AreaRepository $areaRepository,
        ComponentRepository $componentRepository,
        PlanIndicatorProcess $indicatorProcess,
        PlanIndicatorRepository $indicatorRepository,
        FiscalYearRepository $fiscalYearRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository
    ) {
        $this->projectRepository = $projectRepository;
        $this->areaRepository = $areaRepository;
        $this->componentRepository = $componentRepository;
        $this->indicatorProcess = $indicatorProcess;
        $this->indicatorRepository = $indicatorRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
    }

    /**
     * Almacena un nuevo componente
     *
     * @param Request $request
     * @param int $projectId
     *
     * @return Project
     * @throws ModelException
     * @throws Exception
     */
    public function store(Request $request, int $projectId)
    {
        $project = $this->projectRepository->find($projectId);

        if (!$project) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        $entity = $this->componentRepository->createFromArray($request->all(), $project);

        if (!$entity) {
            throw new Exception(trans('components.messages.errors.create'), 1000);
        }

        return $entity->project;
    }

    /**
     * Edita un componente
     *
     * @param Request $request
     * @param int $componentId
     *
     * @return Project
     * @throws ModelException
     * @throws Exception
     */
    public function update(Request $request, int $componentId)
    {
        $component = $this->componentRepository->find($componentId);

        if (!$component) {
            throw new Exception(trans('components.messages.exceptions.not_found'), 1000);
        }

        $entity = $this->componentRepository->updateFromArray($request->all(), $component, $component->project);

        if (!$entity) {
            throw new Exception(trans('components.messages.errors.create'), 1000);
        }

        return $entity->project;
    }

    /**
     * Edita un componente
     *
     * @param int $componentId
     *
     * @return Component
     * @throws Exception
     */
    public function edit(int $componentId)
    {
        $entity = $this->componentRepository->find($componentId);

        if (!$entity) {
            throw new Exception(trans('components.messages.exceptions.not_found'), 1000);
        }

        return $entity;
    }

    /**
     * Eliminar lógicamente un componente.
     *
     * @param int $id
     *
     * @return Project
     * @throws ModelException
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $entity = $this->componentRepository->find($id);
        if (!$entity) {
            throw new Exception(trans('components.messages.exceptions.not_found'), 1000);
        }

        if ($entity->indicators->count() || $entity->allActivitiesProjectFiscalYear->count()) {
            throw new Exception(trans('components.messages.exceptions.component_is_not_empty'), 1000);
        }

        if (!$this->componentRepository->delete($entity)) {
            throw new Exception(trans('components.messages.errors.delete'), 1000);
        }

        $project = $this->projectRepository->find($entity->project->id, ['*']);

        return $project;
    }

    /**
     * Mostrar el formulario completo de creación de un indicador.
     *
     * @param int $componentId
     *
     * @return mixed
     * @throws Throwable
     */
    public function createIndicator(int $componentId)
    {
        $entity = $this->componentRepository->find($componentId);

        return $entity;
    }

    /**
     * Almacena un indicador completo
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Throwable
     */
    public function storeIndicator(Request $request)
    {
        $data = $request->all();
        $frequency = 1;

        $entity = $this->componentRepository->find($data['componentId']);

        if (isset($data['measurement_frequency_per_year'])) {
            $frequency = $data['measurement_frequency_per_year'];
        }

        $goalsCount = (date("Y", strtotime($entity->project->date_end)) - date("Y",
                    strtotime($entity->project->date_init))) * $frequency;
        if ($frequency ==2) {
            $goalsCount += 1;
        }else if($frequency==4){
            $goalsCount+=3;
        }
        $indicator = $this->indicatorProcess->storeFullIndicator($request, $entity, $goalsCount,
            date("Y", strtotime($entity->project->date_init)));

        if (!$indicator) {
            throw new Exception(trans('plan_elements.messages.errors.create'), 1000);
        }

        $entity = $this->componentRepository->find($data['componentId']);

        if (!$entity) {
            throw new Exception(trans('plan_elements.messages.errors.create'), 1000);
        }

        return $entity;
    }

    /**
     * Mostrar formulario de edición de un indicador completo
     *
     * @param int $id
     *
     * @return mixed
     * @throws Throwable
     */
    public function editIndicator(int $id)
    {
        $entity = $this->indicatorRepository->find($id);

        return $entity;
    }

    /**
     * Mostrar formulario de edición de un indicador completo
     *
     * @param int $id
     * @param string $url
     *
     * @return mixed
     * @throws Throwable
     */
    public function editIndicatorShow(int $id, string $url)
    {
        $entity = $this->indicatorRepository->find($id);

        return $entity;
    }

    /**
     * Actualiza un indicador completo
     *
     * @param int $indicatorId
     * @param Request $request
     *
     * @return mixed
     * @throws ModelException
     * @throws Exception
     */
    public function updateIndicator(int $indicatorId, Request $request)
    {
        $entity = $this->indicatorRepository->find($indicatorId);

        if (!$entity) {
            throw new Exception(trans('indicators.messages.exceptions.not_found'), 1000);
        }

        $frequency = $entity->measurement_frequency_per_year;
        $data = $request->all();
        if (isset($data['measurement_frequency_per_year'])) {
            $frequency = $data['measurement_frequency_per_year'];
        }

        $goalsCount = (date("Y", strtotime($entity->indicatorable->project->date_end)) - date("Y",
                    strtotime($entity->indicatorable->project->date_init))) * $frequency;
        if ($frequency ==2) {
            $goalsCount += 1;
        }else if($frequency==4){
            $goalsCount+=3;
        }
        $this->indicatorProcess->update($request, $indicatorId, $goalsCount,
            date("Y", strtotime($entity->indicatorable->project->date_init)));

        $component = $this->componentRepository->find($entity->indicatorable->id);

        if (!$component) {
            throw new Exception(trans('indicators.messages.errors.update'), 1000);
        }

        return $component;
    }

    /**
     * Obtiene información para mostrar formulario de un indicador
     *
     * @param int $indicatorId
     *
     * @return array
     * @throws Exception
     */
    public function showIndicator(int $indicatorId)
    {
        $entity = $this->indicatorRepository->find($indicatorId);

        if (!$entity) {
            throw  new Exception(trans('indicators.messages.exceptions.not_found'), 1000);
        }

        if (!is_null($entity->measurement_frequency_per_year)) {
            $measuring_frequency = (date("Y", strtotime($entity->indicatorable->project->date_end)) - date("Y",
                        strtotime($entity->indicatorable->project->date_init))) * $entity->measurement_frequency_per_year;
        } else {
            $measuring_frequency = 0;
        }

        if (!is_null($entity->type)) {
            $type = PlanIndicator::types()[$entity->type];
        } else {
            $type = '';
        }

        if (!is_null($entity->goal_type)) {
            $goal_type = PlanIndicator::goalTypes()[$entity->goal_type];
        } else {
            $goal_type = '';
        }

        $measureUnitRepository = resolve(MeasureUnitRepository::class);

        return [
            'measuringUnit' => isset($entity->measureUnit) ? $entity->measureUnit->name : '',
            'type' => $type,
            'goal_type' => $goal_type,
            'measuring_frequency' => $measuring_frequency,
            'entity' => $entity,
            'route' => '',
            'yearPlanning' => date("Y", strtotime($entity->indicatorable->project->date_end)),
            'measuringUnits' => $measureUnitRepository->findEnabled(),
            'types' => PlanIndicator::types(),
            'goalTypes' => PlanIndicator::goalTypes(),
            'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
            'planId' => $entity->indicatorable->project->id,
            'planElementId' => $entity->indicatorable->id,
            'yearMeasurement' => date("Y"),
            'startYear' => date("Y", strtotime($entity->indicatorable->project->date_init)),
            'planType' => Plan::TYPE_PEI,
            'status' => $entity->indicatorable->project->status,
            'indicatorable' => PlanIndicator::INDICATORABLE_COMPONENT,
            'indicatorId' => $indicatorId
        ];
    }

    /**
     * Elimina un indicador de la base de datos
     *
     * @param int $id
     * @param Request $request
     *
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function destroyIndicator(int $id, Request $request)
    {
        $indicator = $this->indicatorRepository->find($id, ['*']);
        $idComponent = $indicator->indicatorable->id;
        $this->indicatorProcess->destroy($id, $request);
        $component = $this->componentRepository->find($idComponent, ['*']);

        return $component;
    }
}