<table class="table report-table" id="poa_tb">
    <thead>
    <tr>
        <th>{{ trans('reports.ongoing_projects.project_name') }}</th>
        <th>{{ trans('reports.ongoing_projects.years') }}</th>
        <th>{{ trans('reports.ongoing_projects.amount_executed') }}</th>
        <th>{{ trans('reports.ongoing_projects.amount_not_executed') }}</th>
        <th>{{ trans('reports.ongoing_projects.percent') }}</th>
    </tr>
    </thead>
    @foreach($rows as $entity)
        <tr>
            <td>{{ $entity->name }}</td>
            <td>{{ $entity->year }}</td>
            <td>{{ $entity->executed }}</td>
            <td>{{ $entity->not_executed }}</td>
            <td>{{ $entity->percent }}</td>
        </tr>
    @endforeach
</table>