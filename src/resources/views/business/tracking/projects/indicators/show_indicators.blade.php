@permission('indicators.data.index.project_indicators.tracking')
@inject('PlanIndicator', '\App\Models\Business\PlanIndicator')
<div class="page-title">
    <div class="title_left w-100">
        <h3>{{ trans('indicator_tracking.title_projects_tracking') }}</h3>
    </div>
</div>
<div class="clearfix"></div>

<div class="title_left">
    <div class="row">
        <div class="col-md-6">
            <div class="col-md-1 p-0">
                <i id="backButton" role="button" page="1"
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
        <div class="col-md-6">
            <div class="col-md-4 p-0">
                <h6>{{ trans('indicator_tracking.labels.select_year') }}</h6>
            </div>
            <div class="col-md-8 p-0">
                @if(count($years))
                    <select class="form-control select2" id="years" name="years">
                        @foreach($years as $year)
                            <option value="{{ $year }}" @if($year == $selectedYear) selected @endif>{{ $year }}</option>
                        @endforeach
                    </select>
                @endif
            </div>
        </div>
    </div>
    <div class="ln_solid m-0"></div>
</div>
@include('business.tracking.indicators_layout', [
    'backRoute' => route('index.project_indicators.tracking'),
    'type' => 'indicator_tracking',
    'elementType' => 'project'])

<script>
    $(() => {
        $('#years').select2();

        $('#years').on('change', (e) => {
            let route = '{!! route('indicators.data.index.project_indicators.tracking', ['id' => $project->id, 'year' => '__YEAR__']) !!}'
            route = route.replace('__YEAR__', $(e.currentTarget).val());
            pushRequest(route);
        })
    })
</script>

@else
    @include('errors.403')
    @endpermission