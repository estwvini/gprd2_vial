<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div id="first_dashboard">

            @if(count($elements))
                @foreach($elements as $element)
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="x_panel tile cursor-pointer card_div"
                             id="{{ $element->id }}" title="{{ $element->name ?: $element->description }}">
                            <div class="x_title">
                                <br>
                                <h4>
                                    {{ trans($type . '.labels.' . $elementType) }}:
                                </h4>
                                <p>{{ \Illuminate\Support\Str::limit($element->name ?: $element->description, $limit = 150) }}</p>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-0">
                                    <div class="row">
                                        <div class="col-md-6 align-center card-container">
                                            <a class="btn btn-card bg-blue">
                                                <span class="badge bg-info">{{ count($element->indicators) }}</span>
                                                <i class="fa fa-slack"></i>
                                                <p>{{ trans($type . '.labels.indicators') }}</p>
                                            </a>
                                        </div>
                                        <div class="col-md-6 align-center card-container">
                                            <a class="btn btn-card bg-green">
                                                <span class="badge bg-info">{{ $element->success }}</span>
                                                <i class="fa fa-check-square"></i>
                                                <p>{{ trans($type . '.labels.success') }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 align-center card-container">
                                            <a class="btn btn-card bg-sandybrown">
                                                <span class="badge bg-info">{{ $element->warning }}</span>
                                                <i class="fa fa-warning"></i>
                                                <p>{{ trans($type . '.labels.warning') }}</p>
                                            </a>
                                        </div>
                                        <div class="col-md-6 align-center card-container">
                                            <a class="btn btn-card bg-red-300">
                                                <span class="badge bg-info">{{ $element->danger }}</span>
                                                <i class="fa fa-close"></i>
                                                <p>{{ trans($type . '.labels.danger') }}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-warning align-center" role="alert">
                    {{ trans($type . '.labels.no_data') }}
                </div>
            @endif
        </div>

        <div id="second_dashboard">
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
                        <div class="col-md-4">
                            <h6>{{ trans('indicator_tracking.labels.select_year') }}</h6>
                        </div>
                        <div class="col-md-8">
                            @if(count($years))
                                <select class="form-control" id="years" name="years">
                                    @foreach($years as $year)
                                        <option value="{{ $year }}" @if($year === $currentFiscalYear) selected @endif>{{ $year }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="ln_solid m-0"></div>
            </div>
            <div id="indicators_dashboard"></div>
        </div>
    </div>
</div>

<script>
    $(() => {

        $('#second_dashboard').hide();
        let backProjects = $('#backContainer');
        let sectoralPlans = $('#sectoralPlans');
        $('#years').select2();
        let countElement = 0;

        $('.card_div').on('click', (e) => {
            e.preventDefault();
            let elementId = e.currentTarget.attributes[1].nodeValue;
            countElement = elementId;
            if (elementId > 0) {
                let url = '{!! $route !!}';
                let elements = {!! $elements !!};

                url = url.replace('__ID__', elementId);
                url = url.replace('__YEAR__', $('#years').val());

                if (elements[elementId].indicators.length > 0) {
                    $('#first_dashboard').hide();
                    $('#second_dashboard').show();
                    if (backProjects) {
                        backProjects.hide();
                    }
                    if (sectoralPlans) {
                        sectoralPlans.hide();
                    }
                    pushRequest(url, '#indicators_dashboard');
                } else {
                    notify('{{ trans($type . '.messages.exceptions.no_indicators') }}', 'warning');
                }

            } else {
                $('#first_dashboard').show();
                $('#second_dashboard').hide();
            }
        });

        $('#backButton').on('click', () => {
            if (backProjects) {
                backProjects.show();
            }
            if (sectoralPlans) {
                sectoralPlans.show();
            }

            $('#first_dashboard').show();
            $('#second_dashboard').hide();
            countElement = 0
        });

        $('#years').on('select2:selecting', (e) => {
            let yearId = e.params.args.data.id;
            if (countElement > 0) {
                let url = '{!! $route !!}';
                url = url.replace('__ID__', countElement);
                url = url.replace('__YEAR__', yearId);
                pushRequest(url, '#indicators_dashboard');
            }
        });
    });
</script>
