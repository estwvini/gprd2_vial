<?php

namespace App\Processes\Business\Reports;

use App\Models\Business\Plan;
use App\Models\Business\PlanElement;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\Project;
use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use App\Repositories\Repository\Business\Planning\ProjectFiscalYearRepository;
use App\Repositories\Repository\Business\PlanRepository;
use App\Repositories\Repository\Business\Reports\DashboardRepository;
use App\Repositories\Repository\Business\Reports\ExecutionReportsRepository;
use App\Repositories\Repository\Configuration\SettingRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;

/**
 * Clase ExecutionReportsProcess
 * @package App\Processes\Business\Reports
 */
class ExecutionReportsProcess
{
    /**
     * @var ExecutionReportsRepository
     */
    private $executionReportsRepository;

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
     * @var DashboardRepository
     */
    private $dashboardRepository;

    /**
     * Constructor de ExecutionReportsProcess.
     *
     * @param ExecutionReportsRepository $executionReportsRepository
     * @param PlanRepository $planRepository
     * @param FiscalYearRepository $fiscalYearRepository
     * @param SettingRepository $settingRepository
     * @param ProjectFiscalYearRepository $projectFiscalYearRepository
     * @param DashboardRepository $dashboardRepository
     */
    public function __construct(
        ExecutionReportsRepository $executionReportsRepository,
        PlanRepository $planRepository,
        FiscalYearRepository $fiscalYearRepository,
        SettingRepository $settingRepository,
        ProjectFiscalYearRepository $projectFiscalYearRepository,
        DashboardRepository $dashboardRepository
    ) {
        $this->executionReportsRepository = $executionReportsRepository;
        $this->planRepository = $planRepository;
        $this->fiscalYearRepository = $fiscalYearRepository;
        $this->settingRepository = $settingRepository;
        $this->projectFiscalYearRepository = $projectFiscalYearRepository;
        $this->dashboardRepository = $dashboardRepository;
    }

    /**
     * Carga los datos necesarios para la vista del reporte de avance físico.
     *
     * @throws Exception
     */
    public function physicalAdvanceIndex()
    {
        $currentFiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        if (!$currentFiscalYear) {
            throw new Exception(trans('app.messages.exceptions.no_current_fiscal_year_info'), 1000);
        }

        $fiscalYears = $this->fiscalYearRepository->all();
        $gad = $this->settingRepository->findByKey('gad');

        return [
            'fiscalYears' => $fiscalYears,
            'currentFiscalYear' => $this->fiscalYearRepository->findCurrentFiscalYear(),
            'gad' => $gad->value
        ];
    }

    /**
     * Carga la información para la tabla del reporte de avance físico.
     *
     * @param int $fiscalYearId
     *
     * @return mixed
     * @throws Exception
     */
    public function physicalAdvanceData(int $fiscalYearId)
    {

        $plans = $this->planRepository->getPlans(Plan::TYPE_PEI);

        if (!$plans) {
            throw  new Exception(trans('plans.messages.exceptions.not_found'), 1000);
        }

        if (empty($plans->all())) {
            throw  new Exception(trans('reports.exceptions.not_links'), 1000);
        }

        $pei = $plans->first();

        $planStructure = $this->executionReportsRepository->getPEIStructure($pei, $fiscalYearId);
        $data = $this->createPEIStructure($planStructure->planElements);

        return DataTables::of($data)
            ->editColumn('type', function (Model $entity) {
                if ($entity instanceof PlanElement) {
                    $type = trans('plan_elements.labels.' . $entity->type);
                } else {
                    if ($entity instanceof ProjectFiscalYear) {
                        $type = trans('plan_elements.labels.PROJECT');
                    } else {
                        if ($entity instanceof ActivityProjectFiscalYear) {
                            $type = trans('activities.labels.activity');
                        } else {
                            $type = '';
                        }
                    }
                }

                return $type;
            })
            ->editColumn('code', function (Model $entity) {
                if ($entity instanceof PlanElement) {
                    if (isset($entity->parent)) {
                        $parent = $entity->parent;
                        if (isset($parent->parent)) {
                            $grandParent = $parent->parent;
                            $code = $grandParent->code . '.' . $parent->code . '.' . $entity->code;
                        } else {
                            $code = $parent->code . '.' . $entity->code;
                        }
                    } else {
                        $code = $entity->code;
                    }
                } else {
                    if ($entity instanceof ProjectFiscalYear) {
                        $project = $entity->project;
                        $code = $project->full_cup;
                    } else {
                        if ($entity instanceof ActivityProjectFiscalYear) {
                            $project = $entity->component->project;
                            $code = $project->full_cup . '.' . $entity->code;
                        } else {
                            $code = '';
                        }
                    }
                }

                return $code;
            })
            ->editColumn('description', function (Model $entity) {
                if ($entity instanceof PlanElement) {
                    $description = $entity->description;
                } else {
                    if ($entity instanceof ProjectFiscalYear) {
                        $description = $entity->project->description;
                    } else {
                        if ($entity instanceof ActivityProjectFiscalYear) {
                            $description = $entity->name;
                        } else {
                            $description = '';
                        }
                    }
                }

                return $description;
            })
            ->editColumn('completion', function (Model $entity) {
                if ($entity instanceof PlanElement) {
                    $completion = $entity->progress;
                } else {
                    if ($entity instanceof ProjectFiscalYear) {
                        $completion = $entity->getProgress();
                    } else {
                        if ($entity instanceof ActivityProjectFiscalYear) {
                            $completion = $entity->getProgress();
                        } else {
                            $completion = '0';
                        }
                    }
                }

                return number_format($completion, 2) . ' %';
            })
            ->make(true);
    }

    /**
     * Calcula el progreso a partir de subprograma.
     *
     * @param Collection $elements
     *
     * @return Collection
     */
    public function calculateProgress(Collection $elements)
    {

        if ($elements->isNotEmpty()) {
            $elements->each(function ($objective) {
                $objective->progress = 0;
                if ($objective->children->isNotEmpty()) {

                    $objective->children->each(function (PlanElement $program) use ($objective) {
                        $program->progress = 0;
                        if ($program->children->isNotEmpty()) {

                            $program->children->each(function (PlanElement $subprogram) use ($program) {
                                $subprogram->progress = 0;
                                if ($subprogram->projects->isNotEmpty()) {

                                    $subprogram->projects->each(function (Project $project) use ($subprogram) {

                                        if ($project->getProjectFiscalYears->isNotEmpty()) {
                                            $project->getProjectFiscalYears->each(function (ProjectFiscalYear $projectFiscalYear) use ($subprogram) {
                                                $subprogram->progress += $projectFiscalYear->getProgress();
                                            });
                                            //$subprogram->progress /=  $project->getProjectFiscalYears->count();
                                        }
                                    });

                                    $subprogram->progress /= $subprogram->projects->count();
                                }

                                $program->progress += $subprogram->progress;
                            });
                            $program->progress /= $program->children->count();
                        }

                        $objective->progress += $program->progress;
                    });
                    $objective->progress /= $objective->children->count();
                }
            });
        }

        return $elements;
    }

    /**
     * Crea la estructura del PEI.
     *
     * @param Collection $elements
     *
     * @return Collection
     */
    public function createPEIStructure(Collection $elements)
    {
        $data = collect([]);

        $objectives = $this->calculateProgress($elements);

        $objectives->each(function ($objective) use ($data) {
            $data->push($objective);
            if ($objective->children->isNotEmpty()) {
                $objective->children->each(function (PlanElement $program) use ($data) {
                    $data->push($program);
                    if ($program->children->isNotEmpty()) {
                        $program->children->each(function (PlanElement $subprogram) use ($data) {
                            $data->push($subprogram);
                            if ($subprogram->projects->isNotEmpty()) {
                                $subprogram->projects->each(function (Project $project) use ($data) {
                                    if ($project->getProjectFiscalYears->isNotEmpty()) {
                                        $project->getProjectFiscalYears->each(function (ProjectFiscalYear $projectFiscalYear) use ($data) {
                                            $data->push($projectFiscalYear);
                                            if ($projectFiscalYear->activitiesProjectFiscalYear->isNotEmpty()) {
                                                $projectFiscalYear->activitiesProjectFiscalYear->each(function (ActivityProjectFiscalYear $activityFiscalYear) use ($data) {
                                                    $data->push($activityFiscalYear);
                                                });
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            }
        });

        return $data;
    }

    /**
     * Buscar información para vista del reporte de Ingresos y Gastos por año
     *
     * @return array
     */
    public function incomesExpensesBySourceData()
    {
        $fiscalYear = $this->fiscalYearRepository->findCurrentFiscalYear();

        $date = date_format(Carbon::now(), 'Y-m-d');
        $summaryIncome = $this->dashboardRepository->totalsBudgetByType($fiscalYear->year, $date, 2);
        $summaryExpense = $this->dashboardRepository->totalsBudgetByType($fiscalYear->year, $date, 1);

        $expenseItems = $this->dashboardRepository->budgetByCategory($fiscalYear->year, $date, 0, 100, 20, 1);
        $sources = $this->dashboardRepository->budgetByCategory($fiscalYear->year, $date, 12, 3, 5, 2);

        $sources = $sources->map(function ($source) use ($expenseItems) {
            $items = $expenseItems->filter(function ($value, $key) use ($source) {
                return substr($value->codigo, 57, 3) == $source->codigo;
            });

            if (!$items) {
                $source->totalExpenses = 0.00;
                return $source;
            }
            $source->totalExpenses = $items->sum('codificado');
            $source->diff = round($source->codificado, 2) - round($source->totalExpenses, 2);
            $source->budgetItems = $items;
            return $source;
        });

        return [
            'sources' => $sources,
            'incomes' => $summaryIncome[0]->codificado ?? 0.00,
            'expenses' => $summaryExpense[0]->codificado ?? 0.00,
        ];
    }
}
