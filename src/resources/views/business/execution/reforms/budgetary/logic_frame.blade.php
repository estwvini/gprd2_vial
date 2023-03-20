@permission('modify.logic_frame.reforms.reforms_reprogramming.execution')
@inject('Project', '\App\Models\Business\Project')
<div>
    @include('business.planning.projects.logic_frame.logic_frame', [
    'url' => route('update.modify.logic_frame.reforms.reforms_reprogramming.execution', ['id' => $entity->id]),
    'urlBack' => route('index.budgetary.reforms.reforms_reprogramming.execution'),
    'urlEditComponent' => 'edit.components.logic_frame.reforms.reforms_reprogramming.execution',
    'urlShowComponent' => 'show.components.logic_frame.reforms.reforms_reprogramming.execution',
     'urlShowFullIndicator' => 'show.full_indicator.logic_frame.reforms.reforms_reprogramming.execution',
    'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.reforms.reforms_reprogramming.execution',
    'addOrDelete' => 0,
    'structureModule' => 0,
    'module' => $Project::MODULE_REFORM
    ])
</div>

@else
    @include('errors.403')
    @endpermission