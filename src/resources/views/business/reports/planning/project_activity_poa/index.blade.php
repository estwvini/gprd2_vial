@permission('index.projects_activities.reports')
@inject('Plan', '\App\Models\Business\Plan')
<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('app.labels.reports') }}</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-list-alt"></i> {{ trans('reports.project_activities_poa.title') }}
                    </h2>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <h6>{{ trans('reports.project_activities_poa.executing_unit') }}</h6>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <select class="form-control select2 mb-1" id="executing_unit">
                                <option value="0">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>
                                @foreach($executingUnits as $unit)
                                    <option value="{{ $unit->id }}">
                                        {{ $unit->code }} - {{ $unit->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="result">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($option === $Plan::HAS_VIEW)
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <a id="cancelLinks" href="{{ route('index.reports') }}"
                   class="btn btn-info ajaxify">{{ trans('app.labels.backward') }}
                </a>
            </div>
        </div>
    @endif
</div>

<script>
    $('#executing_unit').on('change', () => {

        let url = '{{ route('data.index.projects_activities.reports', ['executingUnitId' => '__ID__']) }}';
        url = url.replace('__ID__', $('#executing_unit').val());
        pushRequest(url, '#result', null, 'get', null, false);

    });
</script>

@else
    @include('errors.403')
    @endpermission