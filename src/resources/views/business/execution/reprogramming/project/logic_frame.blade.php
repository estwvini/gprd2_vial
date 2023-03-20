@permission('modify.logic_frame.project.reprogramming.reforms_reprogramming.execution')
@inject('Project', '\App\Models\Business\Project')
<div>
    @include('business.planning.projects.logic_frame.logic_frame', [
    'url' => route('update.modify.logic_frame.project.reprogramming.reforms_reprogramming.execution', ['id' => $entity->id]),
    'urlBack' => route('index.reprogramming.reforms_reprogramming.execution'),
    'urlCreateComponent' => route('create.components.logic_frame.project.reprogramming.reforms_reprogramming.execution', ['projectId' => $entity->id]),
    'urlEditComponent' => 'edit.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
    'urlShowComponent' => 'show.components.logic_frame.project.reprogramming.reforms_reprogramming.execution',
    'addOrDelete' => 1,
    'structureModule' => 0,
    'module' => $Project::MODULE_REPROGRAMMING
    ])
</div>

@else
    @include('errors.403')
    @endpermission