@permission('edit.profile.project.reprogramming.reforms_reprogramming.execution')
@inject('Project', '\App\Models\Business\Project')
<div>
    @include('business.planning.projects.profile_partial', [
        'url' => route('update.edit.profile.project.reprogramming.reforms_reprogramming.execution', ['id' => $entity->id]),
        'urlBack' => route('index.reprogramming.reforms_reprogramming.execution'),
        'structureModule' => 0,
        'module' => $Project::MODULE_REPROGRAMMING
    ])
</div>

@else
    @include('errors.403')
    @endpermission