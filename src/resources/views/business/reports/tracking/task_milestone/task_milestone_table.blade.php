<table class="table report-table" id="poa_tb">
    <thead>
    <tr>
        <th>{{ trans('reports.task_milestone.days') }}</th>
        <th>{{ trans('reports.task_milestone.task') }}</th>
        <th>{{ trans('reports.task_milestone.responsible') }}</th>
        <th>{{ trans('reports.task_milestone.init_date') }}</th>
        <th>{{ trans('reports.task_milestone.date_end') }}</th>
        <th>{{ trans('reports.task_milestone.status') }}</th>
        <th>{{ trans('reports.task_milestone.activity') }}</th>
        <th>{{ trans('reports.task_milestone.project_name') }}</th>
        <th>{{ trans('reports.task_milestone.responsibleUnit') }}</th>
    </tr>
    </thead>
    @foreach($rows as $entity)
        <tr>
            <td>{{ $entity->days_overdue }}</td>
            <td>{{ $entity->name }}</td>
            <td>{{ $entity->responsible }}</td>
            <td>{{ $entity->date_init }}</td>
            <td>{{ $entity->date_end }}</td>
            <td>{{ $entity->reportStatus }}</td>
            <td>{{ $entity->activity }}</td>
            <td>{{ $entity->project_name }}</td>
            <td>{{ $entity->responsibleUnit }}</td>
        </tr>
    @endforeach
</table>