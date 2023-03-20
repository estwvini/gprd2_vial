@permission('modify.logic_frame.projects.plans_management')
@inject('Project', '\App\Models\Business\Project')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('projects.labels.logic_frame') }}
                <small>{{ trans('app.labels.planning') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                @permission('index.projects.plans_management')
                <li>
                    <a class="ajaxify" href="{{ route('index.projects.plans_management') }}"> {{ trans('projects.title') }}</a>
                </li>
                @endpermission

                <li class="active"> {{ trans('projects.labels.logic_frame') }}</li>
            </ol>
        </div>
    </div>

    @include('business.planning.projects.partial.navigation')

    @include('business.planning.projects.logic_frame.logic_frame', [
        'url' => route('update.modify.logic_frame.projects.plans_management', ['id' => $entity->id]),
        'urlBack' => route('index.projects.plans_management'),
        'urlCreateComponent' => route('create.components.logic_frame.projects.plans_management', ['projectId' => $entity->id]),
        'urlEditComponent' => 'edit.components.logic_frame.projects.plans_management',
        'urlDeleteComponent' => 'destroy.components.logic_frame.projects.plans_management',
        'urlShowComponent' => 'show.components.logic_frame.projects.plans_management',
        'urlShowFullIndicator' => 'show.full_indicator.logic_frame.projects.plans_management',
        'urlEditFullIndicator' => 'edit.full_indicator.logic_frame.projects.plans_management',
        'urlCreateFullIndicator' => 'create.full_indicator.logic_frame.projects.plans_management',
        'urlDeleteFullIndicator' => 'delete.full_indicator.logic_frame.projects.plans_management',
        'urlCreateComponentIndicator' => 'build.indicator.components.logic_frame.projects.plans_management',
        'addOrDelete' => 1,
        'structureModule' => 0,
        'module' => $Project::MODULE_PLANNING
    ])
</div>

@else
    @include('errors.403')
    @endpermission