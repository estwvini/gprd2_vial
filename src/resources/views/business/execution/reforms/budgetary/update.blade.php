@permission('index.budgetary.reforms.reforms_reprogramming.execution')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('reprogramming.title') }}
                <small>{{ $type }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.budgetary.reforms.reforms_reprogramming.execution')
                <li>
                    <a class="ajaxify" href="{{ route('index.budgetary.reforms.reforms_reprogramming.execution') }}"> {{ trans('project_tracking.labels.projects') }}</a>
                </li>
                @endpermission

                <li class="active"> {{ trans('reprogramming.title') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div role="tabpanel">
                <ul class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#budget-planning" id="budget-planning-tab" role="tab" data-toggle="tab"
                           aria-expanded="true">{{ trans('reprogramming.labels.budget_planning') }}</a>
                    </li>
                    <li role="presentation">
                        <a href="#physical-planning" role="tab" id="budget-planning-tab" data-toggle="tab" aria-expanded="false">
                            {{ trans('reprogramming.labels.physical_planning') }}</a>
                    </li>
                    <li role="presentation">
                        <a href="#logic-frame-planning" role="tab" id="logic-frame-planning-tab" data-toggle="tab"
                           aria-expanded="false">{{ trans('reprogramming.labels.logic_frame') }}</a>
                    </li>
                    <li role="presentation">
                        <a href="#project-profile-planning" role="tab" id="project-profile-planning-tab" data-toggle="tab"
                           aria-expanded="false">{{ trans('reprogramming.labels.project_profile') }}</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="budget-planning" aria-labelledby="budget-planning-tab">
                        @include('business.execution.reforms.budgetary.budget_planning')
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="physical-planning" aria-labelledby="physical-planning-tab">
                        @include('business.execution..reforms.budgetary.schedule')
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="logic-frame-planning" aria-labelledby="logic-frame-planning-tab">
                        @include('business.execution.reforms.budgetary.logic_frame', ['entity' => $entity])
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="project-profile-planning" aria-labelledby="project-profile-planning-tab">
                        @include('business.execution.reforms.budgetary.profile', [
                            'entity' => $entity,
                            'executingUnits' => $executingUnits,
                            'users' => $users,
                            'leader' => $leader
                        ])
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@else
    @include('errors.403')
    @endpermission