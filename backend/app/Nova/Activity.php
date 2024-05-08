<?php

namespace App\Nova;

use App\Nova\Filters\Activity\ActivityCauserFilter;
use App\Nova\Filters\Activity\ActivityEndDateFilter;
use App\Nova\Filters\Activity\ActivityLogFilter;
use App\Nova\Filters\Activity\ActivityStartDateFilter;
use Bolechen\NovaActivitylog\Resources\Activitylog;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Activity extends Activitylog
{
    public static $search = [
        'log_name', 'description', 'subject_id', 'subject_type', 'causer_id', 'properties',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make(__('Log Name'), 'log_name')->sortable(),
            Text::make(__('Description'), 'description')->sortable(),
            Text::make(__('Subject Type'), 'subject_type')->sortable(),
            Text::make(__('Subject Id'), 'subject_id')->sortable(),
            MorphTo::make(__('Causer'), 'causer')->sortable(),
            Text::make(__('Causer Ip'), 'properties->ip')->sortable(),

            Code::make(__('Properties'), 'properties')->json(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            DateTime::make(__('Created At'), 'created_at')->sortable(),
        ];
    }

    public function filters(NovaRequest $request)
    {
        return [
            new ActivityLogFilter(),
            new ActivityCauserFilter(),
            new ActivityStartDateFilter(),
            new ActivityEndDateFilter(),
        ];
    }

    // customize the label
    public static function label()
    {
        return '日誌管理';
    }

    // customize the singular label
    public static function singularLabel()
    {
        return '日誌';
    }
}
