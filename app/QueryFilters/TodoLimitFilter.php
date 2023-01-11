<?php

namespace App\QueryFilters;

class TodoLimitFilter
{
    public function handle($request, \Closure $next)
    {
        if (! request()->has('limit')) {
            return $next($request);
        }

        return $next($request)->limit(request()->input('limit'));
    }
}
