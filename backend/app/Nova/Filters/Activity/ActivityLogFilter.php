<?php

namespace App\Nova\Filters\Activity;

use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\Activitylog\Models\Activity;

class ActivityLogFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';

    public $name = '日誌類型';
    /**
     * Apply the filter to the given query.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(NovaRequest $request, $query, $value)
    {
        return $query->where('log_name', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     *
     * @return array
     */
    public function options(NovaRequest $request)
    {
        // 取得 Activity Table 的 log_name 欄位的值
        $logNames = Activity::select('log_name')
            ->distinct()
            ->get()
            ->pluck('log_name')
            ->toArray();
        return array_combine($logNames, $logNames);
    }
}
