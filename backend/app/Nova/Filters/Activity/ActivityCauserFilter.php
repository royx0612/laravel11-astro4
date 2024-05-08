<?php

namespace App\Nova\Filters\Activity;

use App\Models\User;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\Activitylog\Models\Activity;

class ActivityCauserFilter extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $component = 'select-filter';
    public $name = '操作者';
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
        return $query;
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
        // 取得 Activity 所有不重複的 causer id
        $causerIds = Activity::query()
            ->select('causer_id')
            ->distinct()
            ->get();

        // format $activities to array, key is causer_id, value is causer_name
        $options = [];
        User::whereIn('id', $causerIds->pluck('causer_id')->toArray())->get()->each(function ($user) use (&$options) {
            $options[$user->id] = $this->displayName($user);
        });
        return $options;
    }

    private function displayName(User $user)
    {
        return sprintf('%s(%s)', $user->name ?? '<未命名>', $user->email ?? $user->id);
    }
}
