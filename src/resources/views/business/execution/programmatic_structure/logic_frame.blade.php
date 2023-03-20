@permission('logic_frame.project.programmatic_structure.execution')
@inject('Project', '\App\Models\Business\Project')
<div>
    @include('business.planning.projects.logic_frame.logic_frame', [
        'url' => route('update.logic_frame.project.programmatic_structure.execution', ['id' => $entity->id]),
        'urlBack' => route('index.project.programmatic_structure.execution'),
        'urlCreateComponent' => route('create.components.logic_frame.project.programmatic_structure.execution', ['id' => $entity->id]),
        'urlEditComponent' => 'edit.components.logic_frame.project.programmatic_structure.execution',
        'urlShowComponent' => 'show.components.logic_frame.project.programmatic_structure.execution',
        'urlDeleteComponent' => 'destroy.components.logic_frame.project.programmatic_structure.execution',
        'addOrDelete' => 1,
        'structureModule' => 1,
        'module' => $Project::MODULE_PROGRAMMATIC_STRUCTURE
    ])
</div>

@else
    @include('errors.403')
    @endpermission