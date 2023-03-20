<table class="table report-table" id="report_poa_tb">
    <thead>
    <tr>
        <th colspan="15">
            {{ $executingUnit->code }} - {{ $executingUnit->name }} - {{ trans('reports.project_activities_poa.total') }}: ${{ number_format($data->sum('total'), 2) }}
        </th>
    </tr>
    <tr>
        <th class="w-10">
            {{ trans('reports.project_activities_poa.objective') }}
        </th>
        <th colspan="14">
        </th>
    </tr>
    </thead>
    <tbody>
    @forelse ($data as $subProgram)
        <tr>
            <td>{{ $subProgram->parent->parent->description }}</td>
            <td>
                @include('business.reports.planning.project_activity_poa.projects', ['projects' => $subProgram->projects])
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="14" class="text-center"> {{ trans('reports.project_activities_poa.no_project_info') }}</td>
        </tr>
    @endforelse
    </tbody>
</table>