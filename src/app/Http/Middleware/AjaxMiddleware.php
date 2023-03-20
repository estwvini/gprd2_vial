<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;

class AjaxMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        // exceptions paths
        $paths = [
            '/',
            'logout',
            'login',
            'assets/images',
            'confirmed_email',
            'admin',
            'filament',
        ];

        if (!$request->ajax()) {
            $except = false;
            foreach ($paths as $path) {
                if ($request->path() === $path || strpos($request->path(), $path) !== false || Str::startsWith($request->path(), $path)) {
                    $except = true;
                    break;
                }
            }
            if (!$except)
                return redirect()->route('index.app');
        }

        return $next($request);
    }
}
