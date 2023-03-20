@permission('index.project_result_pei.tracking')
<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>
                {{ trans('results_pei.title') }}
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    @include('business.tracking.base_layout', [
        'route' => route('indicator.project_result_pei.tracking', ['id' => '__ID__', 'year' => '__YEAR__']),
        'type' => 'results_pei',
        'elementType' => 'objective'])

</div>
@else
    @include('errors.403')
    @endpermission
