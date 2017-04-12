<?php

namespace App\Http\Middleware;

use Closure;
use View;

class ApotekViewFinder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $finder = new \Illuminate\View\FileViewFinder(app()['files'], array( realpath(base_path('resources/views/apotek'))));
        View::setFinder($finder);
        View::addNamespace('Common',realpath(base_path('resources/views/common')));
        return $next($request);
    }
}
