<table class="table report-table" id="projects_tb">
    <thead>
    <tr>
        <th class="w-10">
            {{ trans('reports.project_activities_poa.projects') }}
        </th>
        <th class="w-10">
            {{ trans('reports.project_activities_poa.real_need') }}
        </th>
        <th class="w-10">
            {{ trans('reports.project_activities_poa.indicators') }}
        </th>
        <th class="w-10">
            {{ trans('reports.project_activities_poa.sub_total') }}
        </th>
        <th class="w-75">

        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($projects as $project)
        <tr>
            <td>{{ $project->name }}</td>
            <td>{{ $project->qualitative_benefit }}</td>
            <td>
                @foreach($project->indicators as $indicator)
                    <strong>{{ $loop->iteration }})</strong> <span class="label label-primary"> {{ trans('reports.project_activities_poa.indicator') }}:</span> {{ $indicator->name }} / <span
                            class="label label-primary"> {{ trans('reports.project_activities_poa.goal') }}:</span>
                    {{ $indicator->goal_description }} <br/><br/>
                @endforeach
            </td>
            <td>
                {{ number_format($project->total, 2) }}
            </td>
            <td>
                @includeWhen((isset($project->getProjectFiscalYears) and count($project->getProjectFiscalYears) and isset($project->getProjectFiscalYears[0])),
                        'business.reports.planning.project_activity_poa.activities', ['activities' => $project->getProjectFiscalYears[0]->activitiesProjectFiscalYear])
            </td>
        </tr>
    @endforeach
    </tbody>
</table>