<table class="table default-table" id="component_tb">
    <thead>
    <tr>
        <th width="30%">{{ trans('app.headers.name') }}</th>
        <th width="45%">{{ trans('projects.labels.assumptions') }}</th>
        <th width="15%">{{ trans('app.labels.actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @if(count($components) > 0)
        @include('business.planning.project_review.logic_frame.components.row', ['components' => $components, 'structureModule' => 0])
    @else
        @include('business.planning.project_review.partial.empty', ['message' => trans('projects.messages.validation.table_empty_message'), 'span'=> 4])
    @endif
    </tbody>
</table>
