<?php

namespace App\Processes\Profile;

use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use Carbon\Carbon;
use Exception;

class FiscalYearProcess
{

    /**
     * @var FiscalYearRepository
     */
    private $fiscalYearRepository;

    public function __construct(FiscalYearRepository $fiscalYearRepository)
    {
        $this->fiscalYearRepository = $fiscalYearRepository;
    }

    /**
     * Devuelve listado de años fiscales
     *
     * @return array
     * @throws Exception
     */
    public function indexPlanning()
    {
        $fiscalYearPlan = $this->fiscalYearRepository->findAllFiscalYears();

        if (!$fiscalYearPlan) {
            throw new Exception(trans('budget_item.messages.exceptions.fiscal_year_not_found'), 1000);
        }

        $fiscalYearExec = [];
        foreach ($fiscalYearPlan as $year) {
            if ($year->year <= Carbon::now()->year) {
                $fiscalYearExec[] = $year;
            }
        }

        return [$fiscalYearPlan, $fiscalYearExec];
    }
}