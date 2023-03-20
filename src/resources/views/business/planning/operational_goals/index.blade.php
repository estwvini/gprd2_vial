@permission('index.operational_goals.plans_management')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('operational_goals.title') }}
                <small>{{ trans('app.labels.planning') }}</small>
            </h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">

        @if($checkPEI)
            <div class="col-md-12 col-sm-12 col-xs-12 sidebar" id="sidebar-left">
                <div class="x_panel well-lg">
                    <div class="x_title">
                        <h2>
                            <i class="fa fa-cart-arrow-down"></i> {{ trans('operational_goals.title') . ' - ' . trans('current_expenditure.labels.fiscal_year', ['fiscalYear' => $fiscalYear]) }}
                        </h2>
                        @if(isset($replicate) && $replicate)
                            <div class="text-right pull-right d-flex">
                                <a href="{{ route('replicate.operational_goals.plans_management') }}"
                                   class="btn btn-default ajaxify">{{ trans('operational_goals.labels.replicate') }}</a>
                            </div>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div id="load-tree" class="col-lg-5 col-md-5 col-sm-5 col-xs-10 mt-3 pl-0"></div>
                        <div id="load-area" class="col-lg-7 col-md-7 col-sm-7 col-xs-10 mt-3 p-0"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 sidebar collapsed hidden" id="sidebar-right">
                <div id="budget-items-area" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
                <div id="budget-planning-area" class="col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>
            </div>
        @else
            <div class="alert alert-warning align-center" role="alert">
                {{ trans('operational_goals.messages.validations.noApprovedPEI') }}
            </div>
        @endif


    </div>

</div>

<script>
    $(() => {
        @if($checkPEI)
        // Load tree structure
        const url = '{!! route('loadstructure.operational_goals.plans_management') !!}'
        pushRequest(url, '#load-tree', null, 'GET', {'_token': '{!! csrf_token() !!}'});
        @endif
    });
</script>

@else
    @include('errors.403')
    @endpermission
