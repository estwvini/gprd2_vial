<table class="table report-table" id="activities_tb">
    <thead>
    <tr>
        <th class="w-20">
            {{ trans('reports.project_activities_poa.activities') }}
        </th>
        <th>

        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($activities as $activity)
        <tr>
            <td>{{ $activity->name }}</td>
            <td>
                @includeWhen(isset($activity->budgetItems), 'business.reports.planning.project_activity_poa.budget', ['items' => $activity->budgetItems])
                @includeWhen(isset($activity->tasks), 'business.reports.planning.project_activity_poa.tasks', ['tasks' => $activity->tasks])
            </td>
        </tr>
    @endforeach
    </tbody>
</table>