@permission('edit.profile.projects.plans_management')
@inject('Project', '\App\Models\Business\Project')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('projects.title') }}
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

                <li class="active"> {{ trans('projects.labels.profile') }}</li>
            </ol>
        </div>
    </div>

    @include('business.planning.projects.partial.navigation')

    @include('business.planning.projects.profile_partial', [
        'url' => route('update.edit.profile.projects.plans_management', ['id' => $entity->id]),
        'urlBack' => route('index.projects.plans_management'),
        'structureModule' => 0,
        'module' => $Project::MODULE_PLANNING
    ])
</div>

@else
    @include('errors.403')
    @endpermission