<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class RouteMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $routeName = Route::currentRouteName();

        if (!empty($routeName)) {
            if ($routeName != 'login' && $routeName != 'logout') {

                if (currentUser()->can($routeName))
                    return $next($request);
                else
                    if ($routeName != 'unauthorized') {
                        return redirect()->to('unauthorized');
                    }
            }
        }
        return $next($request);
    }
}
