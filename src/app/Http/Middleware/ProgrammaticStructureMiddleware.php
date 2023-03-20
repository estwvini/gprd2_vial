<?php

namespace App\Http\Middleware;

use App\Repositories\Repository\Business\Planning\FiscalYearRepository;
use Closure;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ProgrammaticStructureMiddleware
 * @package App\Http\Middleware
 */
class ProgrammaticStructureMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return JsonResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $message = isBudgetAdjustmentCreatedForCurrentFiscalYear();

        $fiscalYearRepository = resolve(FiscalYearRepository::class);

        $fiscalYear = $fiscalYearRepository->findCurrentFiscalYear();

        if (!$fiscalYear) {
            return response()->json([
                'message' => [
                    'type' => 'warning',
                    'text' => trans('budget_item.messages.exceptions.no_current_fiscal_year_info')
                ]
            ]);
        } else {
            if (!$message) {
                return response()->json([
                    'message' => [
                        'type' => 'warning',
                        'text' => trans('app.messages.warning.budget_adjustment_not_approved', ['year' => $fiscalYearRepository->findCurrentFiscalYear()->year])
                    ]
                ]);
            }
        }


        return $next($request);
    }
}
