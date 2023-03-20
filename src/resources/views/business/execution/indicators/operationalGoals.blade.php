@permission('operational_goals.indicator_progress.execution')
@inject('PlanIndicator', 'App\Models\Business\PlanIndicator')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('indicator_tracking.title') }}
                <small>{{ trans('app.labels.execution') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                <li class="active"> {{ trans('indicator_tracking.title_operational_goals') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="col-md-11 col-sm-11 col-xs-11">
                        <h2>
                            <i class="fa fa-tasks"></i> {{ trans('indicator_tracking.title_operational_goals') }}
                        </h2>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    @if($checkPEI && $checkBudgetAdjustment)
                        @include('business.execution.indicators.filters', [
                            'frequency_filter' => true,
                            'type' => $PlanIndicator::INDICATORABLE_OPERATIONAL_GOAL,
                            'url' => 'data.operational_goals.indicator_progress.execution',
                            'plan_type' => false
                         ])
                    @else
                        @if(!$checkPEI)
                            <div class="alert alert-warning align-center" role="alert">
                                {{ trans('indicator_tracking.messages.validations.noApprovedPEI') }}
                            </div>
                        @elseif(!$checkBudgetAdjustment)
                            <div class="alert alert-warning align-center" role="alert">
                                {{ trans('indicator_tracking.messages.validations.noApprovedBudgetAdjustment') }}
                            </div>
                        @endif
                    @endif

                    <div id="load_area">
                        {{--load area for indicators progress--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@else
    @include('errors.403')
    @endpermission
