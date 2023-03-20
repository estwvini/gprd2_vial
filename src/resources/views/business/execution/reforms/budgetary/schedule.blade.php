@permission('index.schedule.budgetary.reforms.reforms_reprogramming.execution')
@inject('Project', '\App\Models\Business\Project')
<div>
    @include('business.planning.projects.schedule.partial', [
        'urlLoadTable' => 'load_table.index.schedule.budgetary.reforms.reforms_reprogramming.execution',
        'urlStoreSchedule' => 'store.schedule.budgetary.reforms.reforms_reprogramming.execution',
        'urlLoadGantt' => 'load_gantt.index.schedule.budgetary.reforms.reforms_reprogramming.execution',
        'reformModule' => 1,
        'module' => $Project::MODULE_REFORM
    ])
</div>

@else
    @include('errors.403')
    @endpermission