@permission('load_table_show.schedule.projects_review.plans_management')

@inject('Activity', '\App\Models\Business\Planning\ActivityProjectFiscalYear')
@inject('Task', '\App\Models\Business\Task')

@if($projectSchedule->count())
    <table class="schedule-table" id="schedule_tb">
        <thead>
        <tr>
            <th width="25%">{{ trans('schedule.labels.task') }}</th>
            <th width="12%">{{ trans('schedule.labels.budget') }}</th>
            <th width="12%">{{ trans('schedule.labels.startDate') }}</th>
            <th width="12%">{{ trans('schedule.labels.endDate') }}</th>
            <th width="1%">{{ trans('schedule.labels.duration') }}</th>
            <th width="1%">{{ trans('schedule.labels.relevance') }}</th>
            <th width="15%">{{ trans('schedule.labels.responsible') }}</th>
            <th width="12%">{{ trans('schedule.labels.weight') }}</th>
        </tr>
        </thead>

        <tbody>

        @foreach($projectSchedule as $component)
            @if(isset($component['children']) && !empty($component['children']))
                @include('business.planning.project_review.schedule.loadComponent', ['element' => $component])
            @endif

            @if(isset($component['children']) && !empty($component['children']))
                @foreach($component['children'] as $activity)

                    @include('business.planning.project_review.schedule.loadActivity', ['element' => $activity])

                    @if(isset($activity['children']) && !empty($activity['children']))
                        @foreach($activity['children'] as $task)
                            @include('business.planning.project_review.schedule.loadTask', ['element' => $task])
                        @endforeach
                    @endif
                @endforeach
            @endif
        @endforeach

        </tbody>
    </table>
@else
    <div class="alert alert-warning align-center" role="alert">
        {{ trans('schedule.messages.warning.no_info_schedule') }}
    </div>
@endif

@else
    @include('errors.403')
    @endpermission