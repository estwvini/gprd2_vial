@permission('project.reprogramming.reforms_reprogramming.execution')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('reprogramming.title') }}
                <small>{{ trans('reprogramming.labels.physical') }}</small>
            </h3>
        </div>

        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.reprogramming.reforms_reprogramming.execution')
                <li>
                    <a class="ajaxify" href="{{ route('index.reprogramming.reforms_reprogramming.execution') }}"> {{ trans('reprogramming.labels.list') }}</a>
                </li>
                @endpermission

                <li class="active"> {{ trans('reprogramming.labels.project') }}</li>
            </ol>
        </div>

    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('status.reprogramming.reforms_reprogramming.execution', ['id' => $reprogrammingId]) }}" class="btn btn-success ajaxify pull-right">
                <i class="fa fa-check"></i> {{ trans('reprogramming.labels.finish') }}
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div role="tabpanel">
                <ul class="nav nav-tabs bar_tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#physical-planning" role="tab" id="budget-planning-tab" data-toggle="tab" aria-expanded="false">
                            {{ trans('reprogramming.labels.physical_planning') }}</a>
                    </li>
                    @if(api_available())
                        <li role="presentation">
                            <a href="#budget-planning" id="budget-planning-tab" role="tab" data-toggle="tab"
                               aria-expanded="true">{{ trans('reprogramming.labels.budget_planning') }}</a>
                        </li>
                    @endif
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
                    <div role="tabpanel" class="tab-pane fade active in" id="physical-planning" aria-labelledby="physical-planning-tab">
                        @include('business.execution.reprogramming.project.schedule')
                    </div>
                    @if(api_available())
                        <div role="tabpanel" class="tab-pane fade" id="budget-planning" aria-labelledby="budget-planning-tab">
                            @include('business.execution.reprogramming.project.budget_planning')
                        </div>
                    @endif
                    <div role="tabpanel" class="tab-pane fade" id="logic-frame-planning" aria-labelledby="logic-frame-planning-tab">
                        @include('business.execution.reprogramming.project.logic_frame')
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="project-profile-planning" aria-labelledby="project-profile-planning-tab">
                        @include('business.execution.reprogramming.project.profile')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@else
    @include('errors.403')
    @endpermission
