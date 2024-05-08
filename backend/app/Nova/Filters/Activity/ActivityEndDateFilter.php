<?php

namespace App\Nova\Filters\Activity;

use Illuminate\Support\Carbon;
use Laravel\Nova\Filters\DateFilter;
use Laravel\Nova\Http\Requests\NovaRequest;

class ActivityEndDateFilter extends DateFilter
{
    /**
     * Apply the filter to the given query.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public $name = '搜尋截止日期';

    public function apply(NovaRequest $request, $query, $value)
    {
        $value = Carbon::parse($value)->format('Y-m-d');

        return $query->where('created_at', '<=', $value);
    }
}
