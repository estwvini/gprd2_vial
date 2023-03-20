<?php

namespace App\Repositories\Repository\Business\Reports;

use App\Models\Business\BudgetItem;
use App\Models\Business\Plan;
use App\Models\Business\PlanElement;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\ProjectFiscalYear;
use App\Models\Business\PublicPurchase;
use App\Models\System\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

/**
 * Clase PlanningReportsRepository
 * @package App\Repositories\Repository\Business\Reports
 */
class PlanningReportsRepository
{
    /**
     * Obtener de la BD la información necesaria para el reporte PPI.
     *
     * @param array $filters
     *
     * @return ProjectFiscalYear[]|Builder[]|Collection
     */
    public function ppiReport(array $filters)
    {
        return ProjectFiscalYear::join('projects', 'projects.id', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('departments', function ($join) use ($filters) {
                $join->on('departments.id', 'projects.executing_unit_id');
                if (isset($filters['departmentId']) && $filters['departmentId']) {
                    $join->where('departments.id', $filters['departmentId']);
                }
            })
            ->when($filters['fiscalYearId'] != null, function ($query) use ($filters) {
                return $query->where('project_fiscal_years.fiscal_year_id', $filters['fiscalYearId']);
            })
            ->whereNull('projects.deleted_at')
            ->whereNull('departments.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->select('project_fiscal_years.*')
            ->with([
                'project.subprogram.parent.parent.plan',
                'project.executingUnit',
                'project.subprogram.parent.parent.indicators.parentLinks' => function ($query) {
                    $query->join('plan_elements', 'plan_elements.id', 'plan_indicators.indicatorable_id')
                        ->join('plans', 'plans.id', 'plan_elements.plan_id')
                        ->where('plans.type', Plan::TYPE_PDOT)
                        ->select('plan_indicators.*')
                        ->with(['indicatorable.parent']);
                },
                'fiscalYear'
            ])->get();
    }

    /**
     * Obtener de la BD la información necesaria para el reporte de Programación Presupuestaria.
     *
     * @param array $filters
     *
     * @return ProjectFiscalYear[]|Builder[]|Collection
     */
    public function annualBudgetPlanningReport(array $filters)
    {
        return ActivityProjectFiscalYear::join('project_fiscal_years', 'project_fiscal_years.id', 'activity_project_fiscal_years.project_fiscal_year_id')
            ->join('projects', 'projects.id', 'project_fiscal_years.project_id')
            ->join('departments', function ($join) use ($filters) {
                $join->on('departments.id', 'projects.executing_unit_id');
                if (isset($filters['departmentId']) && $filters['departmentId']) {
                    $join->where('departments.id', $filters['departmentId']);
                }
            })
            ->whereNull('projects.deleted_at')
            ->whereNull('departments.deleted_at')
            ->where('project_fiscal_years.fiscal_year_id', $filters['fiscalYearId'])
            ->orderBy('projects.id', 'asc')->orderBy('activity_project_fiscal_years.id', 'asc')
            ->select('activity_project_fiscal_years.*')
            ->with([
                'component',
                'budgetItems',
                'projectFiscalYear.project.subprogram.parent.parent.plan',
                'projectFiscalYear.project.executingUnit'
            ])->get();

    }

    /**
     * Obtener de la BD la información necesaria para el reporte de Ejecución Trimestral de Actividades.
     *
     * @param array $filters
     *
     * @return ProjectFiscalYear[]|Builder[]|Collection
     */
    public function activitiesQuarterlyExecutionReport(array $filters)
    {
        return ActivityProjectFiscalYear::join('project_fiscal_years', 'project_fiscal_years.id', 'activity_project_fiscal_years.project_fiscal_year_id')
            ->join('projects', function ($join) use ($filters) {
                $join->on('projects.id', 'project_fiscal_years.project_id');
                if (isset($filters['projectId']) && $filters['projectId']) {
                    $join->where('projects.id', $filters['projectId']);
                }
            })
            ->join('departments', function ($join) use ($filters) {
                $join->on('departments.id', 'projects.executing_unit_id');
                if (isset($filters['departmentId']) && $filters['departmentId']) {
                    $join->where('departments.id', $filters['departmentId']);
                }
            })
            ->whereNull('projects.deleted_at')
            ->whereNull('departments.deleted_at')
            ->where('project_fiscal_years.fiscal_year_id', $filters['fiscalYearId'])
            ->orderBy('projects.id', 'asc')->orderBy('activity_project_fiscal_years.id', 'asc')
            ->select('activity_project_fiscal_years.*')
            ->with([
                'component',
                'projectFiscalYear.project.subprogram.parent.parent.plan',
                'projectFiscalYear.project.executingUnit'
            ])->get();

    }

    /**
     * Obtener infomación del reporte poa
     *
     * @param int $fiscalYearId
     * @param array $filters
     *
     * @return BudgetItem[]|Builder[]|Collection
     */
    public function poaReport(int $fiscalYearId, $filters)
    {
        $items = BudgetItem::selectRaw('budget_items.*,
                           (select bp.assigned from budget_plannings bp where bp.month = 1 and bp.budget_item_id = budget_items.id) as jan,
                           (select bp.assigned from budget_plannings bp where bp.month = 2 and bp.budget_item_id = budget_items.id) as feb,
                           (select bp.assigned from budget_plannings bp where bp.month = 3 and bp.budget_item_id = budget_items.id) as mar,
                           (select bp.assigned from budget_plannings bp where bp.month = 4 and bp.budget_item_id = budget_items.id) as apr,
                           (select bp.assigned from budget_plannings bp where bp.month = 5 and bp.budget_item_id = budget_items.id) as may,
                           (select bp.assigned from budget_plannings bp where bp.month = 6 and bp.budget_item_id = budget_items.id) as jun,
                           (select bp.assigned from budget_plannings bp where bp.month = 7 and bp.budget_item_id = budget_items.id) as jul,
                           (select bp.assigned from budget_plannings bp where bp.month = 8 and bp.budget_item_id = budget_items.id) as aug,
                           (select bp.assigned from budget_plannings bp where bp.month = 9 and bp.budget_item_id = budget_items.id) as sep,
                           (select bp.assigned from budget_plannings bp where bp.month = 10 and bp.budget_item_id = budget_items.id) as oct,
                           (select bp.assigned from budget_plannings bp where bp.month = 11 and bp.budget_item_id = budget_items.id) as nov,
                           (select bp.assigned from budget_plannings bp where bp.month = 12 and bp.budget_item_id = budget_items.id) as december')
            ->join('activity_project_fiscal_years', 'budget_items.activity_project_fiscal_year_id', 'activity_project_fiscal_years.id')
            ->join('project_fiscal_years', 'project_fiscal_years.id', '=', 'activity_project_fiscal_years.project_fiscal_year_id')
            ->join('projects', 'projects.id', 'project_fiscal_years.project_id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->whereNull('activity_project_fiscal_years.deleted_at')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['project_fiscal_years.fiscal_year_id', '=', $fiscalYearId]
            ])
            ->when($filters['executing_unit'] != '0', function ($query) use ($filters) {
                return $query->where('projects.executing_unit_id', $filters['executing_unit']);
            })
            ->when($filters['project'] != '0', function ($query) use ($filters) {
                return $query->where('projects.id', $filters['project']);
            })
            ->with([
                'budgetClassifier',
                'geographicLocation',
                'source',
                'spendingGuide',
                'competence',
                'institution',
                'activityProjectFiscalYear.area',
                'activityProjectFiscalYear.projectFiscalYear',
                'activityProjectFiscalYear.component.project.executingUnit',
                'activityProjectFiscalYear.component.project.subprogram.parent'

            ]);

        return BudgetItem::selectRaw('budget_items.*,
                           (select bp.assigned from budget_plannings bp where bp.month = 1 and bp.budget_item_id = budget_items.id) as jan,
                           (select bp.assigned from budget_plannings bp where bp.month = 2 and bp.budget_item_id = budget_items.id) as feb,
                           (select bp.assigned from budget_plannings bp where bp.month = 3 and bp.budget_item_id = budget_items.id) as mar,
                           (select bp.assigned from budget_plannings bp where bp.month = 4 and bp.budget_item_id = budget_items.id) as apr,
                           (select bp.assigned from budget_plannings bp where bp.month = 5 and bp.budget_item_id = budget_items.id) as may,
                           (select bp.assigned from budget_plannings bp where bp.month = 6 and bp.budget_item_id = budget_items.id) as jun,
                           (select bp.assigned from budget_plannings bp where bp.month = 7 and bp.budget_item_id = budget_items.id) as jul,
                           (select bp.assigned from budget_plannings bp where bp.month = 8 and bp.budget_item_id = budget_items.id) as aug,
                           (select bp.assigned from budget_plannings bp where bp.month = 9 and bp.budget_item_id = budget_items.id) as sep,
                           (select bp.assigned from budget_plannings bp where bp.month = 10 and bp.budget_item_id = budget_items.id) as oct,
                           (select bp.assigned from budget_plannings bp where bp.month = 11 and bp.budget_item_id = budget_items.id) as nov,
                           (select bp.assigned from budget_plannings bp where bp.month = 12 and bp.budget_item_id = budget_items.id) as december')
            ->join('operational_activities', 'budget_items.operational_activity_id', 'operational_activities.id')
            ->join('current_expenditure_elements', 'operational_activities.current_expenditure_element_id', 'current_expenditure_elements.id')
            ->where('budget_items.fiscal_year_id', $fiscalYearId)
            ->when($filters['executing_unit'] != '0', function ($query) use ($filters) {
                return $query->where('operational_activities.executing_unit_id', $filters['executing_unit']);
            })
            ->when($filters['project'] != '0', function ($query) {
                return $query->where('budget_items.id', -1);
            })
            ->with([
                'budgetClassifier',
                'geographicLocation',
                'source',
                'spendingGuide',
                'competence',
                'institution',
                'operationalActivity.subprogram.parent.area',
                'operationalActivity.executingUnit'
            ])->union($items)
            ->get();
    }

    /**
     * Obtener infomación del reporte pac
     *
     * @param int $fiscalYearId
     *
     * @return BudgetItem[]|Builder[]|Collection
     */
    public function pacReport(int $fiscalYearId)
    {
        $operationalActivitiesPublicPurchases = PublicPurchase::join('budget_items', 'budget_items.id', 'public_purchases.budget_item_id')
            ->join('operational_activities', 'budget_items.operational_activity_id', 'operational_activities.id')
            ->join('current_expenditure_elements', 'operational_activities.current_expenditure_element_id', 'current_expenditure_elements.id')
            ->where('budget_items.fiscal_year_id', $fiscalYearId)
            ->select('public_purchases.*')
            ->with([
                'cpcClassifier',
                'procedure',
                'budgetItem.budgetClassifier',
                'budgetItem.geographicLocation',
                'budgetItem.source',
                'budgetItem.institution',
                'budgetItem.operationalActivity.subprogram.parent.area',
                'budgetItem.operationalActivity.responsibleUnit',
                'budgetItem.operationalActivity.executingUnit'
            ]);


        return PublicPurchase::join('budget_items', 'budget_items.id', 'public_purchases.budget_item_id')
            ->join('activity_project_fiscal_years', 'budget_items.activity_project_fiscal_year_id', 'activity_project_fiscal_years.id')
            ->join('project_fiscal_years', 'activity_project_fiscal_years.project_fiscal_year_id', 'project_fiscal_years.id')
            ->join('projects', 'project_fiscal_years.project_id', 'projects.id')
            ->join('plan_elements', 'plan_elements.id', '=', 'projects.plan_element_id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['budget_items.fiscal_year_id', '=', $fiscalYearId]
            ])
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->whereNull('activity_project_fiscal_years.deleted_at')
            ->select('public_purchases.*')
            ->with([
                'cpcClassifier',
                'procedure',
                'budgetItem.budgetClassifier',
                'budgetItem.geographicLocation',
                'budgetItem.source',
                'budgetItem.institution',
                'budgetItem.activityProjectFiscalYear.area',
                'budgetItem.activityProjectFiscalYear.projectFiscalYear',
                'budgetItem.activityProjectFiscalYear.component.project.responsibleUnit',
                'budgetItem.activityProjectFiscalYear.component.project.executingUnit',
                'budgetItem.activityProjectFiscalYear.component.project.subprogram.parent',
            ])
            ->union($operationalActivitiesPublicPurchases)
            ->get();
    }

    /**
     * Obtiene el usuario especificado con sus respectivas actividades y tareas.
     *
     * @param int $fiscalYearId
     * @param int $userId
     *
     * @return User
     */
    public function agreementForResultsReport(int $fiscalYearId, int $userId)
    {
        return User::where('id', $userId)->with([
            'activities' => function ($query) use ($fiscalYearId) {
                $query->join('project_fiscal_years', 'activity_project_fiscal_years.project_fiscal_year_id', 'project_fiscal_years.id')
                    ->join('fiscal_years', 'project_fiscal_years.fiscal_year_id', 'fiscal_years.id')
                    ->where('fiscal_years.id', $fiscalYearId)
                    ->select('activity_project_fiscal_years.*')->with([
                        'tasks'
                    ]);
            }
        ])->first();
    }

    /**
     * Obtiene información del reporte de proyectos y actividades POA
     *
     * @param int $fiscalYearId
     * @param int $executingUnit
     *
     * @return mixed
     */
    public function projectActivityData(int $fiscalYearId, int $executingUnit = 0)
    {
        return PlanElement::join('projects', 'projects.plan_element_id', '=', 'plan_elements.id')
            ->join('project_fiscal_years', 'project_fiscal_years.project_id', '=', 'projects.id')
            ->join('plans', 'plans.id', '=', 'plan_elements.plan_id')
            ->whereNull('projects.deleted_at')
            ->whereNull('plan_elements.deleted_at')
            ->whereNull('plans.deleted_at')
            ->where([
                ['plans.type', '=', Plan::TYPE_PEI,],
                ['plans.status', '=', Plan::STATUS_APPROVED],
                ['plan_elements.type', '=', PlanElement::TYPE_SUBPROGRAM],
                ['project_fiscal_years.fiscal_year_id', '=', $fiscalYearId]
            ])
            ->when($executingUnit != 0, function ($query) use ($executingUnit) {
                return $query->where('projects.executing_unit_id', $executingUnit);
            })
            ->with([
                    'parent.parent',
                    'projects' => function ($query) use ($fiscalYearId, $executingUnit) {
                        $query->join('project_fiscal_years', 'project_fiscal_years.project_id', '=', 'projects.id')
                            ->whereNull('projects.deleted_at')
                            ->where([
                                ['project_fiscal_years.fiscal_year_id', $fiscalYearId],
                                ['projects.executing_unit_id', $executingUnit]
                            ])
                            ->select('projects.*')
                            ->with([
                                'indicators' => function ($query) {
                                    $query->select('plan_indicators.*')->whereNull('plan_indicators.deleted_at');
                                },
                                'getProjectFiscalYears' => function ($query) use ($fiscalYearId) {
                                    $query->where('project_fiscal_years.fiscal_year_id', $fiscalYearId)
                                        ->select('project_fiscal_years.*')
                                        ->with([
                                            'activitiesProjectFiscalYear' => function ($query) {
                                                $query->whereNull('activity_project_fiscal_years.deleted_at')
                                                    ->select('activity_project_fiscal_years.*')
                                                    ->with([
                                                        'budgetItems' => function ($query) {
                                                            $query->select(DB::raw('budget_items.*,
                                                                budget_classifier_spendings.full_code, budget_classifier_spendings.title, budget_items.amount,
                                                                financing_source_classifiers.description,
                                                               (select sum(bp.assigned) from budget_plannings bp where (bp.month = 1 or bp.month = 2 or bp.month = 3)
                                                               and bp.budget_item_id = budget_items.id) as trim_1,
                                                               (select sum(bp.assigned) from budget_plannings bp where (bp.month = 4 or bp.month = 5 or bp.month = 6)
                                                               and bp.budget_item_id = budget_items.id) as trim_2,
                                                               (select sum(bp.assigned) from budget_plannings bp where (bp.month = 7 or bp.month = 8 or bp.month = 9)
                                                               and bp.budget_item_id = budget_items.id) as trim_3,
                                                               (select sum(bp.assigned) from budget_plannings bp where (bp.month = 10 or bp.month = 11 or bp.month = 12)
                                                               and bp.budget_item_id = budget_items.id) as trim_4'))
                                                                ->join('budget_classifier_spendings', 'budget_items.budget_classifier_id', '=', 'budget_classifier_spendings.id')
                                                                ->join('financing_source_classifiers', 'budget_items.financing_source_id', '=', 'financing_source_classifiers.id');
                                                        },
                                                        'tasks' => function ($query) {
                                                            $query->orderByRaw('ISNULL(date_init), date_init ASC');
                                                        },
                                                        'tasks.responsible' => function ($query) {
                                                            $query->where('active', true);
                                                        }
                                                    ]);
                                            }
                                        ]);
                                }
                            ]);
                    }
                ]
            )
            ->select('plan_elements.*')->distinct()->get();
    }
}