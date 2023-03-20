@permission('components.data.index.project_components.tracking')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>
                {{ trans('components.title_tracking') }}
                <small>{{ trans('app.labels.tracking') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div id="backContainer" class="title_left">
        <div class="col-md-6 p-0 mb-3">
            <div class="col-md-1 p-0">
                <i id="backButtonProjects" role="button" page="1"
                   class="btn btn-default glyphicon glyphicon-arrow-left mb-0"
                   data-toggle="tooltip"
                   data-placement="top"
                   data-original-title="{{ trans('indicator_tracking.labels.return') }}">
                </i>
            </div>
            <div class="col-md-11">
                <h5>{{ trans('indicator_tracking.labels.return') }}</h5>
            </div>
        </div>
    </div>

    @include('business.tracking.base_layout', [
        'route' => route('indicators.components.data.index.project_components.tracking', ['id' => '__ID__', 'year' => '__YEAR__']),
        'type' => 'components.tracking',
        'elementType' => 'component'])

</div>

<script>
    $(() => {
        $('#backButtonProjects').on('click', () => {
            let url = '{{ route('index.project_components.tracking') }}';
            pushRequest(url);
        });
    });
</script>
@else
    @include('errors.403')
    @endpermission