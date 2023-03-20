@permission('index.schedule.project.reprogramming.reforms_reprogramming.execution')
@inject('Project', '\App\Models\Business\Project')
<div>
    @include('business.planning.projects.schedule.partial', [
        'urlLoadTable' => 'load_table.index.schedule.project.reprogramming.reforms_reprogramming.execution',
        'urlStoreSchedule' => 'store.schedule.project.reprogramming.reforms_reprogramming.execution',
        'urlLoadGantt' => 'load_gantt.index.schedule.project.reprogramming.reforms_reprogramming.execution',
        'reformModule' => 0,
        'module' => $Project::MODULE_REPROGRAMMING
    ])
</div>

@else
    @include('errors.403')
    @endpermission