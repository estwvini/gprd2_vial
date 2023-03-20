@permission('index.operational_goals.tracking')
<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>
                {{ trans('operational_goals.title') }}
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    @include('business.tracking.base_layout', [
        'route' => route('indicator.operational_goals.tracking', ['id' => '__ID__', 'year' => '__YEAR__']),
        'type' => 'operational_goals',
        'elementType' => 'objective'])

</div>
@else
    @include('errors.403')
    @endpermission
