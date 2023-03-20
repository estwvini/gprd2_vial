<?php

namespace App\Repositories\Repository\Business\Reports;

use App\Models\Business\Plan;
use App\Models\Business\PlanElement;
use App\Models\Business\Planning\ActivityProjectFiscalYear;
use App\Models\Business\Planning\ProjectFiscalYear;

/**
 * Clase ExecutionReportsRepository
 * @package App\Repositories\Repository\Business\Reports
 */
class ExecutionReportsRepository
{
    /**
     * Obtiene la estructura del PEI hasta actividades.
     *
     * @param Plan $plan
     * @param int $fiscalYearId
     *
     * @return mixed
     */
    public function getPEIStructure(Plan $plan, int $fiscalYearId)
    {
        return Plan::where('plans.id', $plan->id)->with([
            'planElements' => function ($query) use ($fiscalYearId) {
                $query->where('type', PlanElement::TYPE_OBJECTIVE)->with([
                    'children' => function ($query) {
                        $query->where('type', PlanElement::TYPE_PROGRAM)
                            ->orderBy('code', 'asc');
                    },
                    'children.children' => function ($query) {
                        $query->orderBy('code', 'asc');
                    },
                    'children.children.projects' => function ($query) {
                        $query->orderBy('cup', 'asc');
                    },
                    'children.children.projects.getProjectFiscalYears' => function ($query) use ($fiscalYearId) {
                        $query->where('fiscal_year_id', $fiscalYearId)
                            ->whereNotIn('status', [ProjectFiscalYear::STATUS_REJECTED, ProjectFiscalYear::STATUS_TO_REVIEW, ProjectFiscalYear::STATUS_DRAFT]);
                    },
                    'children.children.projects.getProjectFiscalYears.activitiesProjectFiscalYear'
                ]);
                $query->orderBy('code', 'asc');
            }
        ])->first();
    }
}