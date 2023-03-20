<?php

namespace App\Processes\Business\Planning;

use App\Models\Business\Planning\Prioritization;
use App\Models\Business\Planning\PrioritizationTemplate;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\Project;
use App\Repositories\Repository\Business\Planning\BudgetAdjustmentRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\PrioritizationRepository;
use App\Repositories\Repository\Business\Planning\PrioritizationTemplateRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase PrioritizationProcess
 * @package App\Processes\Business\Planning
 */
class PrioritizationProcess
{
    /**
     * @var ProjectFiscalYearRepository
     */
    protected $projectFiscalYearRepository;

    /**
     * @var PrioritizationTemplateRepository
     */
    protected $prioritizationTemplateRepository;

    /**
     * @var FiscalYearRepository
     */
    protected $fiscalYearRepository;

    /**
     * @var PrioritizationRepository
     */
    protected $prioritizationRepository;

    /**
     * @var BudgetAdjustmentRepository
     */
    protected $budgetAdjustmentRepository;

    /**
     * Constructor de PrioritizationProcess.
     *
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param PrioritizationTemplateRepository $prioritizationTemplateRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param PrioritizationRepository $prioritizationRepository
     */
    public function __construct(
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        PrioritizationTemplateRepository $prioritizationTemplateRepository,
        FiscalYearRepository $fiscalYearRepository,
        PrioritizationRepository $prioritizationRepository,
        BudgetAdjustmentRepository $budgetAdjustmentRepository
    ) {
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->prioritizationTemplateRepository = $prioritizationTemplateRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->prioritizationRepository = $prioritizationRepository;
        $this->budgetAdjustmentRepository = $budgetAdjustmentRepository;
    }

    /**
     * Retornar data necesaria para mostrar el listado de proyectos.
     *
     * @return array
     * @throws Exception
     */
    public function index()
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        return [
            'fiscalYear' => $fiscalYear ? $fiscalYear->year : Carbon::now()->addYear()->year
        ];
    }

    /**
     * Cargar información de priorización de proyectos.
     *
     * @return mixed
     * @throws Exception
     */
    public function data()
    {
        $user = currentUser();
        $actions = [];

        if ($user->can('handle.prioritization.plans_management')) {
            $actions['list-ol'] = [
                'route' => 'handle.prioritization.plans_management',
                'tooltip' => trans('prioritization.labels.create'),
                'btn_class' => 'btn-success'
            ];
        }

        return DataTables::of($this->projectFiscalYearRepository->findProjectsToPrioritize($this->fiscalYearRepository->findNextFiscalYear()))
            ->setRowId('id')
            ->editColumn('full_cup', function (ProjectFiscalYear $entity) {
                return $entity->project->full_cup;
            })
            ->addColumn('name', function (ProjectFiscalYear $entity) {
                return $entity->project->name;
            })
            ->addColumn('responsibleUnit', function (ProjectFiscalYear $entity) {
                return $entity->project->responsibleUnit->name;
            })
            ->addColumn('date_init', function (ProjectFiscalYear $entity) {
                return $entity->project->date_init;
            })
            ->addColumn('date_end', function (ProjectFiscalYear $entity) {
                return $entity->project->date_end;
            })
            ->addColumn('referential_budget', function (ProjectFiscalYear $entity) {
                return number_format($entity->referential_budget, 2);
            })
            ->addColumn('month_duration', function (ProjectFiscalYear $entity) {
                return number_format($entity->project->month_duration, 2);
            })
            ->addColumn('priority', function (ProjectFiscalYear $entity) {
                return ($entity->prioritization) ? number_format($entity->prioritization->value, 2) : '';
            })
            ->editColumn('phase', function (ProjectFiscalYear $entity) {
                return Project::PROJECT_PHASES[$entity->project->phase];
            })
            ->addColumn('actions', function (ProjectFiscalYear $entity) use ($actions) {

                return view('layout.partial.actions_tooltip', [
                    'entity' => $entity,
                    'actions' => $actions
                ]);
            })
            ->rawColumns(['cup', 'name', 'responsibleUnit', 'date_init', 'date_end', 'referential_budget', 'month_duration', 'priority', 'actions'])
            ->make(true);
    }

    /**
     * Realizar validaciones para mostrar la vista de priorización a retornar.
     *
     * @param int $id
     *
     * @return mixed
     * @throws Exception
     */
    public function handle(int $id)
    {
        $projectFiscalYear = $this->projectFiscalYearRepository->find($id);

        if (!$projectFiscalYear) {
            throw new Exception(trans('prioritization.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        //TODO: validar si se realizó ajuste para retornar Prioritization::ACTION_SHOW (vista bloqueada)
        if ($projectFiscalYear->prioritization) {
            return Prioritization::ACTION_EDIT;
        } else {
            return Prioritization::ACTION_CREATE;
        }
    }

    /**
     * Retornar data necesaria para mostrar el formulario de creación de priorización de proyecto.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function create(int $id)
    {
        $projectFiscalYear = $this->projectFiscalYearRepository->find($id);

        if (!isset($projectFiscalYear->fiscalYear)) {
            throw new Exception(trans('prioritization.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $prioritizationTemplate = $projectFiscalYear->fiscalYear->prioritizationTemplate;

        if (!isset($prioritizationTemplate)) {
            throw new Exception(trans('prioritization.messages.exceptions.template_not_found', ['year' => $projectFiscalYear->fiscalYear->year]), 1000);
        }

        return [
            'projectFiscalYear' => $projectFiscalYear,
            'template' => $prioritizationTemplate,
            'project' => $projectFiscalYear->project,
            'rows' => true
        ];
    }

    /**
     * Almacenar nueva priorización de proyecto.
     *
     * @param Request $request
     *
     * @throws Exception
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $projectFiscalYear = $this->projectFiscalYearRepository->find($data['id']);

        if (!$projectFiscalYear) {
            throw new Exception(trans('prioritization.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        if (!$projectFiscalYear->fiscalYear) {
            throw  new Exception(trans('prioritization.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        if (!$projectFiscalYear->fiscalYear->prioritizationTemplate) {
            throw  new Exception(trans('prioritization.messages.exceptions.template_not_found'), 1000);
        }

        $data['project_fiscal_year_id'] = $data['id'];
        unset($data['id']);

        $data = self::normalizeData($data, $projectFiscalYear->fiscalYear->prioritizationTemplate);

        $this->prioritizationRepository->createFromArray($data);
    }

    /**
     * Retornar data necesaria para mostrar la información de priorización de proyecto.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function show(int $id)
    {
        return self::edit($id);
    }

    /**
     * Retornar data necesaria para mostrar el formulario de edición de priorización de proyecto.
     *
     * @param int $id
     *
     * @return array
     * @throws Exception
     */
    public function edit(int $id)
    {
        $projectFiscalYear = $this->projectFiscalYearRepository->find($id);

        if (!$projectFiscalYear) {
            throw  new Exception(trans('prioritization.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        $prioritization = $projectFiscalYear->prioritization;

        if (!$prioritization) {
            throw  new Exception(trans('prioritization.messages.exceptions.prioritization_not_found'), 1000);
        }

        if (!$projectFiscalYear->fiscalYear) {
            throw  new Exception(trans('prioritization.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $prioritizationTemplate = $projectFiscalYear->fiscalYear->prioritizationTemplate;

        if (!$prioritizationTemplate) {
            throw  new Exception(trans('prioritization.messages.exceptions.template_not_found'), 1000);
        }

        return [
            'prioritization' => $prioritization,
            'template' => $prioritizationTemplate,
            'project' => $projectFiscalYear->project,
            'rows' => true
        ];
    }

    /**
     * Actualizar la información de priorización de proyecto.
     *
     * @param Request $request
     * @param int $id
     *
     * @throws Exception
     */
    public function update(Request $request, int $id)
    {
        $data = $request->all();

        $prioritization = $this->prioritizationRepository->find($id);

        if (!$prioritization) {
            throw  new Exception(trans('prioritization.messages.exceptions.prioritization_not_found'), 1000);
        }

        if (!$prioritization->projectFiscalYear) {
            throw  new Exception(trans('prioritization.messages.exceptions.project_fiscal_year_not_found'), 1000);
        }

        if (!$prioritization->projectFiscalYear->fiscalYear) {
            throw  new Exception(trans('prioritization.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        if (!$prioritization->projectFiscalYear->fiscalYear->prioritizationTemplate) {
            throw  new Exception(trans('prioritization.messages.exceptions.template_not_found'), 1000);
        }

        $data = self::normalizeData($data, $prioritization->projectFiscalYear->fiscalYear->prioritizationTemplate);

        $entity = $this->prioritizationRepository->updateFromArray($data, $prioritization);

        if (!$entity) {
            throw new Exception(trans('prioritization.messages.errors.update'), 1000);
        }
    }

    /**
     * Eliminar una priorización de proyecto.
     *
     * @param int $id
     *
     * @throws Exception
     */
    public function destroy(int $id)
    {
        $prioritization = $this->prioritizationRepository->find($id);
        if (!$prioritization) {
            throw new Exception(trans('prioritization.messages.exceptions.prioritization_not_found'), 1000);
        }

        $verifyBudgetAdjustment = $this->budgetAdjustmentRepository->findBy('prioritization_id', $prioritization->id);
        if ($verifyBudgetAdjustment) {
            if (!$this->budgetAdjustmentRepository->destroy($verifyBudgetAdjustment->id)) {
                throw new Exception(trans('prioritization.messages.errors.delete'), 1000);
            }
        }

        if (!$this->prioritizationRepository->delete($prioritization)) {
            throw new Exception(trans('prioritization.messages.errors.delete'), 1000);
        }
    }

    /**
     * Normalizar la información previo al almacenamiento.
     *
     * @param array $data
     * @param PrioritizationTemplate $template
     *
     * @return array
     * @throws Exception
     */
    private function normalizeData(array $data, PrioritizationTemplate $template)
    {
        $scopes = collect($template->areas());
        $configuration = $data['configuration'];
        $prioritizationValue = 0;

        foreach ($configuration as $scopeKey => $criteria) {

            // Validate the scopes to the template used to prioritize the project
            $templateScope = $scopes->first(function ($value, $key) use ($scopeKey) {
                return $value->id == $scopeKey;
            });

            if ($templateScope) {

                $scopeWeight = $templateScope->weight;
                $templateCriteria = collect($templateScope->criteria);

                foreach ($criteria as $criterionKey => $value) {

                    // Validate the scopes to the template used to prioritize the project
                    $containsCriterion = $templateCriteria->contains(function ($value, $key) use ($criterionKey) {
                        return $value->id == $criterionKey;
                    });

                    if (!$containsCriterion) {
                        throw new Exception(trans('prioritization.messages.validation.invalid_criteria'), 1000);
                    }

                    // Calculate the project's prioritization value.
                    $prioritizationValue += ($scopeWeight * $value);
                }
            } else {
                throw new Exception(trans('prioritization.messages.validation.invalid_scopes'), 1000);
            }
        }

        $data['value'] = $prioritizationValue;
        $data['configuration'] = json_encode($configuration);

        return $data;
    }
}
