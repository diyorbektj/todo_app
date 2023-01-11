<?php

namespace App\QueryFilters;

class TodoTagsFilter
{
    public function handle($request, \Closure $next)
    {
        if (! request()->has('tag')) {
            return $next($request);
        }

        return $next($request)->whereHas('tags', function ($query) {
            $query->where('tag', 'like', '%'.request()->input('tag').'%');
        });
    }
}
