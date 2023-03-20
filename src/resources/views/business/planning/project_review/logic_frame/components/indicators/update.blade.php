@permission('edit.indicator.components.logic_frame.projects.plans_management')

@inject('PlanIndicatorGoal', 'App\Models\Business\PlanIndicatorGoal')
@inject('PlanIndicator', 'App\Models\Business\PlanIndicator')

<div class="modal-content">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-money"></i> {{ trans('components.title') }}
        </h4>
    </div>
    <div class="x_content">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#tab_content1" id="home-tab" role="tab"
                       data-toggle="tab" aria-expanded="true">
                        {{ trans('plan_indicators.labels.indicator') }}
                    </a>
                </li>
                <li role="presentation" class="">
                    <a href="#tab_content2" role="tab" id="profile-tab"
                       data-toggle="tab" aria-expanded="false">
                        {{ trans('plan_indicators.labels.planned_measurements') }}
                    </a>
                </li>
            </ul>
            <div class="form-horizontal form-label-left">
                @method('PUT')
                @csrf
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>
                                            {{ trans('plan_indicators.labels.indicator') }}
                                        </h2>

                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="x_content">

                                        @csrf
                                        <input type="hidden" value="draft" name="status">
                                        <input type="hidden" value="{{ currentUser()->id }}" name="creator_user_id">

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="indicatorName">
                                                {{ trans('plan_indicators.labels.name') }}
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input name="name" id="indicatorName" maxlength="150"
                                                       class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12 disabledInputs"
                                                       value="{{ $entity->name }}"
                                                       placeholder="{{ trans('plan_indicators.placeholder.name') }}"/>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                                {{ trans('plan_indicators.labels.description') }}
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea name="description" id="description" rows="5"
                                                          class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12 vertical">{{ $entity->description }}</textarea>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="measuring_unit">
                                                {{ trans('plan_indicators.labels.measuring_unit') }}
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="disabledInputs form-control select2 select2_measuring_unit" id="measuring_unit" name="measure_unit_id">
                                                    @foreach($measuringUnits as $value)
                                                        <option value="{{ $value->id }}"
                                                                @if($entity->measuring_unit_id === $value->id) selected @endif>{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="calculation_formula">
                                                {{ trans('plan_indicators.labels.calculation_formula') }}
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea name="calculation_formula" id="calculation_formula" rows="5"
                                                          class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12 vertical">{{ $entity->calculation_formula }}</textarea>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-2">
                                                <span class="fa fa-info-circle fa-2x" data-toggle="tooltip" rel="tooltip" data-placement="right"
                                                      data-original-title="{{ trans('plan_indicators.calculation_formula_description') }}"></span>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="source">
                                                {{ trans('plan_indicators.labels.source') }}
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea name="source" id="source" rows="5"
                                                          class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12 vertical">{{ $entity->source }}</textarea>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label for="technical_file" class="control-label col-md-3 col-sm-3 col-xs-12">
                                                {{ trans('plan_indicators.labels.technical_file') }}
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="file" name="technical_file" id="technical_file"
                                                       class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12 disabledInputs"
                                                       accept="application/pdf" />
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-2">
                                                <span class="fa fa-info-circle fa-2x"
                                                      data-toggle="tooltip" rel="tooltip" data-placement="right"
                                                      title="{{ trans('plan_indicators.technical_file_description') }}"></span>
                                            </div>
                                        </div>
                                        <h2 class="page-header">
                                            {{ trans('plan_indicators.labels.goal') }}
                                        </h2>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="base_line">
                                                {{ trans('plan_indicators.labels.base_line') }}
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-10">
                                                <input type="number" name="base_line" id="base_line"
                                                       class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12 disabledInputs"
                                                       value="{{ $entity->base_line }}"
                                                       placeholder="{{ trans('plan_indicators.placeholder.base_line') }}" />
                                            </div>
                                            <div class="col-md-1 col-sm-1 col-xs-2">
                                                <span class="fa fa-info-circle fa-2x"
                                                      data-toggle="tooltip" rel="tooltip" data-placement="right"
                                                      title="{{ trans('plan_indicators.base_line_description') }}"></span>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="base_line_year">
                                                {{ trans('plan_indicators.labels.base_line_year') }}
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" name="base_line_year" id="base_line_year"
                                                       class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12 "
                                                       value="{{ $entity->base_line_year }}"
                                                       placeholder="{{ trans('plan_indicators.placeholder.base_line_year') }}"/>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="goal">
                                                {{ trans('plan_indicators.labels.goal') }}  {{ trans('plan_indicators.labels.year') }}
                                                <span>{{ $yearPlanning }}</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" name="goal" id="goal" maxlength="200"
                                                       class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12 "
                                                       value="{{ $entity->goal }}"
                                                       placeholder="{{ trans('plan_indicators.placeholder.goal') }}" />
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-2">
                                                <span class="fa fa-info-circle fa-2x"
                                                      data-toggle="tooltip" rel="tooltip" data-placement="right"
                                                      data-original-title="{{ trans('plan_indicators.goal_description') }}"></span>
                                            </div>
                                        </div>
                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="goal_description">
                                                {{ trans('plan_indicators.labels.description_goal') }}
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea name="goal_description" id="goal_description" rows="5"
                                                          class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12 vertical">{{ $entity->goal_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                        <div id="goals">
                            <div class="page-title">
                                <div class="title_left">
                                    <h2>
                                        {{ trans('plan_indicators.labels.planned_measurements') }}
                                    </h2>
                                </div>
                                <div class="title_right hidden-xs">
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_content">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                            <span>
                                            <b>{{ trans('plan_indicators.labels.measuring_unit') }}:</b>
                                                <span id="measuringUnitValue"> </span> </span>
                                                    </span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                            <span>
                                            <b>{{ trans('plan_indicators.labels.base_line') }}{{ trans('plan_indicators.labels.year') }}
                                                <span id="lineBaseYearValue"> </span> :</b>
                                                <span id="lineBaseValue" class="badge badge-warning"> </span> </span>
                                                    </span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                            <span>
                                            <b>{{ trans('plan_indicators.labels.goal') }} {{ trans('plan_indicators.labels.year') }} {{ $yearPlanning }}</span>:</b>
                                                    <span id="goalValue" class="badge badge-warning"> </span>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 mt-4">
                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">
                                                        {{ trans('plan_indicators.labels.type') }}
                                                        <span class="required text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select class="disabledInputs form-control select2 select2_type" id="type" name="type">
                                                            @foreach($types as $key => $value)
                                                                <option value="{{ $key }}"
                                                                        @if($entity->type === $key) selected @endif>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-2">
                                                        <span class="fa fa-info-circle fa-2x"
                                                              data-toggle="tooltip" rel="tooltip" data-placement="right"
                                                              data-original-title="{{ trans('plan_indicators.type_description') }}"></span>
                                                    </div>
                                                </div>
                                                <div class="item form-group" id="goal_type_div">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="goal_type">
                                                        {{ trans('plan_indicators.labels.goal_type') }}
                                                        <span class="required text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select class="disabledInputs form-control select2 select2_goal_type" id="goal_type" name="goal_type">
                                                            @foreach($goalTypes as $key => $value)
                                                                <option value="{{ $key }}" @if($entity->goal_type === $key) selected @endif>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 col-xs-2">
                                                        <span class="fa fa-info-circle fa-2x"
                                                              data-toggle="tooltip" rel="tooltip" data-placement="right"
                                                              data-original-title="{{ trans('plan_indicators.goal_type_description') }}"></span>
                                                    </div>
                                                </div>
                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="measurement_frequency_per_year">
                                                        {{ trans('plan_indicators.labels.measurement_frequency_per_year') }}
                                                        <span class="required text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select class="disabledInputs form-control select2 select2_frequency" id="measurement_frequency_per_year"
                                                                name="measurement_frequency_per_year">
                                                            @foreach($measuringFrequencies as $key => $value)
                                                                <option value="{{ $key }}" @if($entity->measurement_frequency_per_year === $key) selected @endif>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <table border="1" align="center" id="tableDiv" hidden>
                                                <tr>
                                                    <th align="center">
                                                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                                            {{ trans('plan_indicators.labels.period') }}
                                                        </label>
                                                    </th>
                                                    <th align="center">
                                                        <label id="type1" class="control-label col-md-8 col-sm-8 col-xs-12">
                                                            {{ trans('plan_indicators.labels.discrete') }}
                                                        </label>
                                                    </th>
                                                    <th align="center">
                                                        <label id="type2" class="control-label col-md-3 col-sm-3 col-xs-12">
                                                            {{ trans('plan_indicators.labels.cumulative') }}
                                                        </label>
                                                    </th>
                                                </tr>
                                                <!-- ko foreach: rows -->
                                                <tr>
                                                    <td align="center">
                                                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                                            <span data-bind="text: a"></span>
                                                            <span class="required text-danger">*</span>
                                                        </label>
                                                    </td>
                                                    <td align="center">
                                                        <div class="col-md-6 col-sm-6 col-xs-12"
                                                             style="margin-left: 25%">
                                                            <input type="number"
                                                                   data-bind=" value: value, attr:{id: id, required:true, name:id, min: 0, readonly: enabled}"
                                                                   class="form-control col-md-7 col-sm-7 col-xs-12" placeholder="0"/>
                                                        </div>
                                                    </td>
                                                    <td align="center">
                                                        <div class="col-md-3 col-sm-3 col-xs-12"
                                                             style="margin-left:30%">
                                                            <span data-bind="text: $root.calculateValue($index)"></span>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- /ko -->
                                            </table>
                                            <table border="1" align="center" id="tableToleranceDiv" hidden>
                                                <tr>
                                                    <th align="center">
                                                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                                            {{ trans('plan_indicators.labels.period') }}
                                                        </label>
                                                    </th>
                                                    <th align="center">
                                                        <label id="type1" class="control-label col-md-8 col-sm-8 col-xs-12">
                                                            {{ trans('plan_indicators.labels.min') }}
                                                        </label>
                                                    </th>
                                                    <th align="center">
                                                        <label id="type2" class="control-label col-md-8 col-sm-8 col-xs-12">
                                                            {{ trans('plan_indicators.labels.max') }}
                                                        </label>
                                                    </th>
                                                </tr>
                                                <!-- ko foreach: rowsTolerance -->
                                                <tr>
                                                    <td align="center">
                                                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                                            <span data-bind="text: a"></span>
                                                            <span class="required text-danger">*</span>
                                                        </label>
                                                    </td>
                                                    <td align="center">
                                                        <div class="col-md-6 col-sm-6 col-xs-12"
                                                             style="margin-left: 25%">
                                                            <input type="number"
                                                                   data-bind="value: min, attr:{id: 'min' + id, required:true, readonly: enabled, name:'min' + id, min: 0}"
                                                                   class="form-control col-md-7 col-sm-7 col-xs-12" placeholder="0"/>
                                                        </div>
                                                    </td>
                                                    <td align="center">
                                                        <div class="col-md-6 col-sm-6 col-xs-12"
                                                             style="margin-left: 25%">
                                                            <input type="number"
                                                                   data-bind=" value: max, attr:{id: 'max' + id, required:true, name:'max' + id, min: 0, readonly: enabled}"
                                                                   class="form-control col-md-7 col-sm-7 col-xs-12" placeholder="0"/>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- /ko -->
                                            </table>
                                            <div class="col-md-12 col-sm-12 col-xs-12 page-header">
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4 col-sm-offset-4 mt-4">
                                                <h2 id="labelName"></h2>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-4 col-sm-offset-4 mt-2">
                                                <span>{{ trans('plan_indicators.labels.base_line') }}</span>
                                                <span id="base_lineLabel"></span>
                                                : {{ trans('plan_indicators.labels.base_line_year') }}
                                                <span id="base_line_yearLabel"></span>
                                            </div>
                                            <div class="col-md-1 col-sm-1 col-xs-12 ">
                                                <div style="writing-mode:vertical-lr; transform: rotate(180deg); text-align:center; margin-top:250%; margin-left:50%" id="measuringUnitLabel">
                                                </div>
                                            </div>
                                            <div id="chart" width="100%" height="20%" class="col-md-11 col-sm-11 col-xs-12 mt-4">
                                                <canvas id="myChart"></canvas>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12 mt-1" id="labelSource">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
    </div>
</div>

<script>
    $(() => {
        let data = {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: '{{ trans('plan_indicators.labels.bar') }}',
                    data: [],
                    backgroundColor: [
                        'rgba(255, 205, 86, 1)'
                    ],
                    borderColor: "rgba(255, 205, 86, 1)",
                    borderWidth: 1
                }, {
                    label: '{{ trans('plan_indicators.labels.line') }}',
                    type: "line",
                    borderColor: "#3e95cd",
                    data: [],
                    fill: false
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMax: 0
                        },
                        gridLines: {
                            display: false
                        }
                    }],
                    xAxes: [{
                        barPercentage: 0.3,
                        gridLines: {
                            display: false
                        }
                    }]
                }, animation: {
                    duration: 1,
                    onComplete: function () {
                        let chartInstance = this.chart,
                            ctx = chartInstance.ctx;
                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function (dataset, i) {
                            let meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function (bar, index) {
                                let data = dataset.data[index];
                                ctx.fillText(data, bar._model.x, bar._model.y - 5);
                            });
                        });
                    }
                }, tooltips: {
                    enabled: false
                }
            }
        };

        let dataTolerance = {
            data: {
                labels: [],
                datasets: [{
                    label: '{{ trans('plan_indicators.labels.min') }}',
                    type: "line",
                    borderColor: "#3e95cd",
                    data: [],
                    fill: false
                }, {
                    label: '{{ trans('plan_indicators.labels.max') }}',
                    type: "line",
                    borderColor: "#3e95cd",
                    data: [],
                    fill: false
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMax: 0
                        },
                        gridLines: {
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                }, animation: {
                    duration: 1,
                    onComplete: function () {
                        let chartInstance = this.chart,
                            ctx = chartInstance.ctx;
                        ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        this.data.datasets.forEach(function (dataset, i) {
                            let meta = chartInstance.controller.getDatasetMeta(i);
                            meta.data.forEach(function (bar, index) {
                                let data = dataset.data[index];
                                ctx.fillText(data, bar._model.x, bar._model.y - 5);
                            });
                        });
                    }
                }, tooltips: {
                    enabled: false
                }
            }
        };
        $(".disabledInputs").prop('disabled', true);
        let count = {{ $entity->measurement_frequency_per_year }};

        let ctx = document.getElementById("myChart").getContext('2d');
        let myChart = new Chart(ctx, data);
        let frequency = {{ $yearPlanning }} - {{ $startYear }};
        let frequencyLiteral = {{ $startYear }};
        let goal = {{ $entity->goal }};
        let bl = 0;
        let status = '{{ $status }}';
        let maxValueY = 0;
        let indicatorableType = '{{ $indicatorable }}';

        //Función para pintar el cuadro
        let createChart = (index, value) => {

            myChart.destroy();
            myChart = new Chart(ctx, data);
            let maxSuggestedValue = 0;
            data.data.datasets[0].data[index] = value;
            maxSuggestedValue = Math.max(...data.data.datasets[0].data);
            maxSuggestedValue += (maxSuggestedValue / 10);
            data.options.scales.yAxes[0].ticks.suggestedMax = Number(maxSuggestedValue);
            myChart.chart.config.options = data.options;
            myChart.chart.config.data = data.data;
            myChart.update();

        };

        //Función para pintar la grafica de tolerancia
        let createChartToleranceMin = (index, min) => {

            myChart.destroy();
            myChart = new Chart(ctx, dataTolerance);
            let maxSuggestedValue = 0;
            let maxSuggestedValueAux = 0;
            dataTolerance.data.datasets[0].data[index] = min;
            maxSuggestedValue = Math.max(...dataTolerance.data.datasets[1].data);
            maxSuggestedValueAux = Math.max(...dataTolerance.data.datasets[0].data);
            if (maxSuggestedValueAux > maxSuggestedValue) {
                maxSuggestedValue = maxSuggestedValueAux;
            }
            maxSuggestedValue += (maxSuggestedValue / 10);
            dataTolerance.options.scales.yAxes[0].ticks.suggestedMax = Number(maxSuggestedValue);
            myChart.chart.config.options = dataTolerance.options;
            myChart.chart.config.data = dataTolerance.data;
            myChart.update();
        };

        //Función para pintar la grafica de tolerancia
        let createChartToleranceMax = (index, max) => {

            myChart.destroy();
            myChart = new Chart(ctx, dataTolerance);
            let maxSuggestedValue = 0;
            dataTolerance.data.datasets[1].data[index] = max;
            maxSuggestedValue = Math.max(...dataTolerance.data.datasets[1].data);
            maxSuggestedValue += (maxSuggestedValue / 10);
            dataTolerance.options.scales.yAxes[0].ticks.suggestedMax = Number(maxSuggestedValue);
            myChart.chart.config.options = data.options;
            myChart.chart.config.data = dataTolerance.data;
            myChart.update();
        };

        //Función para construir los datos del gráfico
        let createDataset = (frequency) => {

            let labels = [];
            let goals = [];
            backgroundColors = [];
            if (count > 1) {
                frequency /= count;
            }

            for (let i = 0; i <= frequency; i++) {

                if (count > 1) {
                    labels.push(frequencyLiteral + i + '{{ trans('plan_indicators.labels.semester1') }}');
                    labels.push(frequencyLiteral + i + '{{ trans('plan_indicators.labels.semester2') }}');
                    backgroundColors.push('rgba(255, 205, 86, 1)');
                    goals.push(0);

                } else {
                    labels.push(frequencyLiteral + i);
                }

                backgroundColors.push('rgba(255, 205, 86, 1)');
                goals.push(0);

            }
            backgroundColors.push('rgba(102, 255, 153, 255)');
            data.data.datasets[0].backgroundColor = backgroundColors;
            let goalAux = '{{ trans('plan_indicators.labels.goal') }}' + '{{ trans('plan_indicators.labels.year') }}' + '{{ $yearPlanning }}';
            labels.push(goalAux);
            goals.push(goal);

            data.data.labels = labels;
            data.data.datasets[0].data = goals;
            data.data.datasets[1].data = goals;
            createChart(0, bl);
        };

        //Función para construir los datos del gráfico de banda de tolerancia
        let createDatasetTolerance = (frequency) => {
            let labels = [];
            let min = [];
            let max = [];
            if (count > 1) {
                frequency /= count;
            }

            for (let i = 0; i <= frequency; i++) {

                if (count > 1) {
                    labels.push(frequencyLiteral + i + '{{ trans('plan_indicators.labels.semester1') }}');
                    labels.push(frequencyLiteral + i + '{{ trans('plan_indicators.labels.semester2') }}');
                    min.push(0);
                    max.push(0);
                    min.push(0);
                    max.push(0);

                } else {
                    labels.push(frequencyLiteral + i);
                }
                min.push(0);
                max.push(0);

            }
            dataTolerance.data.labels = labels;
            dataTolerance.data.datasets[0].data = min;
            dataTolerance.data.datasets[1].data = max;
            createChartToleranceMin(0, 0);
        };

        $("#measuringUnitLabel").text($("#measuring_unit option:selected").text());
        $("#measuringUnitValue").text($("#measuring_unit option:selected").text());
        $("#labelName").text($("#indicatorName").val());
        $("#base_line_yearLabel").text($("#base_line_year").val());
        $("#lineBaseYearValue").text($("#base_line_year").val());
        $("#goalValue").text($("#goal").val());
        $("#labelSource").text($("#source").val());
        $("#base_lineLabel").text($("#base_line").val());
        $("#lineBaseValue").text($("#base_line").val());

        let id = 1;
        let baseline = {{ $entity->base_line }};
        let typeIndicator = '{{ $entity->type }}';
        let goalType = '{{ $entity->goal_type }}';
        let $planIndicatorUpdateFm = $('#planIndicatorUpdateFm');

        let validator = $planIndicatorUpdateFm.validate($.extend(false, $validateDefaults, {
            rules: {
                name: {
                    required: true
                },
                description: {
                    required: true
                },
                technical_file: {},
                measuring_unit: {
                    required: true
                },
                base_line: {
                    required: true,
                    min: 0
                }, base_line_year: {
                    required: true,
                    onlyIntegers: true,
                    min: 1900,
                    max: 3000
                },
                type: {
                    required: true
                },
                measurement_frequency_per_year: {
                    required: true
                },
                'goals[]': {
                    required: true,
                    min: 0
                },
                goal_description: {
                    required: true
                },
                source: {
                    required: true
                },
                goal: {
                    required: true,
                    min: 0
                }
            },
            messages: {}
        }));

        $("#measuring_unit", $planIndicatorUpdateFm).on('change', () => {
            $("#measuringUnitLabel").text($("#measuring_unit option:selected").text());
            $("#measuringUnitValue").text($("#measuring_unit option:selected").text());
        });

        $("#measurement_frequency_per_year", $planIndicatorUpdateFm).on('change', () => {

            if ($("#measurement_frequency_per_year").val() > 0) {
                count = $("#measurement_frequency_per_year").val();
            } else {
                count = {{ $entity->measurement_frequency_per_year }};
            }
            if (typeIndicator != '{{ $PlanIndicatorGoal::getTolerance() }}') {
                $("#goal_type", $planIndicatorUpdateFm).rules("add", {
                    required: true
                });
                viewModel.rows.removeAll();
                createChart(0, 0);
                createDataset(frequency * count);
                printTable();
            } else {
                $("#goal_type", $planIndicatorUpdateFm).rules("remove", "required");
                $("#identificationVerification").val('false');

                viewModel.rowsTolerance.removeAll();
                createDatasetTolerance(frequency * count);
                createChartToleranceMin(0, 0);
                printTableTolerance();
            }

        });

        $("#goal_type", $planIndicatorUpdateFm).on('change', () => {
            goalType = $("#goal_type").val();
            if ($("#measurement_frequency_per_year").val() > 0) {
                count = $("#measurement_frequency_per_year").val();
            }
            $("#type1").text($("#goal_type option:selected").text());
            if ($("#goal_type option:selected").text() === '{{ trans('plan_indicators.labels.cumulative') }}') {
                $("#type2").text('{{ trans('plan_indicators.labels.discrete') }}');
            } else {
                $("#type2").text('{{ trans('plan_indicators.labels.cumulative') }}');
            }
            $('#tableToleranceDiv').hide();
            $('#goal_type_div').show();
            viewModel.rows.removeAll();
            createChart(0, 0);
            createDataset(frequency * count);
            printTable();
        });

        $("#type", $planIndicatorUpdateFm).on('change', () => {
            if ($("#measurement_frequency_per_year").val() > 0) {
                count = $("#measurement_frequency_per_year").val();
            }
            typeIndicator = $("#type").val();

            if (typeIndicator == '{{ $PlanIndicatorGoal::getTolerance() }}') {
                $('#goal_type_div').hide();
                $('#tableToleranceDiv').show();
                $('#tableDiv').hide();
                viewModel.rowsTolerance.removeAll();
                createChartToleranceMin(0, 0);
                createDatasetTolerance(frequency * count);
                printTableTolerance();
            } else {
                $('#goal_type_div').show();
                $('#tableToleranceDiv').hide();
                $('#tableDiv').show();
                viewModel.rows.removeAll();
                createChart(0, 0);
                createDataset(frequency * count);
                printTable();
            }

        });

        $("#indicatorName", $planIndicatorUpdateFm).focusout(() => {
            $("#labelName").text($("#indicatorName").val());
        });

        $("#source", $planIndicatorUpdateFm).focusout(() => {
            $("#labelSource").text($("#source").val());
        });

        $("#base_line", $planIndicatorUpdateFm).focusout(() => {
            $("#base_lineLabel").text($("#base_line").val());
            $("#lineBaseValue").text($("#base_line").val());
            if ($("#measurement_frequency_per_year").val() > 0) {
                count = $("#measurement_frequency_per_year").val();
            }

            baseline = Number($("#base_line").val());

        });

        $("#goal", $planIndicatorUpdateFm).focusout(() => {
            $("#goalValue").text($("#goal").val());
            if ($("#measurement_frequency_per_year").val() > 0) {
                count = $("#measurement_frequency_per_year").val();
            }

            goal = $("#goal").val();
            if (typeIndicator != '{{ $PlanIndicatorGoal::getTolerance() }}') {
                viewModel.rows.removeAll();
                createDataset(frequency * count);
                printTable();
            }
        });

        $("#base_line_year", $planIndicatorUpdateFm).focusout(() => {
            $("#base_line_yearLabel").text($("#base_line_year").val());
            $("#lineBaseYearValue").text($("#base_line_year").val());
        });

        //función para definir cada fila
        function Row(id, label, value, enabled) {
            let self = this;
            self.id = id;
            self.a = label;
            self.value = ko.observable(value);
            self.enabled = ko.observable(enabled);
        }

        //función para definir cada fila
        function RowTolerance(id, label, min, max, enabled) {
            let self = this;
            self.id = id;
            self.a = label;
            self.min = ko.observable(min);
            self.max = ko.observable(max);
            self.enabled = enabled;

            self.min.subscribe(function (value) {
                createChartToleranceMin(self.id, Number(value));
            });

            self.max.subscribe(function (value) {
                createChartToleranceMax(self.id, Number(value));

            });
        }

        let viewModel = new function () {
            let self = this;

            self.rows = ko.observableArray([]);
            self.rowsTolerance = ko.observableArray([]);

            self.addRow = (id, label, value, enabled) => {
                self.rows.push(new Row(id, label, value, enabled))
            };

            self.addRowTolerance = (id, label, min, max, enabled) => {
                self.rowsTolerance.push(new RowTolerance(id, label, min, max, enabled))
            };

            //Función para calcular cada valor según el tipo de indicador y el tipo de meta
            self.calculateValue = function (currentPos) {

                let result = baseline;
                let value = 0;
                let pos = currentPos();
                let data;
                let param = 0;

                if (self.rows().length > 0) {
                    if (pos > 0) {
                        param = Number(self.rows()[1].value());
                    }

                    for (let i = 0; i <= count * (frequency + 1); i++) {

                        if (i <= pos) {

                            data = self.rows()[i];
                            if (data.value() < 0 || data.value() == null) {
                                self.rows()[i].value(0);
                            }

                            if (!data.value() == '') {
                                value = data.value();
                            } else {
                                result = 0;
                                value = 0;
                            }

                            if (typeIndicator == '{{ $PlanIndicatorGoal::getAscending() }}') {

                                if (goalType == '{{ $PlanIndicatorGoal::getDiscrete() }}') {
                                    result += Number(value);
                                    param = result;
                                } else if (goalType == '{{ $PlanIndicatorGoal::getCumulative() }}') {
                                    param = Number(value);
                                    if (i == 0) {
                                        if (Number(value) == 0) {
                                            result = 0;
                                        } else {
                                            result = Number(value) - baseline;
                                        }
                                    } else {
                                        if (Number(value) == 0) {
                                            result = 0;
                                        } else {
                                            result = Number(value) - Number(self.rows()[i - 1].value());
                                        }
                                    }
                                }

                            } else if (typeIndicator == '{{ $PlanIndicatorGoal::getDescending() }}') {

                                if (goalType == '{{ $PlanIndicatorGoal::getDiscrete() }}') {
                                    result -= Number(value);
                                    param = result;
                                } else if (goalType == '{{ $PlanIndicatorGoal::getCumulative() }}') {
                                    param = Number(value);
                                    if (i == 0) {
                                        if (Number(value) == 0) {
                                            result = 0;
                                        } else {
                                            result = baseline - Number(value);
                                        }
                                    } else {
                                        if (Number(value) == 0) {
                                            result = 0;
                                        } else {
                                            result = Number(self.rows()[i - 1].value()) - Number(value);
                                        }
                                    }
                                }
                            } else {
                                if (goalType == '{{ $PlanIndicatorGoal::getDiscrete() }}') {
                                    result += Number(value);
                                }
                            }

                        } else {
                            break;
                        }
                    }
                }

                param = parseFloat(param).toFixed(2);
                createChart(pos, param);

                result = parseFloat(result).toFixed(2);
                return result;
            };
        };

        //función para imprimir la tabla
        let printTable = () => {

            let contAux = 0;
            let goals = [];
            let label;
            let disabled = true;

            @foreach($entity->planIndicatorGoals as $goal)
            goals.push('{{ isset($goal->goal_value) ? $goal->goal_value : 0 }}');
                    @endforeach

            for (let step = 0; step <= frequency; step++) {

                if (count > 1) {

                    label = {{ $startYear }} +step + ' {{ trans('plan_indicators.labels.semester1') }}';
                    viewModel.addRow(contAux, label, goals[contAux], disabled);
                    contAux += 1;
                    label = {{ $startYear }} +step + ' {{ trans('plan_indicators.labels.semester2') }}';
                    viewModel.addRow(contAux, label, goals[contAux], disabled);
                    contAux += 1;
                } else {
                    label = {{ $startYear }} +step;
                    viewModel.addRow(step, label, goals[step], disabled);
                }
            }
        };

        //función para imprimir la tablaTolerance
        let printTableTolerance = () => {

            let contAux = 0;
            let min = [];
            let max = [];
            let label;
            let maxValue = 0;
            let disabled = true;

            @foreach($entity->planIndicatorGoals as $goal)
            min.push('{{ isset($goal->min) ? $goal->min:0 }}');
            max.push('{{ isset($goal->max) ? $goal->max:0 }}');
            @endforeach

                dataTolerance.data.datasets[0].data = min;
            dataTolerance.data.datasets[1].data = max;

            for (let step = 0; step <= frequency; step++) {

                if (maxValue < max[step]) {
                    maxValue = max[step];
                }

                if (count > 1) {

                    label = {{ $startYear }} +step + '{{ trans('plan_indicators.labels.semester1') }}';
                    viewModel.addRowTolerance(contAux, label, min[contAux], max[contAux], disabled);
                    contAux += 1;

                    label = {{ $startYear }} +step + ' {{ trans('plan_indicators.labels.semester2') }}';
                    viewModel.addRowTolerance(contAux, label, min[contAux], max[contAux], disabled);
                    contAux += 1;
                } else {
                    label = {{ $startYear }} +step;
                    viewModel.addRowTolerance(step, label, min[step], max[step], disabled);
                }
            }
            dataTolerance.options.scales.yAxes[0].ticks.suggestedMax = (Number(maxValue) + 10);
            myChart.chart.config.options = dataTolerance.options;
        };

        if (typeIndicator == '{{ $PlanIndicatorGoal::getTolerance() }}') {

            createDatasetTolerance(frequency * count);
            printTableTolerance();

            $('#tableToleranceDiv').show();
            $('#goal_type_div').hide();
        } else {
            viewModel.rows.removeAll();
            createDataset(frequency * count);
            $('#tableDiv').show();
            printTable();
        }

        ko.applyBindings(viewModel, document.getElementById('goals'));

        ko.bindingHandlers.readOnly = {
            update: (element, valueAccessor) => {
                let value = ko.utils.unwrapObservable(valueAccessor());

                if (!value) {
                    element.setAttribute("readOnly", true);
                } else {
                    element.removeAttribute("readOnly");
                }
            }
        };

        $('#btn_cancel1').on('click', (e) => {

            if (indicatorableType == '{{ $PlanIndicator::INDICATORABLE_PROJECT }}') {
                $('#edit_area').empty();
            } else if (indicatorableType == '{{ $PlanIndicator::INDICATORABLE_COMPONENT }}') {
                $modal.modal('hide');
            } else {
                e.preventDefault();
                $('#load-area').empty();
                $('li').each((index, element) => {
                    $(element).removeClass('treeview-item-selected');
                });
                $('i').each((index, element) => {
                    $(element).removeClass('treeview-action-item-selected');
                });
            }
        });

        let processResponsePlan = (response) => {

            processResponse(response, null, () => {
                $validateDefaults.rules = {};
                $validateDefaults.messages = {};
                $('#load-area').empty();
                $('#load-tree').empty();

                const url = '{!! route('loadstructure.edit.plans.plans_management', ['id' => $planId]) !!}';
                pushRequest(url, '#load-tree', null, 'GET', {'_token': '{!! csrf_token() !!}'}, false);
            });
        }

        let processResponseProject = (response) => {
            processResponse(response, '#indicators_list', () => {
                $validateDefaults.rules = {};
                $('#edit_area').empty();
            });
        };

        let processResponseActivity = (response) => {
            processResponse(response, '#indicators_activity_list', () => {
                $validateDefaults.rules = {};
                $modal.modal('hide');
            });
        };

        $planIndicatorUpdateFm.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {

                if (indicatorableType == '{{ $PlanIndicator::INDICATORABLE_PLAN }}') {
                    processResponsePlan(response);
                } else if (indicatorableType == '{{ $PlanIndicator::INDICATORABLE_COMPONENT }}') {
                    processResponseActivity(response);
                } else {
                    processResponseProject(response);
                }
            }
        }));

    });
</script>

@else
    @include('errors.403')
    @endpermission