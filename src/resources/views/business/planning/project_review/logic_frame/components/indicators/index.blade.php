<table class="table default-table" id="indicator_activities_tb">
    <thead>
    <tr>
        <th width="30%">{{ trans('app.headers.name') }}</th>
        <th width="10%">{{ trans('plan_indicators.labels.base_line') }}</th>
        <th width="20%">{{ trans('plan_indicators.labels.goal') }}</th>
        <th width="25%">{{ trans('plan_indicators.labels.source') }}</th>
        <th width="10%">{{ trans('app.labels.actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @if(count($indicators) > 0)
        @include('business.planning.project_review.logic_frame.components.indicators.row', ['indicators' => $indicators])
    @else
        @include('business.planning.projects.partial.empty', ['message' => trans('projects.messages.validation.table_empty_message'), 'span'=> 6])
    @endif
    </tbody>
</table>