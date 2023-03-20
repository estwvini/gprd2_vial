<?php

namespace App\Processes\Business\Planning;

use App\Events\ProjectExecutingUnitChanged;
use App\Models\Business\Plan;
use App\Models\Business\PlanIndicator;
use App\Models\Business\Project;
use App\Models\System\Role;
use App\Repositories\Library\Exceptions\ModelException;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Business\Catalogs\MeasureUnitRepository;
use App\Repositories\Repository\Business\PlanElementRepository;
use App\Repositories\Repository\Business\PlanIndicatorRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\OperationalGoalsRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Throwable;

/**
 * Clase ProjectProcess
 * @package App\Processes\Business\Planning
 */
class ProjectProcess
{
    /**
     * @var projectRepository
     */
    private $projectRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var MeasureUnitRepository
     */
    private $measureUnitRepository;

    /**
     * @var PlanIndicatorProcess
     */
    private $indicatorProcess;

    /**
     * @var PlanIndicatorRepository
     */
    private $indicatorRepository;

    /**
     * @var OperationalGoalsRepository
     */
    private $operationalGoalsRepository;

    /**
     * @var PlanElementRepository
     */
    private $planElementRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * Constructor de ProjectProcess.
     *
     * @param ProjectRepository $projectRepository
     * @param SettingRepository $settingRepository
     * @param DepartmentRepository $departmentRepository
     * @param UserRepository $userRepository
     * @param MeasureUnitRepository $measureUnitRepository
     * @param PlanIndicatorProcess $indicatorProcess
     * @param PlanIndicatorRepository $indicatorRepository
     * @param OperationalGoalsRepository $operationalGoalsRepository
     * @param PlanElementRepository $planElementRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     */
    public function __construct(
        ProjectRepository $projectRepository,
        SettingRepository $settingRepository,
        DepartmentRepository $departmentRepository,
        UserRepository $userRepository,
        MeasureUnitRepository $measureUnitRepository,
        PlanIndicatorProcess $indicatorProcess,
        PlanIndicatorRepository $indicatorRepository,
        OperationalGoalsRepository $operationalGoalsRepository,
        PlanElementRepository $planElementRepository,
        FiscalYearRepository $fiscalYearRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository
    ) {
        $this->projectRepository = $projectRepository;
        $this->settingRepository = $settingRepository;
        $this->departmentRepository = $departmentRepository;
        $this->userRepository = $userRepository;
        $this->measureUnitRepository = $measureUnitRepository;
        $this->indicatorProcess = $indicatorProcess;
        $this->indicatorRepository = $indicatorRepository;
        $this->operationalGoalsRepository = $operationalGoalsRepository;
        $this->planElementRepository = $planElementRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
    }

    /**
     * Obtener modelo del proceso de proyectos.
     *
     * @return string
     */
    public function process()
    {
        return ProjectProcess::class;
    }

    /**
     * Almacena un proyecto en la base de datos
     *
     * @param Request $request
     *
     * @return Project
     * @throws ModelException
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $this->processRequest($request->all());
        $entity = $this->projectRepository->createFromArray($data);

        if (!$entity) {
            throw new Exception(trans('projects.messages.errors.create'), 1000);
        }

        if (isset($data['justifiableMultiple']) && $data['justifiableMultiple']) {
            $entity->justifications()->save(storeJustification($data, $entity, true));
        }

        return $entity;
    }

    /**
     * Actualiza un proyecto en la base de datos
     *
     * @param int $id
     * @param Request $request
     *
     * @return array
     * @throws ModelException
     * @throws Exception
     */
    public function update(int $id, Request $request)
    {
        $project = $this->projectRepository->find($id);

        if (!$project) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        $data = $this->processRequest($request->all(), $project);
        unset($data['cup']);

        $entity = $this->projectRepository->updateFromArray($data, $project);

        $justification = null;

        if (isset($data['justifiableMultiple']) && $data['justifiableMultiple']) {
            $justification = storeJustification($data, $entity, true);
        }

        if (!$entity) {
            throw new Exception(trans('projects.messages.errors.update'), 1000);
        }

        if (isset($data['justifiableMultiple']) && $data['justifiableMultiple'] && isset($justification)) {
            $entity->justifications()->save($justification);
        }

        $nextProjectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject(nextFiscalYear()->id, $entity->id);
        if (isset($request['executing_unit_id']) && key_exists('executing_unit_id', $project->getChanges()) && $nextProjectFiscalYear) {
            event(new ProjectExecutingUnitChanged($entity->executingUnit->code, $nextProjectFiscalYear->id));
        }

        return [
            'message' => [
                'type' => 'success',
                'text' => trans('projects.messages.success.updated')
            ]
        ];
    }

    /**
     * @param int $projectId
     * @param PlanIndicator $indicator
     *
     * @return Project
     */
    public function associateIndicator(int $projectId, PlanIndicator $indicator)
    {
        $entity = $this->projectRepository->find($projectId);

        $entity->indicators()->save($indicator);

        return $entity->fresh();
    }

    /**
     * Valida y normaliza los datos de la petición
     *
     * @param array $data Datos de la petición
     * @param Project|null $entity
     *
     * @return array Datos normalizados
     * @throws Exception
     */
    private function processRequest(array $data, Project $entity = null)
    {
        if (isset($data['date_init'])) {
            $init = DateTime::createFromFormat('d-m-Y', $data['date_init']);
            $data['date_init'] = $init->format('Y-m-d');
        } else {
            $init = DateTime::createFromFormat('d-m-Y', $entity->date_init);
            $data['date_init'] = $init->format('Y-m-d');
        }

        if (isset($data['date_end'])) {
            $end = DateTime::createFromFormat('d-m-Y', $data['date_end']);
            $data['date_end'] = $end->format('Y-m-d');
        } else {
            $end = DateTime::createFromFormat('d-m-Y', $entity->date_end);
            $data['date_end'] = $end->format('Y-m-d');
        }

        $data['annual_budgets'] = [];
        $referential_budget = 0;

        if (isset($data['date_init']) && isset($data['date_end']) && isset($data['edit_budget']) && $data['edit_budget']) {
            $init = new DateTime($data['date_init']);
            $end = new DateTime($data['date_end']);

            $diff = $init->diff($end);

            $data['month_duration'] = ($diff->format('%y') * 12) + ($diff->format('%m') * 1) + ($diff->format('%d') / 30);
            $data['execution_term'] = ((int)$end->format('Y') - (int)$init->format('Y')) > 0 ? Project::EXECUTION_TERM_PLURIANNUAL : Project::EXECUTION_TERM_ANNUAL;

            if ($entity) {
                $entity->fiscalYears->each(function ($item) use (&$data, &$referential_budget, $entity) {
                    if ($entity->isInProgress() && $item->year <= currentFiscalYear()->year) {
                        $referential_budget += $item->pivot->referential_budget;
                        $data['annual_budgets'][] = [
                            'year' => $item->year,
                            'budget' => $item->pivot->referential_budget
                        ];
                    }
                });
            }

            if (!empty($data['budgets'])) {
                $year = (int)$init->format('Y');

                foreach ($data['budgets'] as $index => $budget) {
                    $referential_budget += (float)str_replace(',', '', $budget);
                    if (count($data['annual_budgets'])) {
                        $max = collect($data['annual_budgets'])->max('year');
                        $data['annual_budgets'][] = [
                            'year' => $max + 1,
                            'budget' => number_format((float)str_replace(',', '', $budget), 2, '.', '')
                        ];
                    } else {
                        $data['annual_budgets'][] = [
                            'year' => $year + $index,
                            'budget' => number_format((float)str_replace(',', '', $budget), 2, '.', '')
                        ];
                    }

                }
            }

            $data['referential_budget'] = number_format((float)$referential_budget, 2, '.', '');
        }

        $data['is_road'] = isset($data['is_road']);

        if (isset($data['leader_id']) && $entity && currentUser()->roles[0]->slug !== Role::LEADER) {
            if ($entity->activeLeader() && $entity->activeLeader()->id == $data['leader_id']) {
                unset($data['leader_id']);
            } elseif ($entity->activeLeader() && $entity->activeLeader()->id != $data['leader_id']) {
                $data['ex_leader_id'] = $entity->activeLeader()->id;
            }
        } else {
            unset($data['leader_id']);
            unset($data['executing_unit_id']);
        }

        if (!$entity && isset($data['plan_element_id'])) {
            $subProgram = $this->planElementRepository->find($data['plan_element_id']);

            $data['full_cup'] = $subProgram->parent->code . '.' . $subProgram->code . '.' . $data['cup'];
        }

        return $data;
    }

    /**
     * Elimina lógicamente un proyecto de la base de datos
     *
     * @param int $id
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function destroy(int $id, Request $request)
    {
        $entity = $this->projectRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        $data = $request->all();
        $justification = null;

        if (isset($data['justifiableMultiple']) && $data['justifiableMultiple']) {
            $justification = storeJustification($data, $entity, true);
        }

        if (!$this->projectRepository->delete($entity)) {
            throw new Exception(trans('projects.messages.errors.delete'), 1000);
        }

        if (isset($data['justifiableMultiple']) && $data['justifiableMultiple'] && isset($justification)) {
            $entity->justifications()->save($justification);
        }

        $response = [
            'message' => [
                'type' => 'success',
                'text' => trans('projects.messages.success.deleted')
            ]
        ];

        return $response;
    }

    /**
     * Obtiene información para el formulario de perfil de proyecto
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function editProfile(int $id)
    {
        $entity = $this->projectRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        $executingUnits = $this->departmentRepository->childrenDepartments($entity->responsibleUnit->id, ['id', 'name']);

        if (!count($executingUnits)) {
            $executingUnits->push($entity->responsibleUnit);
        }

        $operationalGoals = $this->operationalGoalsRepository->findByField('plan_element_id', $entity->subprogram->parent->parent->id);

        $users = [];
        if ($entity->executingUnit) {
            $users = $this->usersByExecutingUnit($entity->executingUnit->id);
        }

        $leader = $entity->activeLeader();

        $fiscal_year = $this->fiscalYearRepository->findNextFiscalYear();
        $projectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($fiscal_year->id, $id);

        return [$entity, $executingUnits, $users, $leader, $operationalGoals, $projectFiscalYear];
    }

    /**
     * Obtiene información para el formulario de marco logico del proyecto
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function editLogicFrame(int $id)
    {
        $entity = $this->projectRepository->find($id);

        if (!$entity) {
            throw new Exception(trans('projects.messages.exceptions.not_found'), 1000);
        }

        $fiscal_year = $this->fiscalYearRepository->findNextFiscalYear();
        $projectFiscalYear = $this->projectFiscalYearRepository->findByYearAndProject($fiscal_year->id, $id);

        return [$entity, $projectFiscalYear];
    }

    /**
     * Obtiene los usuarios de una unidad ejecutora
     *
     * @param int $id
     *
     * @return
     */
    public function usersByExecutingUnit(int $id)
    {
        return $this->userRepository->findLeadersByDepartment($id, ['users.id', 'users.first_name', 'users.last_name']);
    }

    /**
     * Mostrar el formulario completo de creación de un indicador.
     *
     * @param int $projectId
     *
     * @return mixed
     * @throws Throwable
     */
    public function createFullIndicator(int $projectId)
    {
        $entity = $this->projectRepository->find($projectId);

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
    public function storeFullIndicator(Request $request)
    {
        $data = $request->all();
        $frequency = 1;

        $project = $this->projectRepository->find($data['projectId']);

        if (isset($data['measurement_frequency_per_year'])) {
            $frequency = $data['measurement_frequency_per_year'];
        }

        $goalsCount = (date("Y", strtotime($project->date_end)) - date("Y", strtotime($project->date_init))) * $frequency;
        if ($frequency  ==2 ) {
            $goalsCount += 1;
        }else if($frequency==4){
            $goalsCount+=3;
        }
        $indicator = $this->indicatorProcess->storeFullIndicator($request, $project, $goalsCount, date("Y", strtotime($project->date_init)));

        if (!$indicator) {
            throw new Exception(trans('plan_elements.messages.errors.create'), 1000);
        }

        $project = $this->projectRepository->find($data['projectId']);

        if (!$project) {
            throw new Exception(trans('plan_elements.messages.errors.create'), 1000);
        }

        return $project;
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
    public function updateFullIndicator(int $indicatorId, Request $request)
    {
        $entity = $this->indicatorRepository->find($indicatorId);

        if (!$entity) {
            throw new Exception(trans('plan_elements.messages.errors.not_found'), 1000);
        }

        $frequency = $entity->measurement_frequency_per_year;
        $data = $request->all();
        if (isset($data['measurement_frequency_per_year'])) {
            $frequency = $data['measurement_frequency_per_year'];
        }

        $goalsCount = (date("Y", strtotime($entity->indicatorable->date_end)) - date("Y", strtotime($entity->indicatorable->date_init))) * $frequency;
        if ($frequency  ==2 ) {
            $goalsCount += 1;
        }else if($frequency==4){
            $goalsCount+=3;
        }
        $this->indicatorProcess->update($request, $indicatorId, $goalsCount, date("Y", strtotime($entity->indicatorable->date_init)));

        $project = $this->projectRepository->find($entity->indicatorable->id);

        if (!$project) {
            throw new Exception(trans('projects.messages.errors.update'), 1000);
        }

        return $project;
    }

    /**
     * Obtiene información para mostrar formulario de un componente
     *
     * @param int $indicatorId
     *
     * @return array
     * @throws Exception
     * @throws Throwable
     */
    public function showIndicator(int $indicatorId)
    {
        $entity = $this->indicatorRepository->find($indicatorId);

        if (!$entity) {
            throw  new Exception(trans('indicators.messages.exceptions.not_found'), 1000);
        }

        $route = '';

        if (!is_null($entity->measurement_frequency_per_year)) {
            $measuring_frequency = (date("Y", strtotime($entity->indicatorable->date_end)) - date("Y",
                        strtotime($entity->indicatorable->date_init))) * $entity->measurement_frequency_per_year;
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

        return [
            'measuringUnit' => isset($entity->measureUnit) ? $entity->measureUnit->name : '',
            'type' => $type,
            'goal_type' => $goal_type,
            'measuring_frequency' => $measuring_frequency,
            'entity' => $entity,
            'route' => $route,
            'yearPlanning' => date("Y", strtotime($entity->indicatorable->date_end)),
            'measuringUnits' => $this->measureUnitRepository->findEnabled(),
            'types' => PlanIndicator::types(),
            'goalTypes' => PlanIndicator::goalTypes(),
            'measuringFrequencies' => PlanIndicator::measuringFrequencies(),
            'planId' => $entity->indicatorable->id,
            'planElementId' => $entity->indicatorable->id,
            'yearMeasurement' => date("Y"),
            'startYear' => date("Y", strtotime($entity->indicatorable->date_init)),
            'planType' => Plan::TYPE_PEI,
            'status' => $entity->indicatorable->status,
            'indicatorable' => PlanIndicator::INDICATORABLE_PROJECT,
            'indicatorId' => $indicatorId
        ];
    }

    /**
     * Mostrar formulario de edición de un indicador completo
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function editFullIndicator(int $id)
    {
        $entity = $this->indicatorRepository->find($id);

        if (!$entity) {
            throw  new Exception(trans('plan_elements.messages.exceptions.not_found'), 1000);
        }

        return $entity;
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
        $idProject = $indicator->indicatorable->id;
        $this->indicatorProcess->destroy($id, $request);
        $project = $this->projectRepository->find($idProject, ['*']);

        return $project;
    }

}