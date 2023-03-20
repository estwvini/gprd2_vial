@inject('Task', '\App\Models\Business\Task')
<table class="table physical_planning" id="tasks_tb">
    <thead style="color: #FFFFFF; background-color: rgba(15,127,13,0.67)">
    <tr>
        <th colspan="7">
            {{ trans('reports.project_activities_poa.physical_planning') }}
        </th>
    </tr>
    <tr>
        <th class="w-20">
            {{ trans('reports.project_activities_poa.name') }}
        </th>
        <th>
            {{ trans('reports.project_activities_poa.type') }}
        </th>
        <th>
            {{ trans('reports.project_activities_poa.date_init') }}
        </th>
        <th>
            {{ trans('reports.project_activities_poa.date_end') }}
        </th>
        <th>
            {{ trans('reports.project_activities_poa.duration') }}
        </th>
        <th>
            {{ trans('reports.project_activities_poa.responsible') }}
        </th>
        <th>
            {{ trans('reports.project_activities_poa.percentage') }}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($tasks as $task)
        <tr>
            <td>{{ $task->name }}</td>
            <td>
                @if($task->type === $Task::ELEMENT_TYPE['TASK'])
                    {{ trans('reports.project_activities_poa.task') }}
                @else
                    {{ trans('reports.project_activities_poa.milestone') }}
                @endif

            </td>
            <td>{{ $task->date_init ? \Carbon\Carbon::parse($task->date_init)->format('d-m-Y') : trans('reports.project_activities_poa.notApply') }}</td>
            <td>{{ $task->date_end ? \Carbon\Carbon::parse($task->date_end)->format('d-m-Y') : trans('reports.project_activities_poa.notApply') }}</td>
            <td class="text-center">{{ $task->duration ?? trans('schedule.labels.notApply') }}</td>
            <td>{{ $task->responsible->count() ? $task->responsible->first()->fullName() : '' }}</td>
            <td class="text-center">{{ number_format((float)$task->weight_percentage, 2, '.', '') }}%</td>
        </tr>
    @endforeach
    </tbody>
</table>