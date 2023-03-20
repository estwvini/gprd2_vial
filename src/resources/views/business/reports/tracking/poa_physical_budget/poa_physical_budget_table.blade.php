<table class="table report-table" id="poa_tb">
    <thead>
    <tr>
        <th>{{ trans('poa_tracking.labels.executing_unit') }}</th>
        <th>{{ trans('poa_tracking.labels.project') }}</th>
        <th>{{ trans('poa_tracking.labels.component') }}</th>
        <th>{{ trans('poa_tracking.labels.activity') }}</th>
        <th>{{ trans('poa_tracking.labels.responsible') }}</th>
        <th>{{ trans('app.headers.date_init') }}</th>
        <th>{{ trans('app.headers.date_end') }}</th>
        <th>{{ trans('poa_tracking.labels.codificado') }}</th>
        <th>{{ trans('poa_tracking.labels.por_comprometer') }}</th>
        <th>{{ trans('poa_tracking.labels.physical_progress') }}</th>
        <th>{{ trans('poa_tracking.labels.budget_progress') }}</th>
    </tr>
    </thead>
    @foreach($rows as $entity)
        <tr>
            <td>{{ $entity->department_name }}</td>
            <td>{{ $entity->project_name }}</td>
            <td>{{ $entity->component_name }}</td>
            <td>{{ $entity->name }}</td>
            <td>{{ $entity->responsible }}</td>
            <td>{{ $entity->date_init }}</td>
            <td>{{ $entity->date_end }}</td>
            <td>{{ $entity->codificado }}</td>
            <td>{{ $entity->por_comprometer }}</td>
            <td>{{ $entity->physical_progress }}</td>
            <td>{{ $entity->budget_progress }}</td>
        </tr>
    @endforeach
</table>