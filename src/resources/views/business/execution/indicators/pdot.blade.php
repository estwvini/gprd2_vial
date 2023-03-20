@permission('pdot.indicator_progress.execution')
@inject('PlanIndicator', 'App\Models\Business\PlanIndicator')
@inject('Plan', 'App\Models\Business\Plan')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('indicator_tracking.title') }}
                <small>{{ trans('app.labels.execution') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                <li class="active"> {{ trans('indicator_tracking.title_pdot') }}</li>
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
                            <i class="fa fa-tasks"></i> {{ trans('indicator_tracking.title_pdot') }}
                        </h2>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    @if($checkPDOT)
                        @include('business.execution.indicators.filters', [
                            'frequency_filter' => false,
                            'type' => $PlanIndicator::INDICATORABLE_PLAN,
                            'url' => 'data.pdot.indicator_progress.execution',
                            'plan_type' => $Plan::TYPE_PDOT
                         ])
                    @else
                        <div class="alert alert-warning align-center" role="alert">
                            {{ trans('indicator_tracking.messages.validations.noVerifiedPDOT') }}
                        </div>
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
