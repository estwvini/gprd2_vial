@inject('Plan', 'App\Models\Business\Plan')

<div class="row">
    @if($plan_type !== $Plan::TYPE_SECTORAL)
        <div class="form-group col-md-4 col-sm-4 col-xs-12">
            <label class="control-label mt-3 col-md-2 col-sm-2 col-xs-12" for="year">
                {{ trans('indicator_tracking.labels.years') }}
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <select class="form-control select2" id="year" required name="year">
                    @foreach($years as $year)
                        <option value="{{ $year }}">
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @else
        <div class="form-group col-md-4 col-sm-4 col-xs-12">
            <label class="control-label mt-3 col-md-3 col-sm-3 col-xs-3" for="plan">
                {{ trans('indicator_tracking.labels.sectoral_plans') }}
            </label>
            <div class="col-md-8 col-sm-8 col-xs-8">
                <select class="form-control select2" id="plan" required name="plan">
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}">
                            {{ $plan->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group col-md-4 col-sm-4 col-xs-12">
            <label class="control-label mt-3 col-md-2 col-sm-2 col-xs-2" for="year">
                {{ trans('indicator_tracking.labels.years') }}
            </label>
            <div class="col-md-8 col-sm-8 col-xs-8">
                <select class="form-control select2" id="year" required name="year">
                    @foreach($years as $year)
                        <option value="{{ $year }}">
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    @endif

    @if($frequency_filter)
        <div class="item form-group col-md-4 col-sm-4 col-xs-12">
            <label class="control-label mt-3 col-md-4 col-sm-4 col-xs-12" for="frequency">
                {{ trans('indicator_tracking.labels.frequent') }}
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <select class="form-control select2" id="frequency" required name="frequency">
                    @foreach($measuringFrequencies as $key => $value)
                        <option value="{{ $key }}"> {{ $value }}</option>
                    @endforeach

                </select>
            </div>
        </div>
    @endif

    <div class="form-group col-md-2 mt-1 col-sm-2 col-xs-12">
        <button type="button" class="btn btn-success" id="btn-search">
            <i class="fa fa-search"></i> {{ trans('app.labels.search') }}
        </button>
    </div>
</div>

<script>
    $(() => {
        $('.select2').select2({});

        $('.select2').on('change', () => {
            $('#load_area').empty();
        })

        $('#plan').on('change', (e) => {
            let route = '{!! route('get_years.sectoral.indicator_progress.execution', ['id' => '__PLAN_ID__']) !!}'
            route = route.replace('__PLAN_ID__', $(e.currentTarget).val())

            pushRequest(route, null, (response) => {
                $('#year').empty()
                $.each(response, (index, value) => {
                    $('#year').append(`<option value="${value}">${value}</option>`);
                });
            }, 'get', null, false);
        })

        $('#btn-search').on('click', () => {
            let route = '{!! route($url, ['year' => '__YEAR__', 'frequency' => '__FREQUENCY__', 'type' => '__TYPE__', 'plan_type' => '__PLAN_TYPE__', 'plan_id' => '__PLAN_ID__']) !!}'

            route = route.replace('__YEAR__', $('#year').val())
            route = route.replace('__FREQUENCY__', $('#frequency').val() || '')
            route = route.replace('__TYPE__', '{{ $type }}')
            route = route.replace('__PLAN_TYPE__', '{{ isset($plan_type) ? $plan_type : '' }}')
            route = route.replace('__PLAN_ID__', $('#plan').val())

            pushRequest(route, '#load_area', null, 'GET')
        })
    })
</script>