<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class BudgetAdjustmentMiddleware
 * @package App\Http\Middleware
 */
class BudgetAdjustmentMiddleware
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
        $message = isBudgetAdjustmentCreatedForNextFiscalYear();

        if ($message) {
            return response()->json(['message' => $message]);
        }

        return $next($request);
    }
}
