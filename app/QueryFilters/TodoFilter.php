<?php

namespace App\QueryFilters;

class TodoFilter
{
    public function handle($request, \Closure $next)
    {
        if (! request()->has('todo')) {
            return $next($request);
        }

        return $next($request)->where('todo', 'LIKE', '%'.request()->input('todo').'%');
    }
}
