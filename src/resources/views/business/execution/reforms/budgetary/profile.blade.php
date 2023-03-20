@permission('edit.profile.reforms.reforms_reprogramming.execution')
@inject('Project', '\App\Models\Business\Project')
<div>
    @include('business.planning.projects.profile_partial', [
        'url' => route('update.edit.profile.reforms.reforms_reprogramming.execution', ['id' => $entity->id]),
        'urlBack' => route('index.budgetary.reforms.reforms_reprogramming.execution'),
        'structureModule' => 0,
        'module' => $Project::MODULE_REFORM
    ])
</div>

@else
    @include('errors.403')
    @endpermission