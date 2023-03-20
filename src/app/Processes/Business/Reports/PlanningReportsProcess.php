<?php

namespace App\Processes\Business\Reports;

use App\Models\Business\BudgetItem;
use App\Models\Business\Plan;
use App\Models\Business\PlanElement;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\BudgetAdjustment;
use App\Models\Business\Planning\FiscalYear;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\Project;
use App\Models\Business\PublicPurchase;
use App\Models\Business\Task;
use App\Models\Business\Tracking\Proforma;
use App\Processes\Business\Planning\BudgetAdjutmentProcess;
use App\Repositories\Repository\Admin\DepartmentRepository;
use App\Repositories\Repository\Admin\UserRepository;
use App\Repositories\Repository\Business\BudgetItemRepository;
use App\Repositories\Repository\Business\Catalogs\FinancingSourceRepository;
use App\Repositories\Repository\Business\Planning\BudgetAdjustmentRepository;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\IncomeRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\PlanRepository;
use App\Repositories\Repository\Business\ProjectRepository;
use App\Repositories\Repository\Business\Reports\PlanningReportsRepository;
use App\Repositories\Repository\Business\Reports\TrackingReportsRepository;
use App\Repositories\Repository\Business\Tracking\LocalProformaRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase PlanningReportsProcess
 *
 * @package App\Processes\Business\Reports
 */
class PlanningReportsProcess
{
    /**
     * @var PlanningReportsRepository
     */
    private $planningReportsRepository;

    /**
     * @var PlanRepository
     */
    private $planRepository;

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    /**
     * @var SettingRepository
     */
    private $settingRepository;

    /**
     * @var ProjectFiscalYearRepository
     */
    private $projectFiscalYearRepository;

    /**
     * @var LocalProformaRepository
     */
    private $localProformaRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var DepartmentRepository
     */
    private $departmentRepository;

    /**
     * @var ProjectRepository
     */
    private $projectRepository;

    /**
     * @var TrackingReportsRepository
     */
    private $trackingReportsRepository;

    /**
     * @var IncomeRepository
     */
    private $incomeRepository;

    /**
     * @var BudgetAdjustmentRepository
     */
    private $budgetAdjustmentRepository;

    /**
     * @var BudgetItemRepository
     */
    private $budgetItemRepository;

    /**
     * @var FinancingSourceRepository
     */
    private $financingSourceRepository;

    /**
     * Constructor de PlanningReportsProcess.
     *
     * @param PlanningReportsRepository $planningReportsRepository
     * @param PlanRepository $planRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param SettingRepository $settingRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param LocalProformaRepository $localProformaRepository
     * @param TrackingReportsRepository $trackingReportsRepository
     * @param UserRepository $userRepository
     * @param DepartmentRepository $departmentRepository
     * @param IncomeRepository $incomeRepository
     * @param BudgetAdjustmentRepository $budgetAdjustmentRepository
     * @param ProjectRepository $projectRepository
     * @param BudgetItemRepository $budgetItemRepository
     * @param FinancingSourceRepository $financingSourceRepository
     */
    public function __construct(
        PlanningReportsRepository $planningReportsRepository,
        PlanRepository $planRepository,
        FiscalYearRepository $fiscalYearRepository,
        SettingRepository $settingRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        LocalProformaRepository $localProformaRepository,
        UserRepository $userRepository,
        TrackingReportsRepository $trackingReportsRepository,
        DepartmentRepository $departmentRepository,
        ProjectRepository $projectRepository,
        IncomeRepository $incomeRepository,
        BudgetAdjustmentRepository $budgetAdjustmentRepository,
        BudgetItemRepository $budgetItemRepository,
        FinancingSourceRepository $financingSourceRepository
    ) {
        $this->planningReportsRepository = $planningReportsRepository;
        $this->planRepository = $planRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->settingRepository = $settingRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->localProformaRepository = $localProformaRepository;
        $this->userRepository = $userRepository;
        $this->trackingReportsRepository = $trackingReportsRepository;
        $this->departmentRepository = $departmentRepository;
        $this->incomeRepository = $incomeRepository;
        $this->budgetAdjustmentRepository = $budgetAdjustmentRepository;
        $this->budgetItemRepository = $budgetItemRepository;
        $this->financingSourceRepository = $financingSourceRepository;
        $this->projectRepository = $projectRepository;
        $this->incomeRepository = $incomeRepository;
        $this->budgetAdjustmentRepository = $budgetAdjustmentRepository;

    }

    /**
     * Obtiene información necesaria para los filtros del reporte ppi
     *
     * @return array
     * @throws Exception
     */
    public function ppiReport()
    {
        $years = $this->fiscalYearRepository->all();

        if (!$years->count()) {
            throw  new Exception(trans('reports.exceptions.no_info'), 1000);
        }

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $currentYear = $currentFiscalYear ? $currentFiscalYear->year : Carbon::now()->year;
        $executingUnits = $this->departmentRepository->findAll();
        $gadInfo = $this->settingRepository->findByKey('gad')->value;
        $gad = trans('reports.labels.gad') . ' ' . $gadInfo['province'];

        return compact('years', 'currentYear', 'executingUnits', 'gad');
    }

    /**
     * Cargar información del reporte PPI.
     *
     * @param Request $request
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function ppiData(Request $request)
    {
        $data = $request->all();

        $reportData = $this->planningReportsRepository->ppiReport($data);
        $totalBudget = $reportData->sum('referential_budget') ?? 0;

        $dataTable = DataTables::of($reportData
            ->sortBy('project.name')
        )
            ->setRowId('objective_id')
            ->addColumn('objective_id', function (ProjectFiscalYear $projectFiscalYear) {
                return $projectFiscalYear->project->subprogram->parent->parent->id;
            })
            ->addColumn('objective_description', function (ProjectFiscalYear $projectFiscalYear) {
                return $projectFiscalYear->project->subprogram->parent->parent->description;
            })
            ->addColumn('program_cup', function (ProjectFiscalYear $projectFiscalYear) {
                return $projectFiscalYear->project->subprogram->parent->code;
            })
            ->addColumn('program_name', function (ProjectFiscalYear $projectFiscalYear) {
                return $projectFiscalYear->project->subprogram->parent->description;
            })
            ->addColumn('project_cup', function (ProjectFiscalYear $projectFiscalYear) {
                return $projectFiscalYear->project->cup;
            })
            ->addColumn('project_name', function (ProjectFiscalYear $projectFiscalYear) {
                return $projectFiscalYear->project->name;
            })
            ->addColumn('executing_unit', function (ProjectFiscalYear $projectFiscalYear) {
                return $projectFiscalYear->project->executingUnit->name;
            })
            ->editColumn('referential_budget', function (ProjectFiscalYear $projectFiscalYear) {
                return number_format($projectFiscalYear->referential_budget, 2);
            })
            ->addColumn('articulation', function (ProjectFiscalYear $projectFiscalYear) {
                $thrusts = collect([]);
                $prefix = '- ';

                ($projectFiscalYear->project->subprogram->parent->parent->indicators)->map(function ($item, $key) use (&$thrusts) {
                    $thrusts = ($item->parentLinks)->map(function ($item, $key) {
                        return $item->indicatorable->parent;
                    })->unique()->values();
                });

                return ($thrusts->count()) ? $prefix . $thrusts->implode('description', '<br/><br/>' . $prefix) : '';
            })
            ->addColumn('zone', function (ProjectFiscalYear $projectFiscalYear) {
                return $projectFiscalYear->project->zone;
            })
            ->rawColumns(['objective', 'program_cup', 'program_name', 'project_cup', 'project_name', 'executing_unit', 'budget', 'articulation', 'zone'])
            ->with('totalBudget', number_format($totalBudget, 2))
            ->make(true);

        return $dataTable;
    }

    /**
     * Mostrar vista de listado de reporte PND y PDOT.
     *
     * @return mixed
     *
     * @throws Throwable
     */
    public function makeMatrixPNDandPDOT()
    {

        $entity = $this->planRepository->getPlans(Plan::TYPE_PDOT);

        if (!$entity) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        if (empty($entity->all())) {
            throw  new Exception(trans('reports.exceptions.not_links'), 1000);
        }
        return $this->showPlanLinks($entity->all(), [Plan::TYPE_PND], trans('reports.labels.reportPDOTandPND'));
    }

    /**
     * Mostrar vista de listado de reporte PND y PS
     *
     * @return mixed
     *
     * @throws Throwable
     */
    public function makeMatrixPNDandPS()
    {

        $entity = $this->planRepository->getPlans(Plan::TYPE_SECTORAL, trans('plans.messages.exceptions.not_found'));

        if (!$entity) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        if (empty($entity->all())) {
            throw  new Exception(trans('reports.exceptions.not_links'), 1000);
        }
        return $this->showPlanLinks($entity->all(), [Plan::TYPE_PND], trans('reports.labels.reportPNDandPSs'));
    }

    /**
     * Mostrar vista de listado de reporte PEI y PDOT
     *
     * @return mixed
     * @throws Throwable
     */
    public function makeMatrixPEIandPDOT()
    {

        $entity = $this->planRepository->getPlans(Plan::TYPE_PEI);

        if (!$entity) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        if (empty($entity->all())) {
            throw  new Exception(trans('reports.exceptions.not_links'), 1000);
        }
        return $this->showPlanLinks($entity->all(), [Plan::TYPE_PDOT], trans('reports.labels.reportPEIandPDOT'));
    }

    /**
     * Mostrar vista de listado de reporte PEI vinculado a estructura programática.
     *
     * @throws Exception
     */
    public function peiStructureIndex()
    {
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('app.messages.exceptions.no_current_fiscal_year_info'), 1000);
        }

        $fiscalYears = $this->fiscalYearRepository->all();

        $data = $this->createPEIStructureMatrix($currentFiscalYear->id);

        $data['fiscalYears'] = $fiscalYears;

        return $data;
    }

    /**
     * Genera estructura de la matriz de PEI con estructura programática.
     *
     * @param int $fiscalYearId
     *
     * @return mixed
     * @throws Exception
     */
    public function createPEIStructureMatrix(int $fiscalYearId)
    {
        $plans = $this->planRepository->getPlans(Plan::TYPE_PEI);

        if (!$plans) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        if (empty($plans->all())) {
            throw  new Exception(trans('reports.exceptions.not_links'), 1000);
        }

        $plan = $plans->first();

        $planStructure = $this->planRepository->getProgrammaticStructure($plan, $fiscalYearId);
        $objectives = $planStructure->planElements->toArray();

        if (!empty($objectives)) {
            foreach ($objectives as &$objective) {
                $objective['rowspan'] = 0;
                if (!empty($objective['children'])) {
                    foreach ($objective['children'] as &$program) {
                        $objective['rowspan']++;
                        $program['rowspan'] = 0;
                        if (!empty($program['children'])) {
                            foreach ($program['children'] as $subKey => &$subprogram) {
                                if ($subKey > 0) {
                                    $objective['rowspan']++;
                                }
                                $program['rowspan']++;
                                $subprogram['rowspan'] = 0;
                                if (!empty($subprogram['projects'])) {
                                    foreach ($subprogram['projects'] as $proKey => &$project) {
                                        if (!empty($project['get_project_fiscal_years'])) {
                                            if ($proKey > 0) {
                                                $program['rowspan']++;
                                                $objective['rowspan']++;
                                            }
                                            $subprogram['rowspan']++;
                                            $project['rowspan'] = 0;
                                            foreach ($project['get_project_fiscal_years'][0]['activities_project_fiscal_year'] as $actKey => $activityProjectFiscalYear) {
                                                if ($actKey > 0) {
                                                    $subprogram['rowspan']++;
                                                    $program['rowspan']++;
                                                    $objective['rowspan']++;
                                                }
                                                $project['rowspan']++;
                                            }
                                        } else {
                                            unset($subprogram['projects'][$proKey]);
                                            $subprogram['projects'] = array_values($subprogram['projects']);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $rows = $this->createPEIStructureRows($objectives);

        return [
            'rows' => $rows
        ];
    }

    /**
     * Crea la estructura de la tabla que se mostrará del PEI vinculado a la estructura programática.
     *
     * @param array $objectives
     *
     * @return Collection
     */
    public function createPEIStructureRows(array $objectives)
    {
        $rows = collect([]);

        foreach ($objectives as $objective) {
            $row = collect([]);
            $row->push([
                'text' => '<b>' . trans('plan_elements.labels.OBJECTIVE') . ' ' . $objective['code'] . ': </b>' . $objective['description'],
                'rowspan' => $objective['rowspan'] === 0 ? 1 : $objective['rowspan']
            ]);
            if (!empty($objective['children'])) {
                foreach ($objective['children'] as $program) {
                    $row->push([
                        'text' => '<b>' . trans('plan_elements.labels.PROGRAM') . ' ' . $program['code'] . ': </b>' . $program['description'],
                        'rowspan' => $program['rowspan'] === 0 ? 1 : $program['rowspan']
                    ]);
                    if (!empty($program['children'])) {
                        foreach ($program['children'] as $subprogram) {
                            $row->push([
                                'text' => '<b>' . trans('plan_elements.labels.SUBPROGRAM') . ' ' . $subprogram['code'] . ': </b>' . $subprogram['description'],
                                'rowspan' => $subprogram['rowspan'] === 0 ? 1 : $subprogram['rowspan']
                            ]);
                            if (!empty($subprogram['projects'])) {
                                foreach ($subprogram['projects'] as $project) {
                                    if (!empty($project['get_project_fiscal_years'])) {
                                        $row->push([
                                            'text' => '<b>' . trans('plan_elements.labels.PROJECT') . ' ' . $project['cup'] . ': </b>' . $project['description'],
                                            'rowspan' => $project['rowspan'] === 0 ? 1 : $project['rowspan']
                                        ]);
                                        if (empty($project['get_project_fiscal_years'][0]['activities_project_fiscal_year'])) {
                                            $row->push(['text' => '', 'rowspan' => 1]);
                                            $rows->push($row);
                                            $row = collect([]);
                                        } else {
                                            foreach ($project['get_project_fiscal_years'][0]['activities_project_fiscal_year'] as $activity) {
                                                $row->push([
                                                    'text' => '<b>' . trans('activities.labels.activity') . ' ' . $activity['code'] . ': </b>' . $activity['name'],
                                                    'rowspan' => 1
                                                ]);
                                                $rows->push($row);
                                                $row = collect([]);
                                            }
                                        }
                                    }
                                }
                            } else {
                                $row->push(['text' => '', 'rowspan' => 1]);
                                $row->push(['text' => '', 'rowspan' => 1]);
                                $rows->push($row);
                                $row = collect([]);
                            }
                        }
                    }
                }
            }
        }

        return $rows;
    }

    /**
     * Mostrar vista de listado de reporte de matriz planes sectoriales.
     *
     * @throws Exception
     */
    public function sectorialPlansIndex()
    {
        $plans = $this->planRepository->getPlans(Plan::TYPE_SECTORAL);

        if (!$plans) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        if (empty($plans->all())) {
            throw  new Exception(trans('reports.exceptions.not_links'), 1000);
        }

        $plansRows = collect([]);

        foreach ($plans as $plan) {
            $planStructure = $this->planRepository->getSectorialPlan($plan);
            $objectives = $planStructure->planElements;
            $objectives->name = $plan->name;
            $objectives->rowspan = 0;
            if ($objectives->isNotEmpty()) {
                $objectives->each(function ($objective) use ($objectives) {
                    $objectives->rowspan++;
                    $objective->rowspan = 0;
                    if ($objective->children->isNotEmpty()) {
                        $objective->children->each(function ($child, $key) use ($objectives, $objective) {
                            if ($key > 0) {
                                $objectives->rowspan++;
                            }
                            $objective->rowspan++;
                            $child->rowspan = 0;
                            if ($child->children->isNotEmpty()) {
                                $child->children->each(function ($subprogram, $key) use ($child, $objective, $objectives) {
                                    if ($key > 0) {
                                        $objective->rowspan++;
                                        $objectives->rowspan++;
                                    }
                                    $child->rowspan++;
                                    $subprogram->rowspan = 1;
                                });
                            }
                        });
                    }
                });
            }

            $plansRows->push($objectives);
        }

        $rows = $this->createSectorialMatrix($plansRows);

        return [
            'rows' => $rows
        ];
    }

    /**
     * Crea la estructura de la tabla que se mostrará del PEI vinculado a la estructura programática.
     *
     * @param Collection $plans
     *
     * @return Collection
     */
    public function createSectorialMatrix(Collection $plans)
    {
        $rows = collect([]);

        $plans->each(function ($plan) use ($rows) {
            $row = collect([]);
            $row->push([
                'text' => $plan->name,
                'rowspan' => $plan->rowspan === 0 ? 1 : $plan->rowspan
            ]);
            $plan->each(function ($objective) use (&$row, $rows) {
                $row->push([
                    'text' => '<b>' . trans('plan_elements.labels.OBJECTIVE') . ' ' . $objective->code . ': </b>' . $objective->description,
                    'rowspan' => $objective->rowspan === 0 ? 1 : $objective->rowspan
                ]);
                if ($objective->children->isNotEmpty()) {
                    $objective->children->each(function ($program) use (&$row, $rows) {
                        $row->push([
                            'text' => '<b>' . trans('plan_elements.labels.PROGRAM') . ' ' . $program->code . ': </b>' . $program->description,
                            'rowspan' => $program->rowspan === 0 ? 1 : $program->rowspan
                        ]);
                        if ($program->children->isNotEmpty()) {
                            $program->children->each(function ($subprogram) use (&$row, $rows) {
                                $row->push([
                                    'text' => '<b>' . trans('plan_elements.labels.SUBPROGRAM') . ' ' . $subprogram->code . ': </b>' . $subprogram->description,
                                    'rowspan' => $subprogram->rowspan === 0 ? 1 : $subprogram->rowspan
                                ]);
                                $rows->push($row);
                                $row = collect([]);
                            });
                        } else {
                            $row->push(['text' => '', 'rowspan' => 1]);
                            $rows->push($row);
                            $row = collect([]);
                        }
                    });
                } else {
                    $row->push(['text' => '', 'rowspan' => 1]);
                    $row->push(['text' => '', 'rowspan' => 1]);
                    $rows->push($row);
                    $row = collect([]);
                }
            });
        });

        return $rows;
    }

    /**
     * Genera estructura de articulaciones de un plan mediante consultas eager loading
     *
     * @param array $plans
     * @param array $linkTypes
     * @param string $pdfTitle
     *
     * @return mixed
     * @throws Throwable
     */
    public function showPlanLinks(array $plans, array $linkTypes, string $pdfTitle)
    {
        $auxTabs = collect([]);

        // Reading possible plan links
        foreach ($plans as $plan) {
            foreach ($linkTypes as $linkType) {

                $linkedPlans = $this->planRepository->findByField('type', $linkType);

                $linksInfoCollection = collect();
                $linkedPlans->each(function ($linkedPlan) use (&$linksInfoCollection, $plan) {
                    // Get full plan links structure using eager loading
                    $linksInfoCollection->push($this->planRepository->getPlanStructureLinks($plan, $linkedPlan));
                });

                $linksInfoCollection->each(function ($linksInfo) use (&$auxTabs) {

                    $objectives = collect([]);
                    $hasThrusts = false;

                    if ($linksInfo['planLinks']->planElements->count() && $linksInfo['planLinks']->planElements->first()->type == PlanElement::TYPE_THRUST) {
                        $hasThrusts = true;
                        $linksInfo['planLinks']->planElements->each(function ($thrust) use (&$objectives) {
                            $objectives = $objectives->merge($thrust->children);
                        });
                    } else {
                        $objectives = $linksInfo['planLinks']->planElements;
                    }

                    // Reading each element to count its children and calculate the rowspans of the final table
                    $objectives->each(function ($objective) use ($hasThrusts, $linksInfo) {
                        $objective->rowspan = 0;
                        $objective->indicators->each(function ($indicator) use (&$objective) {
                            $indicator->rowspan = $indicator->parentLinks->count() ?: 1;
                            $objective->rowspan += $indicator->parentLinks->count() ?: 1;
                        });

                        if ($hasThrusts) {
                            $thrust = $linksInfo['planLinks']->planElements->where('id', $objective->parent_id)->first();
                            if ($thrust->rowspan) {
                                $thrust->rowspan += $objective->rowspan ?: 1;
                            } else {
                                $thrust->rowspan = $objective->rowspan ?: 1;
                            }
                        }

                    });

                    // Final summary of plan elements rowspans
                    $linksInfo['planLinks']->planElements->each(function ($planElement) use ($linksInfo) {
                        if ($linksInfo['planLinks']->rowspan) {
                            $linksInfo['planLinks']->rowspan += $planElement->rowspan ?: 1;
                        } else {
                            $linksInfo['planLinks']->rowspan = $planElement->rowspan ?: 1;
                        }
                    });

                    // Adding the modified structure to a new collection
                    $auxTabs->push($linksInfo);

                });

            }
        }

        $tabs = collect([]);

        // Reading each tab to build the table elements row by row
        $auxTabs->each(function ($auxTab) use (&$tabs) {

            $rows = collect([]);

            // Create an array of each elements with two attributes: text and rowspan that will be used to build the links table

            $info[] = ['text' => '<b>' . trans('plans.labels.vision') . ':</b> ' . $auxTab['planLinks']->vision, 'rowspan' => $auxTab['planLinks']->rowspan, 'planLink' => 1];
            $mainRowspan = $auxTab['planLinks']->rowspan;

            $lastObjective = null;
            $lastThrust = null;
            $linkedPlanVision = false;

            // Reading each plan element (thrust or objective)
            $auxTab['planLinks']->planElements->each(function ($planElement) use (
                &$info,
                &$rows,
                &$lastObjective,
                &$lastThrust,
                &$linkedPlanVision,
                $mainRowspan
            ) {

                $info[] = [
                    'text' => '<b>' . trans('plan_elements.labels.' . $planElement->type) . ':</b> ' . $planElement->code . ' - ' . $planElement->description,
                    'rowspan' => $planElement->rowspan,
                    'planLink' => 1
                ];

                if ($planElement->type === PlanElement::TYPE_THRUST) {
                    $planElement->children->each(function ($objective) use (&$info, &$rows, &$lastObjective, &$lastThrust, &$linkedPlanVision, $mainRowspan) {
                        $info[] = [
                            'text' => '<b>' . trans('plan_elements.labels.' . PlanElement::TYPE_OBJECTIVE) . ':</b> ' . $objective->code . ' - ' . $objective->description,
                            'rowspan' => $objective->rowspan,
                            'planLink' => 1
                        ];

                        // Process each objective with the same logic
                        self::processObjective(
                            $objective,
                            $info,
                            $rows,
                            $lastObjective,
                            $lastThrust,
                            $linkedPlanVision,
                            $mainRowspan
                        );
                    });
                } else {
                    self::processObjective(
                        $planElement,
                        $info,
                        $rows,
                        $lastObjective,
                        $lastThrust,
                        $linkedPlanVision,
                        $mainRowspan
                    );
                }

            });

            // Adding elements to a final collection
            $tabs->push(['rows' => $rows, 'linkedPlan' => $auxTab['linkedPlan']]);

        });

        $gad = $this->settingRepository->findByKey('gad')->value;

        return [
            'tabs' => $tabs,
            'plans' => $plans,
            'pdfTitle' => $pdfTitle,
            'gad' => trans('reports.labels.gad') . ' ' . $gad['province']
        ];
    }

    /**
     * Procesa los objetivos de un plan para generar un arreglo con las filas que tendrá la tabla de articulaciones
     *
     * @param PlanElement $objective
     * @param array $info
     * @param Collection $rows
     * @param PlanElement|null $lastObjective
     * @param PlanElement|null $lastThrust
     * @param bool $linkedPlanVision
     * @param int $mainRowspan
     */
    private function processObjective(
        PlanElement $objective,
        array &$info,
        Collection &$rows,
        PlanElement &$lastObjective = null,
        PlanElement &$lastThrust = null,
        bool &$linkedPlanVision,
        int $mainRowspan
    ) {
        // Reading each objective indicator
        $objective->indicators->each(function ($indicator) use (
            &$info,
            &$rows,
            &$lastObjective,
            &$lastThrust,
            &$linkedPlanVision,
            $mainRowspan
        ) {
            $info[] = [
                'text' => '<b>' . trans('plan_elements.labels.' . PlanElement::TYPE_GOAL) . ':</b> ' . $indicator->goal_description,
                'rowspan' => $indicator->rowspan,
                'planLink' => 1
            ];

            // Reading each indicator link
            $indicator->parentLinks->each(function ($linkedIndicator) use (
                &$info,
                &$rows,
                &$lastObjective,
                &$lastThrust,
                &$linkedPlanVision,
                $mainRowspan
            ) {

                $info[] = [
                    'text' => '<b>' . trans('plan_elements.labels.' . PlanElement::TYPE_GOAL) . ':</b> ' . $linkedIndicator->goal_description,
                    'rowspan' => $linkedIndicator->rowspan,
                    'planLink' => 0
                ];

                // Checks if the objective changed
                if ($linkedIndicator->indicatorable != $lastObjective) {

                    if ($lastObjective) {
                        $row = $rows[$lastObjective->rowIndex];

                        if (isset($row['objective'])) {

                            $row['objective']['rowspan'] = $lastObjective->rowspan;

                            $rows->put($lastObjective->rowIndex, $row);
                        }
                    }

                    $lastObjective = $linkedIndicator->indicatorable;
                    $lastObjective->rowspan = 1;
                    $lastObjective->rowIndex = $rows->count();

                    $info['objective'] = [
                        'text' => '<b>' . trans('plan_elements.labels.' . PlanElement::TYPE_OBJECTIVE) . ':</b> ' . $lastObjective->code . ' - ' . $lastObjective->description,
                        'rowspan' => $lastObjective->rowspan,
                        'planLink' => 0
                    ];

                    // Building the linked plan section
                    if ($lastObjective->parent) {
                        // Checks if the thrust changed
                        if ($lastObjective->parent != $lastThrust) {

                            // Calculate the rowspan based on its children
                            if ($lastThrust) {
                                $row = $rows[$lastThrust->rowIndex];

                                if (isset($row['thrust'])) {

                                    $row['thrust']['rowspan'] = $lastThrust->rowspan;

                                    $rows->put($lastThrust->rowIndex, $row);
                                }
                            }

                            $lastThrust = $lastObjective->parent;
                            $lastThrust->rowspan = 1;
                            $lastThrust->rowIndex = $rows->count();

                            $info['thrust'] = [
                                'text' => '<b>' . trans('plan_elements.labels.' . PlanElement::TYPE_THRUST) . ':</b> ' . $lastThrust->code . ' - ' . $lastThrust->description,
                                'rowspan' => $lastThrust->rowspan,
                                'planLink' => 0
                            ];

                            // Adds the linked plan vision at the end of the table
                            if (!$linkedPlanVision) {
                                $info[] = [
                                    'text' => '<b>' . trans('plans.labels.vision') . ':</b> ' . $lastObjective->plan->vision,
                                    'rowspan' => $mainRowspan,
                                    'planLink' => 0
                                ];
                                $linkedPlanVision = true;
                            }

                        } else {
                            // Increments the rowspan on each iteration where the child does not change
                            $lastThrust->rowspan++;
                        }
                    } else {
                        // Adds the linked plan vision at the end of the table
                        if (!$linkedPlanVision) {
                            $info[] = [
                                'text' => '<b>' . trans('plans.labels.vision') . ':</b> ' . $lastObjective->plan->vision,
                                'rowspan' => $mainRowspan,
                                'planLink' => 0
                            ];
                            $linkedPlanVision = true;
                        }
                    }

                } else {
                    // Increments the rowspan on each iteration where the child does not change
                    $lastObjective->rowspan++;

                    if ($lastObjective->parent && $lastObjective->parent == $lastThrust) {
                        $lastThrust->rowspan++;
                    }
                }

                $rows->push($info);

                $info = [];
            });

            // Updating rowspan of the very last elements
            if ($lastObjective) {
                $row = $rows[$lastObjective->rowIndex];

                if (isset($row['objective'])) {

                    $row['objective']['rowspan'] = $lastObjective->rowspan;

                    $rows->put($lastObjective->rowIndex, $row);
                }
            }

            if ($lastThrust) {
                $row = $rows[$lastThrust->rowIndex];

                if (isset($row['thrust'])) {

                    $row['thrust']['rowspan'] = $lastThrust->rowspan;

                    $rows->put($lastThrust->rowIndex, $row);
                }
            }

        });
    }

    /**
     * Carga la información necesaria para mostrar la vista del reporte de poa.
     *
     * @return array
     * @throws Exception
     */
    public function poaReportIndex()
    {
        $executingUnits = $this->departmentRepository->all();

        if (!$executingUnits) {
            throw new Exception(trans('reports.exceptions.executing_units_not_found'));
        }

        return ['executingUnits' => $executingUnits];
    }

    /**
     * Buscar proyectos por unidad responsable
     *
     * @param int $executingUnitId
     *
     * @return mixed
     * @throws Exception
     */
    public function projectsByExecutingUnit(int $executingUnitId)
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('reports.exceptions.fiscal_year_not_found'));
        }

        $projects = $this->projectFiscalYearRepository->findByPlanningExecutingUnit($fiscalYear, $executingUnitId);

        return $projects;
    }

    /**
     * Crear un datatable con la información del POA.
     *
     * @param array $data
     *
     * @return
     * @throws Exception
     */
    public function poaReport(array $data)
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('reports.exceptions.fiscal_year_not_found'), 1000);
        }

        $data = $this->planningReportsRepository->poaReport($fiscalYear->id, $data['filters']);
        $totalAmount = $data->sum('amount');

        $dataTable = DataTables::of($data)
            ->setRowId('id')
            ->addColumn('area', function (BudgetItem $budgetItem) {
                if ($budgetItem->activityProjectFiscalYear) {
                    return $budgetItem->activityProjectFiscalYear->area->code . ' - ' . $budgetItem->activityProjectFiscalYear->area->area;
                } elseif ($budgetItem->operationalActivity) {
                    return $budgetItem->operationalActivity->subprogram->parent->area->code . ' - ' . $budgetItem->operationalActivity->subprogram->parent->area->area;
                } else {
                    return '';
                }
            })
            ->addColumn('program', function (BudgetItem $budgetItem) {
                if ($budgetItem->activityProjectFiscalYear) {
                    return $budgetItem->activityProjectFiscalYear->component->project->subprogram->parent->code . ' - ' .
                        $budgetItem->activityProjectFiscalYear->component->project->subprogram->parent->description;
                } elseif ($budgetItem->operationalActivity) {
                    return $budgetItem->operationalActivity->subprogram->parent->code . ' - ' .
                        $budgetItem->operationalActivity->subprogram->parent->name;
                } else {
                    return '';
                }
            })
            ->addColumn('subprogram', function (BudgetItem $budgetItem) {
                if ($budgetItem->activityProjectFiscalYear) {
                    return $budgetItem->activityProjectFiscalYear->component->project->subprogram->code . ' - ' .
                        $budgetItem->activityProjectFiscalYear->component->project->subprogram->description;
                } elseif ($budgetItem->operationalActivity) {
                    return $budgetItem->operationalActivity->subprogram->code . ' - ' .
                        $budgetItem->operationalActivity->subprogram->name;
                } else {
                    return '';
                }
            })
            ->addColumn('project', function (BudgetItem $budgetItem) {
                if ($budgetItem->activityProjectFiscalYear) {
                    return $budgetItem->activityProjectFiscalYear->component->project->cup . ' - ' .
                        $budgetItem->activityProjectFiscalYear->component->project->name;
                } else {
                    return BudgetItem::CODE_999;
                }
            })
            ->addColumn('activity', function (BudgetItem $budgetItem) {
                if ($budgetItem->activityProjectFiscalYear) {
                    return $budgetItem->activityProjectFiscalYear->code . ' - ' . $budgetItem->activityProjectFiscalYear->name;
                } elseif ($budgetItem->operationalActivity) {
                    return $budgetItem->operationalActivity->code . ' - ' . $budgetItem->operationalActivity->name;
                } else {
                    return '';
                }
            })
            ->addColumn('executingUnit', function (BudgetItem $budgetItem) {
                if ($budgetItem->activityProjectFiscalYear) {
                    return $budgetItem->activityProjectFiscalYear->component->project->executingUnit->code . ' - ' .
                        $budgetItem->activityProjectFiscalYear->component->project->executingUnit->name;
                } elseif ($budgetItem->operationalActivity) {
                    return $budgetItem->operationalActivity->executingUnit->code . ' - ' . $budgetItem->operationalActivity->executingUnit->name;
                } else {
                    return '';
                }
            })
            ->addColumn('institution', function (BudgetItem $budgetItem) {
                if ($budgetItem->institution) {
                    return $budgetItem->institution->code . ' - ' . $budgetItem->institution->name;
                }
                return '';
            })
            ->addColumn('nature', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->budgetClassifier->full_code)[0];
            })
            ->addColumn('group', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->budgetClassifier->full_code)[1];
            })
            ->addColumn('subgroup', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->budgetClassifier->full_code)[2];
            })
            ->addColumn('item', function (BudgetItem $budgetItem) {
                return $budgetItem->budgetClassifier->code . ' - ' . $budgetItem->budgetClassifier->title;
            })
            ->addColumn('orientation', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->spendingGuide->full_code)[0];
            })
            ->addColumn('direction', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->spendingGuide->full_code)[1];
            })
            ->addColumn('category', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->spendingGuide->full_code)[2];
            })
            ->addColumn('subCategory', function (BudgetItem $budgetItem) {
                return $budgetItem->spendingGuide->code . ' - ' . $budgetItem->spendingGuide->description;
            })
            ->addColumn('province', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->geographicLocation->getFullCode())[0];
            })
            ->addColumn('canton', function (BudgetItem $budgetItem) {
                return explode('.', $budgetItem->geographicLocation->getFullCode())[1];
            })
            ->addColumn('parish', function (BudgetItem $budgetItem) {
                return $budgetItem->geographicLocation->code . ' - ' . $budgetItem->geographicLocation->description;
            })
            ->addColumn('source', function (BudgetItem $budgetItem) {
                return $budgetItem->source->code . ' - ' . $budgetItem->source->description;
            })
            ->addColumn('competence', function (BudgetItem $budgetItem) {
                if ($budgetItem->competence) {
                    return $budgetItem->competence->code . ' - ' . $budgetItem->competence->name;
                }
                return '';
            })
            ->addColumn('description', function (BudgetItem $budgetItem) {
                return $budgetItem->description ?? '';
            })
            ->editColumn('amount', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->amount, 2, ',', '.');
            })
            ->editColumn('jan', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->jan, 2);
            })
            ->editColumn('feb', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->feb, 2);
            })
            ->editColumn('mar', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->mar, 2);
            })
            ->editColumn('t1', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->jan + $budgetItem->feb + $budgetItem->mar, 2);
            })
            ->editColumn('apr', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->apr, 2);
            })
            ->editColumn('may', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->may, 2);
            })
            ->editColumn('jun', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->jun, 2);
            })
            ->editColumn('t2', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->apr + $budgetItem->may + $budgetItem->jun, 2);
            })
            ->editColumn('jul', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->jul, 2);
            })
            ->editColumn('aug', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->aug, 2);
            })
            ->editColumn('sep', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->sep, 2);
            })
            ->editColumn('t3', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->jul + $budgetItem->aug + $budgetItem->sep, 2);
            })
            ->editColumn('oct', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->oct, 2);
            })
            ->editColumn('nov', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->nov, 2);
            })
            ->editColumn('december', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->december, 2);
            })
            ->editColumn('t4', function (BudgetItem $budgetItem) {
                return number_format($budgetItem->oct + $budgetItem->nov + $budgetItem->december, 2);
            })
            ->with('totalAmount', number_format($totalAmount, 2))
            ->make(true);

        return $dataTable;
    }

    /**
     * Obtiene los datos necesarios para el poa
     *
     * @param array $filters
     *
     * @return mixed
     * @throws Exception
     */
    public function poaExportXls(array $filters)
    {
        $fiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$fiscalYear) {
            throw new Exception(trans('reports.exceptions.fiscal_year_not_found'), 1000);
        }
        return $this->planningReportsRepository->poaReport($fiscalYear->id, $filters);
    }

    /**
     * Obtiene información necesaria para los filtros del reporte ppi
     *
     * @return array
     * @throws Exception
     */
    public function pacReportView()
    {
        $years = $this->fiscalYearRepository->all();

        if (!$years->count()) {
            throw  new Exception(trans('reports.exceptions.no_info'), 1000);
        }

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $currentYear = $currentFiscalYear ? $currentFiscalYear->year : Carbon::now()->year;
        $option = Plan::HAS_VIEW;
        $gadInfo = $this->settingRepository->findByKey('gad')->value;
        $gad = trans('reports.labels.gad') . ' ' . $gadInfo['province'];

        return compact('years', 'currentYear', 'currentFiscalYear', 'option', 'gad');
    }

    /**
     * Crear un datatable con la información del PAC.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function pacReport(Request $request)
    {
        $data = $request->all();

        $fiscalYear = $this->fiscalYearRepository->find($data['fiscalYearId']);

        if (!$fiscalYear) {
            throw new Exception(trans('reports.exceptions.fiscal_year_not_found'), 1000);
        }

        $pacReport = $this->planningReportsRepository->pacReport($fiscalYear->id);
        $totalAmount = $pacReport->sum('amount');

        $dataTable = DataTables::of($pacReport)
            ->addColumn('fiscalYear', function () use ($fiscalYear) {
                return $fiscalYear->year;
            })
            ->addColumn('institution', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->institution) {
                    return $purchase->budgetItem->institution->code;
                } else {
                    return '';
                }
            })
            ->addColumn('responsibleUnit', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->activityProjectFiscalYear) {
                    return $purchase->budgetItem->activityProjectFiscalYear->component->project->responsibleUnit->code;
                } elseif ($purchase->budgetItem->operationalActivity) {
                    return $purchase->budgetItem->operationalActivity->responsibleUnit->code;
                } else {
                    return '';
                }
            })
            ->addColumn('executingUnit', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->activityProjectFiscalYear) {
                    return $purchase->budgetItem->activityProjectFiscalYear->component->project->executingUnit->code;
                } elseif ($purchase->budgetItem->operationalActivity) {
                    return $purchase->budgetItem->operationalActivity->executingUnit->code;
                } else {
                    return '';
                }
            })
            ->addColumn('program', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->activityProjectFiscalYear) {
                    return $purchase->budgetItem->activityProjectFiscalYear->component->project->subprogram->parent->code;
                } elseif ($purchase->budgetItem->operationalActivity) {
                    return $purchase->budgetItem->operationalActivity->subprogram->parent->code;
                } else {
                    return '';
                }
            })
            ->addColumn('subprogram', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->activityProjectFiscalYear) {
                    return $purchase->budgetItem->activityProjectFiscalYear->component->project->subprogram->code;
                } elseif ($purchase->budgetItem->operationalActivity) {
                    return $purchase->budgetItem->operationalActivity->subprogram->code;
                } else {
                    return '';
                }
            })
            ->addColumn('project', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->activityProjectFiscalYear) {
                    return $purchase->budgetItem->activityProjectFiscalYear->component->project->cup;
                } else {
                    return BudgetItem::CODE_999;
                }
            })
            ->addColumn('activity', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->activityProjectFiscalYear) {
                    return $purchase->budgetItem->activityProjectFiscalYear->code;
                } elseif ($purchase->budgetItem->operationalActivity) {
                    return $purchase->budgetItem->operationalActivity->code;
                } else {
                    return '';
                }
            })
            ->addColumn('geographic', function (PublicPurchase $purchase) {
                return $purchase->budgetItem->geographicLocation->getFullCode();
            })
            ->addColumn('item', function (PublicPurchase $purchase) {
                return $purchase->budgetItem->budgetClassifier->full_code;
            })
            ->addColumn('source', function (PublicPurchase $purchase) {
                return $purchase->budgetItem->source->code;
            })
            ->addColumn('projectName', function (PublicPurchase $purchase) {
                if ($purchase->budgetItem->activityProjectFiscalYear) {
                    return $purchase->budgetItem->activityProjectFiscalYear->component->project->name;
                } else {
                    return '';
                }
            })
            ->addColumn('cpc', function (PublicPurchase $purchase) {
                return $purchase->cpcClassifier->code;
            })
            ->addColumn('cpcDescription', function (PublicPurchase $purchase) {
                return $purchase->cpcClassifier->description;
            })
            ->editColumn('international_funds', function (PublicPurchase $purchase) {
                return $purchase->is_international_fund ? PublicPurchase::YES : PublicPurchase::NO;
            })
            ->editColumn('measure_unit', function (PublicPurchase $purchase) {
                return $purchase->measureUnit->name;
            })
            ->editColumn('amount_no_vat', function (PublicPurchase $purchase) {
                return number_format($purchase->amount_no_vat, 2, ',', '.');
            })
            ->with('totalAmount', number_format($totalAmount, 2))
            ->make(true);

        return $dataTable;
    }

    /**
     * Obtiene los datos necesarios para el pac
     *
     * @param int $fiscalYearId
     *
     * @return mixed
     * @throws Exception
     */
    public function pacExportXls(int $fiscalYearId)
    {
        $fiscalYear = $this->fiscalYearRepository->find($fiscalYearId);

        if (!$fiscalYear) {
            throw new Exception(trans('reports.exceptions.fiscal_year_not_found'), 1000);
        }

        $reportData = $this->planningReportsRepository->pacReport($fiscalYear->id);

        return [
            'year' => $fiscalYear->year,
            'rows' => $reportData,
            'provinceCode' => $this->settingRepository->findByKey('gad')->value['code']
        ];
    }

    /**
     * Mostrar vista de listado de reporte (Resumen ejecutivo de proyectos priorizados).
     *
     * @return mixed
     *
     * @throws Throwable
     */
    public function executiveSummary()
    {
        $gadInfo = $this->settingRepository->findByKey('gad')->value;
        $gad = trans('reports.labels.gad') . ' ' . $gadInfo['province'];
        $years = $this->fiscalYearRepository->all();

        if (!$years->count()) {
            throw  new Exception(trans('reports.exceptions.no_info'), 1000);
        }

        return compact('gad', 'years');
    }

    /**
     * Retornar información para el reporte (Resumen ejecutivo de proyectos priorizados).
     *
     * @param int $fiscalYearId
     *
     * @return mixed
     * @throws Exception
     */
    public function executiveSummaryPriorizedProjects(int $fiscalYearId)
    {
        $projectFiscalYears = $this->projectFiscalYearRepository->getPriorizedProjectDataTable($fiscalYearId);

        $dataTable = DataTables::of($projectFiscalYears)
            ->editColumn('full_cup', function (ProjectFiscalYear $entity) {
                return $entity->project->full_cup;
            })->addColumn('name', function (ProjectFiscalYear $entity) {
                return $entity->project->name;
            })
            ->addColumn('responsibleUnit', function (ProjectFiscalYear $entity) {
                return $entity->project->responsibleUnit ? $entity->project->responsibleUnit->name : '';
            })
            ->addColumn('date_init', function (ProjectFiscalYear $entity) {
                return $entity->project->date_init;
            })
            ->addColumn('date_end', function (ProjectFiscalYear $entity) {
                return $entity->project->date_end;
            })
            ->editColumn('status', function (ProjectFiscalYear $entity) {
                return trans('projects.status.' . strtolower($entity->status));
            })
            ->make(true);

        return $dataTable;
    }

    /**
     * Crear un datatable con la información para el reporte (Resumen ejecutivo de proyectos priorizados).
     *
     * @param int $fiscalYearId
     *
     * @return mixed
     * @throws Exception
     */
    public function executiveSummaryPriorizedProjectsExport(int $fiscalYearId)
    {
        $projectFiscalYears = $this->projectFiscalYearRepository->getPriorizedProjectExport($fiscalYearId);
        $gadName = json_decode($this->settingRepository->findByKey('gad'))->value->province;
        return [
            'projectFiscalYears' => $projectFiscalYears,
            'gadName' => $gadName
        ];
    }

    /**
     * Obtiene el PEI vigente.
     *
     * @return Plan
     * @throws Exception
     */
    public function getPEIPlan()
    {
        $plans = $this->planRepository->getPlans(Plan::TYPE_PEI);

        if (!$plans) {
            throw new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        return $plans->first();
    }

    /**
     * Retornar información para el reporte (Proforma Presupuestaria por año).
     *
     * @param int $fiscalYearId
     *
     * @return mixed
     * @throws Exception
     */
    public function budgetAdjustmentData(int $fiscalYearId)
    {
        $fiscalYear = $this->fiscalYearRepository->find($fiscalYearId);

        $proformaData = $this->localProformaRepository->findReportDataByFiscalYear($fiscalYear);

        $totalIncome = $proformaData->sum('income_amount') ?? 0;
        $totalExpense = $proformaData->sum('expense_amount') ?? 0;

        $dataTable = DataTables::of($proformaData)
            ->editColumn('type', function ($entity) {
                return $entity->type === Proforma::TYPE_INCOME ? trans('app.labels.income') : trans('app.labels.expense');
            })
            ->editColumn('income_amount', function ($entity) {
                return intval($entity->income_amount) === 0 ? '' : number_format($entity->income_amount, 2);
            })
            ->editColumn('expense_amount', function ($entity) {
                return intval($entity->expense_amount) === 0 ? '' : number_format($entity->expense_amount, 2);
            })
            ->rawColumns(['type', 'income_amount', 'expense_amount'])
            ->with('totalIncome', number_format($totalIncome, 2))
            ->with('totalExpense', number_format($totalExpense, 2))
            ->make(true);

        return $dataTable;
    }

    /**
     * Muestra la página principal del reporte de banco de proyectos
     *
     * @return array
     */
    public function projectsRepositoryIndex()
    {
        $gad = $this->settingRepository->findByKey('gad')->value;
        $phases = Project::PROJECT_PHASES;
        $statuses = Project::STATUSES;

        return compact('gad', 'phases', 'statuses');
    }

    /**
     * Obtiene los datos necesarios del banco de proyectos
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function projectsRepositoryData(Request $request)
    {
        $projects = $this->projectRepository->getAllProjects($request->all());

        $dataTable = DataTables::of($projects)
            ->setRowId('id')
            ->editColumn('full_cup', function (Project $entity) {
                return $entity->full_cup;
            })
            ->addColumn('name', function (Project $entity) {
                return $entity->name;
            })
            ->addColumn('executing_unit', function (Project $entity) {
                return $entity->executingUnit ? $entity->executingUnit->name : '';
            })
            ->addColumn('date_init', function (Project $entity) {
                return $entity->date_init;
            })
            ->addColumn('date_end', function (Project $entity) {
                return $entity->date_end;
            })
            ->addColumn('referential_budget', function (Project $entity) {
                return number_format($entity->referential_budget, 2);
            })
            ->addColumn('month_duration', function (Project $entity) {
                return number_format($entity->month_duration, 2);
            })
            ->editColumn('phase', function (Project $entity) {
                return Project::PROJECT_PHASES[$entity->phase];
            })
            ->editColumn('status', function (Project $entity) {
                return trans('projects.status.' . strtolower($entity->status));
            })
            ->editColumn('is_road', function (Project $entity) {
                return $entity->is_road ? trans('app.labels.yes') : trans('app.labels.no');
            })
            ->addColumn('ongoing_project', function (Project $entity) {
                return $entity->fiscalYears->count() > 1 ? trans('app.labels.yes') : trans('app.labels.no');
            })
            ->rawColumns(['cup', 'name', 'responsibleUnit', 'date_init', 'date_end', 'referential_budget', 'month_duration', 'status', 'ongoing_project'])
            ->make(true);

        return $dataTable;
    }

    /**
     * Obtiene los datos necesarios del banco de proyectos
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function projectsRepositoryExport(Request $request)
    {
        return [
            'rows' => $this->projectRepository->getAllProjects($request->all())->get()
        ];
    }

    /**
     * Carga información necesaria para mostrar la vista de acuerdo por resultados.
     *
     * @return array
     * @throws Exception
     */
    public function agreementForResultsIndex()
    {
        $executingUnits = $this->departmentRepository->findAll();

        if (!$executingUnits) {
            throw new Exception(trans('reports.exceptions.executing_units_not_found'));
        }

        $fiscalYears = $this->fiscalYearRepository->all();

        if (!$fiscalYears) {
            throw new Exception(trans('reports.exceptions.fiscal_year_not_found'));
        }

        return [
            'executingUnits' => $executingUnits,
            'fiscalYears' => $fiscalYears,
            'currentFiscalYear' => $this->fiscalYearRepository->findCurrentFiscalYear()
        ];
    }

    /**
     * Obtiene los datos necesarios del reporte de acuerdo por resultados.
     *
     * @param Request $request
     *
     * @return mixed
     * @throws Exception
     */
    public function agreementForResultsData(Request $request)
    {
        $data = $request->all();

        $userData = $this->planningReportsRepository->agreementForResultsReport($data['fiscalYearId'], $data['userId']);

        $collection = collect([]);

        if ($userData) {
            $userData->activities->each(function ($activity) use ($collection) {
                $collection->push($activity);
            });

            $userData->tasks->each(function ($task) use ($collection) {
                $collection->push($task);
            });
        }

        $dataTable = DataTables::of($collection)
            ->editColumn('activity_task', function (Model $entity) {
                return $entity->name;
            })
            ->editColumn('due_date', function (Model $entity) {
                $due_date = $entity instanceof Task ? $entity->due_date : 'N/A';

                return $due_date;
            })
            ->editColumn('advance_log_date', function (Model $entity) {
                if ($entity instanceof Task) {
                    if ($entity->files->isNotEmpty()) {
                        $file = $entity->files->first();
                        $advance_log_date = formatDate($file->updated_at, 'd-m-Y');
                    } else {
                        $advance_log_date = '';
                    }
                } else {
                    if ($entity instanceof ActivityProjectFiscalYear) {
                        $advance_log_date = 'N/A';
                    }
                }

                return $advance_log_date;
            })
            ->addColumn('completion', function (Model $entity) {
                if ($entity instanceof Task) {
                    $completion = in_array($entity->status, [Task::STATUS_COMPLETED_OUTOFTIME, Task::STATUS_COMPLETED_ONTIME]) ? 100 : 0;
                } else {
                    if ($entity instanceof ActivityProjectFiscalYear) {
                        $completion = $entity->getProgress();
                    }
                }

                $completion = number_format($completion, 2);

                return $completion . ' %';
            })
            ->editColumn('semaphore', function (Model $entity) {
                if ($entity instanceof Task) {
                    $semaphore = '<div class="circle bg_' . Task::SEMAPHORE[$entity->status] . '"></div>';
                } else {
                    if ($entity instanceof ActivityProjectFiscalYear) {
                        $semaphore = '<div class="circle bg_' . $entity->getSemaphore() . '"></div>';
                    } else {
                        $semaphore = '';
                    }
                }

                return $semaphore;
            })
            ->editColumn('status', function (Model $entity) {
                if ($entity instanceof Task) {
                    $semaphore = trans('physical_progress.labels.' . $entity->status);
                } else {
                    if ($entity instanceof ActivityProjectFiscalYear) {
                        $semaphore = trans('physical_progress.labels.activityStatus.' . $entity->getSemaphore());
                    } else {
                        $semaphore = '';
                    }
                }

                return $semaphore;
            })
            ->rawColumns(['semaphore'])
            ->make(true);

        $table = $dataTable->getData()->data;
        $total_advance = collect();

        foreach ($table as $activityTask) {
            $total_advance->push((double)$activityTask->completion);
        }

        $total_advance->isEmpty() ? $total_advance = collect(0.0) : $total_advance = collect($total_advance->avg());

        $response = $dataTable->getData(true);
        $response['totalAdvance'] = number_format($total_advance->first(), 2) . ' %';

        return new JsonResponse($response);
    }

    /**
     * Obtiene la información necesaria para exportar el reporte de acuerdo por resultados
     *
     * @param Request $request
     *
     * @return array
     * @throws Exception
     */
    public function agreementForeResultsExport(Request $request)
    {
        $data = $request->all();

        $rows = self::agreementForResultsData($request)->getData();
        $date = date('d-m-Y');
        $servant = $this->userRepository->find($data['userId']);
        $executingUnit = $this->departmentRepository->find($data['executingUnitId']);
        $fiscalYear = $this->fiscalYearRepository->find($data['fiscalYearId']);
        $totalAdvance = $rows->totalAdvance;
        $gadInfo = $this->settingRepository->findByKey('gad')->value;

        return [
            'rows' => $rows->data,
            'date' => $date,
            'servant' => $servant,
            'executingUnit' => $executingUnit,
            'fiscalYear' => $fiscalYear,
            'totalAdvance' => $totalAdvance,
            'gad' => $gadInfo['province']
        ];
    }

    /**
     * Obtiene los funcionarios.
     *
     * @param array $data
     *
     * @return EloquentCollection
     */
    public function servantSearch(array $data)
    {
        if (isset($data['q']) and !empty($data['q'])) {
            return $this->userRepository->findUsersByDepartmentWithSearch($data['executingUnitId'], $data['q'])->map(function ($item) {
                return ['id' => $item->user_id, 'text' => $item->fullName()];
            });
        }

        return $this->userRepository->findUsersByDepartmentWithSearch($data['executingUnitId'])->map(function ($item) {
            return ['id' => $item->user_id, 'text' => $item->fullName()];
        });
    }

    /**
     * Obtiene información para reporte de Cédula Presupuestaria
     *
     * @return array
     * @throws Exception
     */
    public function budgetCardIndex()
    {

        $years = $this->fiscalYearRepository->all();

        if (!$years->count()) {
            throw  new Exception(trans('reports.exceptions.no_info'), 1000);
        }

        $executingUnits = $this->departmentRepository->all();

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $currentYear = $currentFiscalYear ? $currentFiscalYear->year : Carbon::now()->year;
        $currentDate = Carbon::now()->format('Y-m-d');

        $levels = $this->trackingReportsRepository->structureLevels($currentYear);

        return compact('years', 'currentYear', 'currentDate', 'levels', 'executingUnits');
    }

    /**
     * Obtiene los datos necesarios del banco de proyectos
     *
     * @param array $data
     *
     * @return mixed
     * @throws Exception
     */
    public function budgetCardData(array $data)
    {
        $operator = '=';

        if (isset($data['view_children']) && $data['view_children']) {
            $operator = '<=';
        }

        $dataTable = DataTables::of($this->trackingReportsRepository->budgetCard($data['year'], $data['date'], $data['type'], $data['level'], $operator, 0, '',
            $data['executing_unit'] ? $data['executing_unit'] : ''))
            ->setRowId('id')
            ->editColumn('cuenta', function ($item) use ($data) {
                if ($item->ult_cue == 'S') {
                    $url = route('account.budget_card.reports', ['year' => $data['year'], 'account' => "{$item->cuenta}"]);
                    return "<a href='{$url}' class='blue ajaxify'>{$item->cuenta}</a>";
                }
                return $item->cuenta;
            })
            ->editColumn('asig_ini', function ($item) {
                return number_format($item->asig_ini, 2);
            })
            ->editColumn('reformas', function ($item) {
                return number_format($item->reformas, 2);
            })
            ->editColumn('codificado', function ($item) {
                return number_format($item->codificado, 2);
            })
            ->editColumn('certificado', function ($item) {
                return number_format($item->certificado, 2);
            })
            ->editColumn('comprometido', function ($item) {
                return number_format($item->comprometido, 2);
            })
            ->editColumn('devengado', function ($item) {
                return number_format($item->devengado, 2);
            })
            ->editColumn('por_comprometer', function ($item) {
                return number_format($item->por_comprometer_real, 2);
            })
            ->editColumn('por_devengar', function ($item) {
                return number_format($item->por_devengar, 2);
            })
            ->editColumn('pagado', function ($item) {
                return number_format($item->pagado, 2);
            })
            ->rawColumns(['cuenta'])
            ->make(true);

        return $dataTable;
    }

    /**
     * Obtiene los datos necesarios del banco de proyectos
     *
     * @param int $year
     * @param string $account
     *
     * @return mixed
     */
    public function getBudgetItemByAccount(int $year, string $account)
    {
        return [
            'year' => $year,
            'account' => $this->trackingReportsRepository->getBudgetItemByAccount($year, $account)[0],
        ];
    }

    /**
     * Obtiene los datos necesarios del banco de proyectos
     *
     * @param int $year
     * @param string $account
     *
     * @return mixed
     * @throws Exception
     */
    public function budgetItemMovementsData(int $year, string $account)
    {

        return DataTables::of($this->trackingReportsRepository->budgetItemMovements($year, $account))
            ->setRowId('id')
            ->editColumn('assigned', function ($item) {
                return number_format(isset($item->assigned) ? $item->assigned : 0.00, 2);
            })
            ->editColumn('reform', function ($item) {
                return number_format(isset($item->reform) ? $item->reform : 0.00, 2);
            })
            ->editColumn('encoded', function ($item) {
                return number_format(isset($item->encoded) ? $item->encoded : 0.0, 2);
            })
            ->editColumn('committed', function ($item) {
                return number_format(isset($item->committed) ? $item->committed : 0.00, 2);
            })
            ->editColumn('accrued', function ($item) {
                return number_format(isset($item->accrued) ? $item->accrued : 0.00, 2);
            })
            ->addColumn('for_compromising', function ($item) {
                return number_format(isset($item->for_compromising) ? $item->for_compromising : 0.00, 2);
            })
            ->addColumn('to_accrued', function ($item) {
                return number_format(isset($item->to_accrued) ? $item->to_accrued : 0.00, 2);
            })
            ->rawColumns(['cuenta'])
            ->make(true);
    }

    /**
     * Obtiene información para reporte de cédula presupuestaria
     *
     * @param array $data
     *
     * @return Collection
     */
    public function budgetCardDataExport(array $data)
    {
        $operator = '=';

        if (isset($data['view_children']) && $data['view_children']) {
            $operator = '<=';
        }

        return $this->trackingReportsRepository->budgetCard($data['year'], $data['date'], $data['type'], $data['level'], $operator, 0, $data['item'] ? $data['item'] : '',
            $data['executing_unit'] ? $data['executing_unit'] : '');
    }

    /**
     * Obtiene los niveles de las estructuras de Ingresos ó Gastos
     *
     * @param int $year
     * @param int $type
     *
     * @return array
     */
    public function levels(int $year, int $type)
    {
        return $this->trackingReportsRepository->structureLevels($year, $type);
    }

    /**
     * Obtiene información necesaria para los filtros del reporte ppi
     *
     * @return array
     * @throws Exception
     */
    public function annualBudgetPlanningReport()
    {
        $years = $this->fiscalYearRepository->all();

        if (!$years->count()) {
            throw  new Exception(trans('reports.exceptions.no_info'), 1000);
        }

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $currentYear = $currentFiscalYear ? $currentFiscalYear->year : Carbon::now()->year;
        $executingUnits = $this->departmentRepository->findAll();

        return compact('years', 'currentYear', 'executingUnits');
    }

    /**
     * Cargar información del reporte PPI.
     *
     * @param Request $request
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function annualBudgetPlanningData(Request $request)
    {
        $data = $request->all();

        $fiscalYear = $this->fiscalYearRepository->find($data['fiscalYearId']);

        if (!$fiscalYear) {
            throw new Exception(trans('reports.exceptions.fiscal_year_not_found'), 1000);
        }

        $reportData = $this->planningReportsRepository->annualBudgetPlanningReport($data);

        $totalBudget = 0;

        $reportData->each(function ($item) use (&$totalBudget) {
            $totalBudget += $item->budgetItems->sum('amount');
        });

        $dataTable = DataTables::of($reportData
            ->sortBy('project.cup')
            ->sortBy('project.subprogram.parent.code')
            ->sortBy('fiscalYear.year')
            ->sortBy('project.subprogram.parent.parent.id'))
            ->setRowId('objective_id')
            ->addColumn('objective_id', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return $activityProjectFiscalYear->projectFiscalYear->project->subprogram->parent->parent->id;
            })
            ->addColumn('objective_description', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return $activityProjectFiscalYear->projectFiscalYear->project->subprogram->parent->parent->description;
            })
            ->addColumn('program_name', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return $activityProjectFiscalYear->projectFiscalYear->project->subprogram->parent->code . ' - ' . $activityProjectFiscalYear->projectFiscalYear->project->subprogram->parent->description;
            })
            ->addColumn('executing_unit', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return $activityProjectFiscalYear->projectFiscalYear->project->executingUnit->name;
            })
            ->addColumn('project_name', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return $activityProjectFiscalYear->projectFiscalYear->project->cup . ' - ' . $activityProjectFiscalYear->projectFiscalYear->project->name;
            })
            ->addColumn('activity', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return $activityProjectFiscalYear->name;
            })
            ->addColumn('component', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return $activityProjectFiscalYear->component->name;
            })
            ->editColumn('referential_budget', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return number_format($activityProjectFiscalYear->budgetItems->sum('amount'), 2);
            })
            ->rawColumns(['objective', 'program_name', 'project_name', 'executing_unit', 'budget', 'component', 'activity'])
            ->with('totalBudget', number_format($totalBudget, 2))
            ->make(true);

        return $dataTable;
    }

    /**
     * Obtiene los datos necesarios de la programación presupuestaria
     *
     * @param int $fiscalYearId
     * @param int $departmentId
     *
     * @return mixed
     * @throws Exception
     */
    public function annualBudgetPlanningExport(int $fiscalYearId, int $departmentId = null)
    {
        $fiscalYear = $this->fiscalYearRepository->find($fiscalYearId);

        if (!$fiscalYear) {
            throw new Exception(trans('reports.exceptions.fiscal_year_not_found'), 1000);
        }

        $reportData = $this->planningReportsRepository->annualBudgetPlanningReport(compact('fiscalYearId', 'departmentId'));

        $totalBudget = 0;

        $reportData->each(function ($item) use (&$totalBudget) {
            $totalBudget += $item->budgetItems->sum('amount');
        });

        return [
            'year' => $fiscalYear->year,
            'rows' => $reportData,
            'totalBudget' => $totalBudget
        ];
    }

    /**
     * Obtiene información necesaria para los filtros del reporte de ejecución de actividades por trimestres.
     *
     * @return array
     * @throws Exception
     */
    public function activitiesQuarterlyExecutionReport()
    {
        $years = $this->fiscalYearRepository->all();

        if (!$years->count()) {
            throw  new Exception(trans('reports.exceptions.no_info'), 1000);
        }

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $currentYear = $currentFiscalYear ? $currentFiscalYear->year : Carbon::now()->year;
        $executingUnits = $this->departmentRepository->findAll();

        return compact('years', 'currentYear', 'executingUnits');
    }

    /**
     * Cargar información del reporte ejecución de actividades por trimestres.
     *
     * @param Request $request
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function activitiesQuarterlyExecutionData(Request $request)
    {
        $data = $request->all();

        $fiscalYear = $this->fiscalYearRepository->find($data['fiscalYearId']);

        if (!$fiscalYear) {
            throw new Exception(trans('reports.exceptions.fiscal_year_not_found'), 1000);
        }

        $reportData = $this->planningReportsRepository->activitiesQuarterlyExecutionReport($data);

        $activitiesProgress = collect();
        $projectFiscalYears = collect();

        $reportData->each(function (ActivityProjectFiscalYear &$activityProjectFiscalYear) use (&$activitiesProgress, &$projectFiscalYears) {
            if (!$projectFiscalYears->contains($activityProjectFiscalYear->projectFiscalYear->id)) {
                $activitiesProgress = $activitiesProgress->merge($this->projectFiscalYearRepository->getQuarterlyProgressStructure($activityProjectFiscalYear->projectFiscalYear));
                $projectFiscalYears->push($activityProjectFiscalYear->projectFiscalYear->id);
            }
        });
        $activitiesProgress = $activitiesProgress->keyBy('id');

        $dataTable = DataTables::of($reportData
            ->sortBy('project.cup')
            ->sortBy('project.subprogram.parent.code')
            ->sortBy('fiscalYear.year')
            ->sortBy('project.subprogram.parent.parent.id'))
            ->setRowId('objective_id')
            ->addColumn('objective_id', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return $activityProjectFiscalYear->projectFiscalYear->project->subprogram->parent->parent->id;
            })
            ->addColumn('objective_description', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return $activityProjectFiscalYear->projectFiscalYear->project->subprogram->parent->parent->description;
            })
            ->addColumn('program_name', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return $activityProjectFiscalYear->projectFiscalYear->project->subprogram->parent->code . ' - ' . $activityProjectFiscalYear->projectFiscalYear->project->subprogram->parent->description;
            })
            ->addColumn('executing_unit', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return $activityProjectFiscalYear->projectFiscalYear->project->executingUnit->name;
            })
            ->addColumn('project_name', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return $activityProjectFiscalYear->projectFiscalYear->project->cup . ' - ' . $activityProjectFiscalYear->projectFiscalYear->project->name;
            })
            ->addColumn('progress', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return $activityProjectFiscalYear->projectFiscalYear->getProgress() . ' %';
            })
            ->addColumn('component', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return $activityProjectFiscalYear->component->name;
            })
            ->addColumn('activity', function (ActivityProjectFiscalYear $activityProjectFiscalYear) {
                return $activityProjectFiscalYear->name;
            })
            ->editColumn('first_quarter', function (ActivityProjectFiscalYear $activityProjectFiscalYear) use ($activitiesProgress) {
                return $activitiesProgress[$activityProjectFiscalYear->id]['progress']['q1'] . ' %';
            })
            ->editColumn('second_quarter', function (ActivityProjectFiscalYear $activityProjectFiscalYear) use ($activitiesProgress) {
                return $activitiesProgress[$activityProjectFiscalYear->id]['progress']['q2'] . ' %';
            })
            ->editColumn('third_quarter', function (ActivityProjectFiscalYear $activityProjectFiscalYear) use ($activitiesProgress) {
                return $activitiesProgress[$activityProjectFiscalYear->id]['progress']['q3'] . ' %';
            })
            ->editColumn('fourth_quarter', function (ActivityProjectFiscalYear $activityProjectFiscalYear) use ($activitiesProgress) {
                return $activitiesProgress[$activityProjectFiscalYear->id]['progress']['q4'] . ' %';
            })
            ->rawColumns([
                'objective',
                'program_name',
                'project_name',
                'executing_unit',
                'budget',
                'component',
                'activity',
                'first_quarter',
                'second_quarter',
                'third_quarter',
                'fourth_quarter',
                'progress'
            ])
            ->make(true);

        return $dataTable;
    }

    /**
     * Obtiene lista de proyectos
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function projectSearch(Request $request)
    {
        $data = $request->all();

        if (isset($data['q']) and !empty($data['q'])) {
            return $this->projectRepository->findProjects($data['q'])->map(function ($item) {
                return ['id' => $item->id, 'text' => $item->name];
            });
        }

        return $this->projectRepository->findProjects()->map(function ($item) {
            return ['id' => $item->id, 'text' => $item->name];
        });
    }

    /**
     * Buscar información para vista del reporte de Ingresos y Gastos
     *
     * @return array
     * @throws Exception
     */
    public function incomesExpensesBySourceIndex()
    {
        $years = $this->fiscalYearRepository->all();

        if (!$years->count()) {
            throw  new Exception(trans('reports.exceptions.no_info'), 1000);
        }

        $currentFiscalYear = $this->fiscalYearRepository->findNextFiscalYear();
        $currentYear = $currentFiscalYear ? $currentFiscalYear->year : Carbon::now()->year;

        return compact('years', 'currentYear');
    }

    /**
     * Buscar información para vista del reporte de Ingresos y Gastos por año
     *
     * @param int $fiscalYearId
     *
     * @return array
     */
    public function incomesExpensesBySourceData(int $fiscalYearId)
    {
        $fiscalYear = $this->fiscalYearRepository->find($fiscalYearId);

        $summary = self::summary($fiscalYear);

        $budgetAdjustmentProcess = resolve(BudgetAdjutmentProcess::class);
        $approved = $budgetAdjustmentProcess->isApproved($this->budgetAdjustmentRepository->findBudgetAdjutmentForFiscalYear($fiscalYear->id));

        $budgetItems = $this->budgetItemRepository->findByFiscalYear($fiscalYear, $approved ? BudgetAdjustment::STATUS_APPROVED : BudgetAdjustment::STATUS_DRAFT);

        $sources = $this->financingSourceRepository->incomesBySource($fiscalYear->id, $budgetItems->pluck('id')->toArray());

        $sources = $sources->map(function ($source) use ($budgetItems) {
            $items = $budgetItems->where('source.id', $source->id);

            if (!$items) {
                $source->setAttribute('totalExpenses', 0.00);
                return $source;
            }
            $source->setAttribute('totalExpenses', $items->sum('amount'));
            $source->setAttribute('diff', round($source->totalIncomes, 2) - round($source->totalExpenses, 2));
            $source->setAttribute('budgetItems', $items);
            return $source;
        });

        return [$sources, $summary];
    }

    /**
     * Obtiene los datos resumen de ingresos y gastos
     *
     * @param FiscalYear $fiscalYear
     *
     * @return array
     */
    public function summary(FiscalYear $fiscalYear)
    {

        $incomes = $this->incomeRepository->findByField('fiscal_year_id', $fiscalYear->id)->sum('value');

        $projects = $this->budgetAdjustmentRepository->findBudgetAdjutmentForFiscalYear($fiscalYear->id);

        $investment = $this->budgetAdjustmentRepository->investmentExpenses($fiscalYear->id, $projects->all());

        $currentExpenses = $this->budgetAdjustmentRepository->currentExpenses($fiscalYear->id);

        $totalSpends = $investment + $currentExpenses;

        $balance = $incomes - $totalSpends;

        return [
            'incomes' => number_format($incomes, 2),
            'expenses' => number_format($totalSpends, 2),
            'balance' => number_format($balance, 2)
        ];
    }

    /**
     * Buscar información para vista del reporte de la LOTAIP
     *
     * @return array
     * @throws Exception
     */
    public function lotaipIndex()
    {
        $years = $this->fiscalYearRepository->all();
        $currentFiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('app.messages.exceptions.no_current_fiscal_year_info'), 1000);
        }

        $currentYear = $currentFiscalYear->year;

        return compact('years', 'currentYear');
    }

    /**
     * Buscar información para vista del reporte de la LOTAIP
     *
     * @param int $fiscalYearId
     *
     * @return array
     */
    public function lotaipData(int $fiscalYearId)
    {
        return $this->planningReportsRepository->pacReport($fiscalYearId);
    }

    /**
     * Carga la información necesaria para mostrar la vista del reporte de Proyectos y Actividades POA.
     *
     * @return array
     * @throws Exception
     */
    public function projectActivityIndex()
    {
        $executingUnits = $this->departmentRepository->all();

        if (!$executingUnits) {
            throw new Exception(trans('reports.exceptions.executing_units_not_found'));
        }

        return ['executingUnits' => $executingUnits, 'option' => Plan::HAS_VIEW];
    }

    /**
     * Carga la información necesaria para mostrar la tabla del reporte de Proyectos y Actividades POA.
     *
     * @param int $executingUnitID
     *
     * @return array
     * @throws Exception
     */
    public function projectActivityData(int $executingUnitID)
    {
        $currentFiscalYear = $this->fiscalYearRepository->findNextFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('app.messages.exceptions.no_current_fiscal_year_info'), 1000);
        }

        $executingUnit = $this->departmentRepository->find($executingUnitID);

        if (!$executingUnit) {
            throw new Exception(trans('reports.exceptions.executing_units_not_found'), 1000);
        }

        $data = $this->planningReportsRepository->projectActivityData($currentFiscalYear->id, $executingUnit->id);

        $data = $data->map(function ($obj) {
            $obj->projects->map(function ($proj) {
                $total = $proj->getProjectFiscalYears->sum(function ($pFiscalYear) {
                    return $pFiscalYear->activitiesProjectFiscalYear->sum(function ($act) {
                        return $act->budgetItems->sum('amount');
                    });
                });

                $proj->setAttribute('total', $total);
                return $proj;
            });
            $obj->setAttribute('total', $obj->projects->sum('total'));
            return $obj;
        });

        return [
            'data' => $data,
            'executingUnit' => $executingUnit
        ];
    }

    /**
     * Obtiene información para reporte de Cédula Presupuestaria de Gastos
     *
     * @return array
     * @throws Exception
     */
    public function budgetCardExpensesIndex()
    {

        $years = $this->fiscalYearRepository->findByFields([['year', '>=', $this->settingRepository->findByKey('start_year')->value]]);

        if (!$years->count()) {
            throw  new Exception(trans('reports.exceptions.no_info'), 1000);
        }

        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();
        $currentYear = $currentFiscalYear ? $currentFiscalYear->year : Carbon::now()->year;

        return compact('years', 'currentYear');
    }

    /**
     * Obtiene los datos necesarios del banco de proyectos
     *
     * @param array $data
     *
     * @return mixed
     * @throws Exception
     */
    public function budgetCardExpensesData(array $data)
    {
        $date = date_format(Carbon::today(), 'Y-m-d');

        $dataTable = DataTables::of($this->trackingReportsRepository->budgetCardExpenses($data['year'], $date))
            ->setRowId('partida')
            ->editColumn('asig_ini', function ($item) {
                return number_format($item->asig_ini, 2);
            })
            ->editColumn('reformas', function ($item) {
                return number_format($item->reformas, 2);
            })
            ->editColumn('codificado', function ($item) {
                return number_format($item->codificado, 2);
            })
            ->editColumn('certificado', function ($item) {
                return number_format($item->certificado, 2);
            })
            ->editColumn('comprometido', function ($item) {
                return number_format($item->comprometido, 2);
            })
            ->editColumn('devengado', function ($item) {
                return number_format($item->devengado, 2);
            })
            ->editColumn('por_comprometer', function ($item) {
                return number_format($item->por_comprometer, 2);
            })
            ->editColumn('por_devengar', function ($item) {
                return number_format($item->por_devengar, 2);
            })
            ->editColumn('pagado', function ($item) {
                return number_format($item->pagado, 2);
            })
            ->editColumn('porciento_ejecucion', function ($item) {
                return number_format($item->porciento_ejecucion, 2);
            })
            ->make(true);

        return $dataTable;
    }

    /**
     * Obtiene los datos necesarios del banco de proyectos
     *
     * @return Collection
     */
    public function budgetCardDataDashboard()
    {
        $data = [
            'year' => $this->fiscalYearRepository->findCurrentFiscalYear()->year,
            'date' => Carbon::now()->format('Y-m-d'),
            'type' => 1,
            'level' => '4',
            'executing_unit' => null
        ];
        $operator = '=';
        return $this->trackingReportsRepository->budgetCard($data['year'], $data['date'], $data['type'], $data['level'], $operator, 0, '',
            $data['executing_unit'] ? $data['executing_unit'] : '');
    }
}
