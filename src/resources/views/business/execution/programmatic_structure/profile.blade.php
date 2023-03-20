@permission('profile.project.programmatic_structure.execution')
@inject('Project', '\App\Models\Business\Project')
<div>
    @include('business.planning.projects.profile_partial', [
        'url' => route('update.profile.project.programmatic_structure.execution', ['id' => $entity->id]),
        'urlBack' => route('index.project.programmatic_structure.execution'),
        'urlLoadUsers' => 'loadusers.profile.project.programmatic_structure.execution',
        'structureModule' => 1,
        'module' => $Project::MODULE_PROGRAMMATIC_STRUCTURE
    ])
</div>

@else
    @include('errors.403')
    @endpermission