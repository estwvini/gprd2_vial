@permission('index.schedule.projects.plans_management')
@inject('Project', '\App\Models\Business\Project')
<div class="page-title">
    <div class="title_left">
        <h3>{{ trans('schedule.title') }}
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
            <li class="active"> {{ trans('schedule.title') }}</li>
        </ol>
    </div>
</div>


@include('business.planning.projects.partial.navigation')

@include('business.planning.projects.schedule.partial', [
    'urlLoadTable' => 'load_table.index.schedule.projects.plans_management',
    'urlStoreSchedule' => 'store.schedule.projects.plans_management',
    'urlLoadGantt' => 'load_gantt.index.schedule.projects.plans_management',
    'reformModule' => 0,
    'module' => $Project::MODULE_PLANNING
])

@else
    @include('errors.403')
    @endpermission