@inject('Project', '\App\Models\Business\Project')

<table class="table report-table" id="projects_repository_tb">
    <thead>
    <tr>
        <th>{{ trans('projects.labels.code') }}</th>
        <th>{{ trans('app.headers.name') }}</th>
        <th>{{ trans('projects.labels.executingUnit') }}</th>
        <th>{{ trans('app.headers.date_init') }}</th>
        <th>{{ trans('app.headers.date_end') }}</th>
        <th>{{ trans('projects.labels.initial_budget') }}</th>
        <th>{{ trans('projects.labels.month_duration') }}</th>
        <th>{{ trans('prioritization.labels.project_phase') }}</th>
        <th>{{ trans('projects.labels.general_status') }}</th>
        <th>{{ trans('projects.labels.road_project') }}</th>
        <th>{{ trans('projects.labels.ongoing_project') }}</th>
    </tr>
    </thead>
    @foreach($rows as $entity)
        <tr>
            <td>{{ $entity->full_cup }}</td>
            <td>{{ $entity->name }}</td>
            <td>{{ $entity->executingUnit ? $entity->executingUnit->name : '' }}</td>
            <td>{{ $entity->date_init }}</td>
            <td>{{ $entity->date_end }}</td>
            <td>{{ number_format($entity->referential_budget, 2, '.', '') }}</td>
            <td>{{ number_format($entity->month_duration, 2) }}</td>
            <td>{{ $Project::PROJECT_PHASES[$entity->phase] }}</td>
            <td>{{ trans('projects.status.' . strtolower($entity->status)) }}</td>
            <td>{{ $entity->is_road ? trans('app.labels.yes') : trans('app.labels.no') }}</td>
            <td>{{ $entity->fiscalYears->count() > 1 ? trans('reports.labels.yes') : trans('reports.labels.no') }}</td>
        </tr>
    @endforeach
</table>