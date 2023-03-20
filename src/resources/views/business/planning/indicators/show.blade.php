@inject('PlanIndicatorGoal', 'App\Models\Business\PlanIndicatorGoal')
@inject('PlanIndicator', 'App\Models\Business\PlanIndicator')
@inject('Plan', 'App\Models\Business\Plan')

<div class="x_panel">
    <div class="x_title">

        @if(isset($modal) && $modal)
            <h4 class="modal-title" id="myModalLabel">
                <i class="fa fa-tasks"></i>
                {{ trans('indicator_tracking.labels.details_indicator') }}: {{ $entity->name }}
            </h4>
        @endif

        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content form-horizontal form-label-left">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab"
                                                          data-toggle="tab"
                                                          aria-expanded="true">{{ trans('plan_indicators.labels.indicator') }}</a>
                </li>
                <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab"
                                                    data-toggle="tab"
                                                    aria-expanded="false">{{ trans('plan_indicators.labels.planned_measurements') }}</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="text-right col-md-3 col-sm-3 col-xs-12" for="name">
                                {{ trans('plan_indicators.labels.name') }}
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <span>{{ $entity->name }}</span>
                            </div>
                        </div>

                        <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="text-right col-md-3 col-sm-3 col-xs-12" for="description">
                                {{ trans('plan_indicators.labels.description') }}
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <span>{{ $entity->description }}</span>
                            </div>
                        </div>

                        <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="text-right col-md-3 col-sm-3 col-xs-12" for="measuring_unit">
                                {{ trans('plan_indicators.labels.measuring_unit') }}
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <span>{{ $measuringUnit }}</span>
                            </div>
                        </div>

                        <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="text-right col-md-3 col-sm-3 col-xs-12" for="calculation_formula">
                                {{ trans('plan_indicators.labels.calculation_formula') }}
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <span>{{ $entity->calculation_formula }}</span>
                            </div>
                        </div>

                        <div class="item form-group col-md-12 col-sm-12 col-xs-12">
                            <label class="text-right col-md-3 col-sm-3 col-xs-12" for="source">
                                {{ trans('plan_indicators.labels.source') }}
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <span>{{ $entity->source }}</span>
                            </div>
                        </div>

                        <h2 class="page-header">
                            {{ trans('plan_indicators.labels.goal') }}
                        </h2>

                        <div class="item form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="text-right col-md-3 col-sm-3 col-xs-12" for="base_line">
                                    {{ trans('plan_indicators.labels.base_line') }}
                                </label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <span>{{ $entity->base_line . ' ' . $entity->measureUnit->abbreviation }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="text-right col-md-3 col-sm-3 col-xs-12" for="base_line_year">
                                    {{ trans('plan_indicators.labels.base_line_year') }}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <span>{{ $entity->base_line_year }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="text-right col-md-3 col-sm-3 col-xs-12" for="goal">
                                    {{ trans('plan_indicators.labels.goal') }} {{ trans('plan_indicators.labels.year') }}
                                    <span>{{ $yearPlanning }}</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <span>{{ $entity->goal . ' ' . $entity->measureUnit->abbreviation }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <label class="text-right col-md-3 col-sm-3 col-xs-12" for="goal_description">
                                    {{ trans('plan_indicators.labels.description_goal') }}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <span>{{ $entity->goal_description }}</span>
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
                                            <b>{{ trans('plan_indicators.labels.measuring_unit') }}:</b> <span>{{ $measuringUnit }} </span> </span>

                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                            <span>
                                            <b>{{ trans('plan_indicators.labels.base_line') }}{{ trans('plan_indicators.labels.year') }} <span
                                                        id="lineBaseYearValue"> {{ $entity->base_line_year }}</span> :</b> <span
                                                        id="lineBaseValue" class="badge badge-warning"> {{ $entity->base_line }} </span> </span>

                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                            <span>
                                            <b>{{ trans('plan_indicators.labels.goal') }} {{ trans('plan_indicators.labels.year') }} {{ $yearPlanning }}</span>:</b> <span
                                                        id="goalValue" class="badge badge-warning"> {{ $entity->goal }} </span>
                                                </span>

                                            </div>

                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12 mt-4">
                                            <div class="item form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">
                                                    {{ trans('plan_indicators.labels.type') }} <span
                                                            class="required text-danger">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="disabledInputs form-control select2 select2_type" id="type" name="type">
                                                        <option value="">{{ trans('app.labels.select') }}</option>
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
                                                    {{ trans('plan_indicators.labels.goal_type') }} <span
                                                            class="required text-danger">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <select class="disabledInputs form-control select2 select2_goal_type" id="goal_type"
                                                            name="goal_type">
                                                        <option value="">{{ trans('app.labels.select') }}</option>
                                                        @foreach($goalTypes as $key => $value)
                                                            <option value="{{ $key }}"
                                                                    @if($entity->goal_type === $key) selected @endif>{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3 col-sm-3 col-xs-2">
                                                    <span class="fa fa-info-circle fa-2x"
                                                          data-toggle="tooltip" rel="tooltip" data-placement="right"
                                                          data-original-title="{{ trans('plan_indicators.goal_type_description') }}"></span>
                                                </div>
                                            </div>

                                            @if($planType != $Plan::TYPE_PDOT )
                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                           for="measurement_frequency_per_year">
                                                        {{ trans('plan_indicators.labels.measurement_frequency_per_year') }} <span
                                                                class="required text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select class="disabledInputs form-control select2 select2_frequency"
                                                                id="measurement_frequency_per_year" name="measurement_frequency_per_year">
                                                            <option value="">{{ trans('app.labels.select') }}</option>
                                                            @foreach($measuringFrequencies as $key => $value)
                                                                <option value="{{ $key }}"
                                                                        @if($entity->measurement_frequency_per_year === $key) selected @endif>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                        <table border="1" align="center" id="tableDiv" hidden>
                                            <tr>
                                                <th align="center">
                                                    <label class="control-label col-md-12 col-sm-12 col-xs-12 table-cell" for="valor">
                                                        {{ trans('plan_indicators.labels.period') }}
                                                    </label>
                                                </th>
                                                <th align="center">
                                                    <label id="type1" class="control-label col-md-8 col-sm-8 col-xs-12 table-cell"
                                                           for="valor">
                                                        {{ trans('plan_indicators.labels.discrete') }}
                                                    </label>
                                                </th>
                                                <th align="center">
                                                    <label id="type2" class="control-label col-md-3 col-sm-3 col-xs-12 table-cell" for="valor">
                                                        {{ trans('plan_indicators.labels.cumulative') }}
                                                    </label>
                                                </th>
                                            </tr>

                                            <!-- ko foreach: rows -->
                                            <tr>
                                                <td align="center">
                                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" for="valor">
                                                        <span data-bind="text: a"></span><span
                                                                class="required text-danger">*</span>
                                                    </label>
                                                </td>
                                                <td align="center">
                                                    <div class="col-md-6 col-sm-6 col-xs-12 table-cell">
                                                        <input disabled="true" type="number" data-bind=" value: value, attr:{id: id, required:true, name:id, min: 0}"
                                                               class="form-control col-md-7 col-sm-7 col-xs-12 number-input-cell"
                                                               placeholder="0"/>

                                                    </div>
                                                </td>
                                                <td align="center">
                                                    <div class="col-md-3 col-sm-3 col-xs-12 table-cell">
                                                        <span data-bind="text: $root.calculateValue($index)"></span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- /ko -->

                                        </table>

                                        <table border="1" align="center" id="tableToleranceDiv" hidden>
                                            <tr>
                                                <th align="center" class="col-md-4 col-sm-4 col-xs-4">
                                                    <label class="control-label col-md-12 col-sm-12 col-xs-12 table-cell">
                                                        {{ trans('plan_indicators.labels.period') }}
                                                    </label>
                                                </th>
                                                <th align="center" class="col-md-4 col-sm-4 col-xs-4">
                                                    <label id="type1" class="control-label col-md-12 col-sm-12 col-xs-12 table-cell">
                                                        {{ trans('plan_indicators.labels.min') }}
                                                    </label>
                                                </th>
                                                <th align="center" class="col-md-4 col-sm-4 col-xs-4">
                                                    <label id="type2" class="control-label col-md-12 col-sm-12 col-xs-12 table-cell">
                                                        {{ trans('plan_indicators.labels.max') }}
                                                    </label>
                                                </th>
                                            </tr>

                                            <!-- ko foreach: rowsTolerance -->
                                            <tr>
                                                <td align="center">
                                                    <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                                        <span data-bind="text: a"></span><span
                                                                class="required text-danger">*</span>
                                                    </label>
                                                </td>
                                                <td align="center">
                                                    <input disabled="true" type="number" data-bind="value: min, attr:{id: id, required:true, name:'min' + id, min: 0}"
                                                           class="form-control col-md-12 col-sm-12 col-xs-12 number-input-cell"
                                                           placeholder="0"/>
                                                </td>
                                                <td align="center">
                                                    <input disabled="true" type="number" data-bind=" value: max, attr:{id: id, required:true, name:'max' + id, min: 0}"
                                                           class="form-control col-md-12 col-sm-12 col-xs-12 number-input-cell"
                                                           placeholder="0"/>
                                                </td>
                                            </tr>

                                            <!-- /ko -->
                                        </table>

                                        <div class="col-md-12 col-sm-12 col-xs-12 page-header">
                                        </div>

                                        <div id="myChart" class="echart-350 col-md-11 col-sm-11 col-xs-12 mt-4">
                                        </div>

                                        <div class="row">
                                            <div class="mt-1" id="labelSource">
                                                {{ $entity->source }}
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                            <a id="btn_cancel" class="btn btn-info ajaxify">
                                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                                            </a>
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

<script>
    $(() => {
        let data = {
            title: {
                text: '',
                subtext: '',
                x: 'center'
            },
            tooltip: {trigger: 'item'},
            toolbox: {
                show: true,
                feature: {
                    saveAsImage: {
                        show: true,
                        title: '{{ trans('plan_indicators.labels.save_image') }}'
                    }
                }
            },
            xAxis: [
                {
                    splitArea: {show: true},
                    axisLabel: {
                        interval: 0,
                        rotate: 40,
                    },
                    data: []
                }
            ],
            yAxis: [
                {
                    nameTextStyle: {color: '#808285'},
                    name: ''
                }
            ],
            series: [
                {
                    name: '{{ trans('plan_indicators.labels.cumulative') }}',
                    type: 'bar',
                    barWidth: 13,
                    data: []
                },
                {
                    name: '{{ trans('plan_indicators.labels.cumulative') }}',
                    type: 'line',
                    data: []
                }
            ],
            grid: {
                x: '15%',
                x2: 0,
                y: 105,
                y2: 90
            }
        };

        let dataTolerance = {
            title: {
                text: '',
                subtext: '',
                x: 'center'
            },
            legend: {
                data: ['{{ trans('plan_indicators.labels.min') }}', '{{ trans('plan_indicators.labels.max') }}'],
                y: 65
            },
            tooltip: {trigger: 'item'},
            toolbox: {
                show: true,
                feature: {
                    saveAsImage: {
                        show: true,
                        title: '{{ trans('plan_indicators.labels.save_image') }}'
                    }
                }
            },
            xAxis: [
                {
                    splitArea: {show: true},
                    axisLabel: {
                        interval: 0,
                        rotate: 40,
                    },
                    data: []
                }
            ],
            yAxis: [
                {
                    scale: true,
                    nameTextStyle: {color: '#808285'},
                    name: '',
                    min: 0
                }
            ],
            series: [
                {
                    name: '{{ trans('plan_indicators.labels.min') }}',
                    type: 'line',
                    itemStyle: {
                        normal: {color: '#2F9DFF'}
                    },
                    data: []
                },
                {
                    name: '{{ trans('plan_indicators.labels.max') }}',
                    type: 'line',
                    itemStyle: {
                        normal: {color: '#FF912F'}
                    },
                    data: []
                }
            ],
            grid: {
                x: '15%',
                x2: 0,
                y: 105,
                y2: 90
            }
        };

        let count = 1;
        count = {{ $entity->measurement_frequency_per_year }};

        let myChart = echarts.init(document.getElementById('myChart'));
        let frequency = {{ $yearPlanning }} - {{ $startYear }};
        let frequencyLiteral = {{ $startYear }};
        let goal = {{ $entity->goal }};
        let status = '{{ $status }}';
        let indicatorableType = '{{ $indicatorable }}';

        $(".disabledInputs").prop('disabled', true);

        //Función para pintar el cuadro
        let createChart = (index, value) => {
            data.series[0].data[index].value = value;
            myChart.setOption(data);
            myChart.setOption({
                title: {
                    text: '{{ $entity->name }}',
                    subtext: '{{ trans('plan_indicators.labels.base_line') }}: ' + '{{ $entity->base_line }}' + '\n{{ trans('plan_indicators.labels.base_line_year') }}: ' + '{{ $entity->base_line_year }}'
                },
                yAxis: {name: '{{ $measuringUnit }}'}
            });
        };

        //Función para pintar la grafica de tolerancia
        let createChartToleranceMin = (index, min) => {
            dataTolerance.series[0].data[index] = min;
            myChart.setOption(dataTolerance);
            myChart.setOption({
                title: {
                    text: '{{ $entity->name }}',
                    subtext: '{{ trans('plan_indicators.labels.base_line') }}: ' + '{{ $entity->base_line }}' + '\n{{ trans('plan_indicators.labels.base_line_year') }}: ' + '{{ $entity->base_line_year }}'
                },
                yAxis: {name: '{{ $measuringUnit }}'}
            });
        };

        //Función para pintar la grafica de tolerancia
        let createChartToleranceMax = (index, max) => {
            dataTolerance.series[1].data[index] = max;
            myChart.setOption(dataTolerance);
            myChart.setOption({
                title: {
                    text: '{{ $entity->name }}',
                    subtext: '{{ trans('plan_indicators.labels.base_line') }}: ' + '{{ $entity->base_line }}' + '\n{{ trans('plan_indicators.labels.base_line_year') }}: ' + '{{ $entity->base_line_year }}'
                },
                yAxis: {name: '{{ $measuringUnit }}'}
            });
        };

        //Función para construir los datos del gráfico
        let createDataset = (frequency) => {
            let xData = [];
            let seriesData = [];

            if (count == 2) {
                frequency /= count;
            } else if (count == 4) {
                frequency=(frequency/2)+1;
            }

            for (let i = 0; i <= frequency; i++) {
                if (count == 2) {
                    xData.push(frequencyLiteral + i + ' {{ trans('plan_indicators.labels.semester1') }}');
                    xData.push(frequencyLiteral + i + ' {{ trans('plan_indicators.labels.semester2') }}');
                    seriesData.push({
                        value: 0,
                        itemStyle: {
                            normal: {color: 'rgba(255, 205, 86, 1)'}
                        }
                    });
                } else if (count == 4) {
                    xData.push(frequencyLiteral + i + ' {{ trans('plan_indicators.labels.trimester1') }}');
                    xData.push(frequencyLiteral + i + ' {{ trans('plan_indicators.labels.trimester2') }}');
                    xData.push(frequencyLiteral + i + ' {{ trans('plan_indicators.labels.trimester3') }}');
                    xData.push(frequencyLiteral + i + ' {{ trans('plan_indicators.labels.trimester4') }}');
                    seriesData.push({
                        value: 0,
                        itemStyle: {
                            normal: {color: 'rgba(255, 205, 86, 1)'}
                        }
                    });
                } else {
                    xData.push(frequencyLiteral + i);
                }
                seriesData.push({
                    value: 0,
                    itemStyle: {
                        normal: {color: 'rgba(255, 205, 86, 1)'}
                    }
                });
            }

            let goalAux = '{{ trans('plan_indicators.labels.goal') }}' + '{{ trans('plan_indicators.labels.year') }}' + '{{ $yearPlanning }}';
            xData.push(goalAux);
            seriesData.push({
                value: goal,
                itemStyle: {
                    normal: {color: 'rgba(102, 255, 153, 255)'}
                }
            });

            data.xAxis[0].data = xData;
            data.series[0].data = seriesData;
            data.series[1].data = seriesData;
            createChart(0, 0);
        };

        //Función para construir los datos del gráfico de banda de tolerancia
        let createDatasetTolerance = (frequency) => {
            let xData = [];
            let minData = [];
            let maxData = [];

            if (count == 2) {
                frequency /= count;
            } else if (count == 4) {
                frequency=(frequency/2)+1;
            }

            for (let i = 0; i <= frequency; i++) {
                if (count == 2) {
                    xData.push(frequencyLiteral + i + ' {{ trans('plan_indicators.labels.semester1') }}');
                    xData.push(frequencyLiteral + i + ' {{ trans('plan_indicators.labels.semester2') }}');
                    minData.push(0);
                    maxData.push(0);
                } else if (count == 4) {
                    xData.push(frequencyLiteral + i + ' {{ trans('plan_indicators.labels.trimester1') }}');
                    xData.push(frequencyLiteral + i + ' {{ trans('plan_indicators.labels.trimester2') }}');
                    xData.push(frequencyLiteral + i + ' {{ trans('plan_indicators.labels.trimester3') }}');
                    xData.push(frequencyLiteral + i + ' {{ trans('plan_indicators.labels.trimester4') }}');
                    minData.push(0);
                    maxData.push(0);
                } else {
                    xData.push(frequencyLiteral + i);
                }
                minData.push(0);
                maxData.push(0);
            }

            dataTolerance.xAxis[0].data = xData;
            dataTolerance.series[0].data = minData;
            dataTolerance.series[1].data = maxData;
            createChartToleranceMin(0, 0);
        };

        $('#profile-tab').on('shown.bs.tab', (e) => {
            myChart.resize();
            myChart.setOption({
                title: {
                    text: '{{ $entity->name }}',
                    subtext: '{{ trans('plan_indicators.labels.base_line') }}: ' + '{{ $entity->base_line }}' + '\n{{ trans('plan_indicators.labels.base_line_year') }}: ' + '{{ $entity->base_line_year }}'
                },
                yAxis: {name: '{{ $measuringUnit }}'}
            });
        });

        // Redimensiona el echart al cambiar de tamaño de la ventana.
        $(window).resize(() => {
            myChart.resize();
        });

        let measuringUnitSelect = $("#measuring_unit option:selected");
        $("#measuringUnitLabel").text(measuringUnitSelect.text());
        $("#measuringUnitValue").text(measuringUnitSelect.text());
        $("#base_line_yearLabel").text($("#base_line_year").val());
        $("#goalValue").text($("#goal").val());
        $("#labelSource").text($("#source").val());
        $("#base_lineLabel").text($("#base_line").val());

        let baseline = {{ $entity->base_line }};
        let typeIndicator = '{{ $entity->type }}';
        let goalType = '{{ $entity->goal_type }}';
        let $planIndicatorCreateFm = $('#planIndicatorCreateFm');

        $planIndicatorCreateFm.validate($.extend(false, $validateDefaults, {
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
                goal_type: {
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

        $("#measuring_unit", $planIndicatorCreateFm).on('change', () => {
            let measuringUnit = $("#measuring_unit option:selected").text();
            $("#measuringUnitLabel").text(measuringUnit);
            $("#measuringUnitValue").text(measuringUnit);
        });

        $("#measurement_frequency_per_year", $planIndicatorCreateFm).on('change', () => {
            let measurementFrequencyPerYear = $("#measurement_frequency_per_year").val();

            if (measurementFrequencyPerYear > 0) {
                count = measurementFrequencyPerYear;
            }

            viewModel.rows.removeAll();

            createChart(0, 0);
            createDataset(frequency * count);
            printTable();
        });

        $("#goal_type", $planIndicatorCreateFm).on('change', () => {
            goalType = $("#goal_type").val();

            let goalTypeSelect = $("#goal_type option:selected").text();
            let measurementFrequencyPerYear = $("#measurement_frequency_per_year").val();

            if (measurementFrequencyPerYear > 0) {
                count = measurementFrequencyPerYear;
            }

            $("#type1").text(goalTypeSelect);

            if (goalTypeSelect === '{{ trans('plan_indicators.labels.cumulative') }}') {
                $("#type2").text('{{ trans('plan_indicators.labels.discrete') }}');
            } else {
                $("#type2").text('{{ trans('plan_indicators.labels.cumulative') }}');
            }

            viewModel.rows.removeAll();

            createChart(0, 0);
            createDataset(frequency * count);
            printTable();
        });

        $("#type", $planIndicatorCreateFm).on('change', () => {
            let measurementFrequencyPerYear = $("#measurement_frequency_per_year").val();

            if (measurementFrequencyPerYear > 0) {
                count = measurementFrequencyPerYear;
            }

            if (typeIndicator === '{{ $PlanIndicatorGoal::getTolerance() }}') {
                $('#goal_type_div').hide();
            }

            typeIndicator = $("#type").val();
            viewModel.rows.removeAll();
            createChart(0, 0);
            createDataset(frequency * count);
            printTable();

        });

        $("#source", $planIndicatorCreateFm).focusout(() => {
            $("#labelSource").text($("#source").val());
        });

        $("#base_line", $planIndicatorCreateFm).focusout(() => {
            let baseLineSelect = $("#base_line").val();
            let measurementFrequencyPerYear = $("#measurement_frequency_per_year").val();

            $("#base_lineLabel").text(baseLineSelect);

            if (measurementFrequencyPerYear > 0) {
                count = measurementFrequencyPerYear;
            }

            viewModel.rows.removeAll();
            baseline = Number(baseLineSelect);
            printTable();
        });

        $("#goal", $planIndicatorCreateFm).focusout(() => {
            goal = $("#goal").val();
            let measurementFrequencyPerYear = $("#measurement_frequency_per_year").val();
            $("#goalValue").text(goal);
            if (measurementFrequencyPerYear > 0) {
                count = measurementFrequencyPerYear;
            }
            viewModel.rows.removeAll();
            createDataset(frequency * count);
            printTable();
        });

        $("#base_line_year", $planIndicatorCreateFm).focusout(() => {
            $("#base_line_yearLabel").text($("#base_line_year").val());
        });

        //función para definir cada fila
        function Row(id, label, value, enabled) {
            let self = this;
            self.id = id;
            self.a = label;

            if (!value) {
                self.value = ko.observable(0);
            } else {
                self.value = ko.observable(value);
            }

            self.enabled = ko.observable(enabled);
        }

        //función para definir cada fila
        function RowTolerance(id, label, min, max, enabled) {
            let self = this;
            self.id = id;
            self.a = label;

            if (!min) {
                self.min = ko.observable(0);
            } else {
                self.min = ko.observable(min);
            }

            if (!max) {
                self.max = ko.observable(0);
            } else {
                self.max = ko.observable(max);
            }

            self.enabled = enabled;
            self.styling = ko.observable('');

            self.min.subscribe((value) => {
                createChartToleranceMin(self.id, Number(value));
            });

            self.max.subscribe((value) => {
                createChartToleranceMax(self.id, Number(value));
            });
        }

        let viewModel = new function () {
            let self = this;

            self.rows = ko.observableArray([]);
            self.rowsTolerance = ko.observableArray([]);
            self.results = [];

            self.addRow = (id, label, value, enabled) => {
                self.rows.push(new Row(id, label, value, enabled))
            };

            self.addRowTolerance = (id, label, min, max, enabled) => {
                self.rowsTolerance.push(new RowTolerance(id, label, min, max, enabled))
            };

            //Función para calcular cada valor según el tipo de indicador y el tipo de meta
            self.calculateValue = function (currentPos) {
                let totalRows = self.rows().length;
                let sum = 0;
                let result;
                let row;
                let pos = currentPos();
                let value = 0;

                if (totalRows > 0 && typeIndicator !== '') {
                    //Refresh rows
                    $.each(self.rows(), (id, row) => {
                        if (id < pos) {
                            row.value();
                        }
                    });

                    row = self.rows()[pos];
                    value = row.value();

                    //Ascending
                    if (typeIndicator === '{{ $PlanIndicatorGoal::getAscending() }}') {
                        //Measure type: Discrete
                        if (goalType === '{{ $PlanIndicatorGoal::getDiscrete() }}') {
                            if (pos === 0) {
                                sum = baseline + Number(value);
                            } else {
                                sum = Number(value) + self.results[pos - 1];
                            }
                            self.results[row.id] = sum;
                        } else {    //Measure type: Cumulative
                            if (pos === 0) {
                                sum = Number(value) - baseline;
                            } else {
                                sum = Number(value) - self.results[pos - 1];
                            }
                            self.results[row.id] = Number(value);
                        }
                        //Descending
                    } else {
                        //Measure type: Discrete
                        if (goalType === '{{ $PlanIndicatorGoal::getDiscrete() }}') {
                            if (pos === 0) {
                                sum = baseline - Number(value);
                            } else {
                                sum = self.results[pos - 1] - Number(value);
                            }
                            self.results[row.id] = sum;
                        } else {    //Measure type: Cumulative
                            if (pos === 0) {
                                sum = baseline - Number(value);
                            } else {
                                sum = self.results[pos - 1] - Number(value);
                            }
                            self.results[row.id] = Number(value);
                        }
                    }
                }

                value = parseFloat(self.results[pos]).toFixed(2);
                createChart(pos, value);
                result = parseFloat(sum).toFixed(2);

                return result;
            };
        };

        //función para imprimir la tabla
        let printTable = () => {
            let goals = [];
            let label;
            let disabled = false;
            let aux = 0;

            @foreach($entity->planIndicatorGoals as $goal)
            goals.push('{{$goal->goal_value}}');
                    @endforeach

            for (let step = 0; step <= count * (count > 1 ? (frequency) : frequency); step++) {

                if (count == 2) {
                    label = {{ $startYear }} + aux + ' {{ trans('plan_indicators.labels.semester1') }}';
                    viewModel.addRow(step, label, goals[step], disabled);
                    label = {{ $startYear }} + aux + ' {{ trans('plan_indicators.labels.semester2') }}';
                    step += 1;
                    viewModel.addRow(step, label, goals[step], disabled);

                } else if (count == 4) {
                    label = {{ $startYear }} + aux + ' {{ trans('plan_indicators.labels.trimester1') }}';
                    viewModel.addRow(step, label, goals[step], disabled);
                    label = {{ $startYear }} + aux + ' {{ trans('plan_indicators.labels.trimester2') }}';
                    step += 1;
                    viewModel.addRow(step, label, goals[step], disabled);
                    label = {{ $startYear }} + aux + ' {{ trans('plan_indicators.labels.trimester3') }}';
                    step += 1;
                    viewModel.addRow(step, label, goals[step], disabled);
                    label = {{ $startYear }} + aux + ' {{ trans('plan_indicators.labels.trimester4') }}';
                    step += 1;
                    viewModel.addRow(step, label, goals[step], disabled);
                } else {
                    label = {{ $startYear }} + step;
                    viewModel.addRow(step, label, goals[step], disabled);
                }
                aux += 1;
            }

        };

        //función para imprimir la tablaTolerance
        let printTableTolerance = () => {
            let min = [];
            let max = [];
            let label;
            let maxValue = 0;
            let disabled = true;
            @foreach($entity->planIndicatorGoals as $goal)
            min.push('{{ $goal->min }}');
            max.push('{{ $goal->max }}');
            @endforeach

                dataTolerance.series[0].data = min;
            dataTolerance.series[1].data = max;

            let aux = 0;

            for (let step = 0; step <= (count * frequency); step++) {

                if (maxValue < max[step]) {
                    maxValue = max[step];
                }

                if (count == 2) {
                    label = {{ $startYear }} + aux + ' {{ trans('plan_indicators.labels.semester1') }}';
                    viewModel.addRowTolerance(step, label, min[step], max[step], disabled);
                    disabled = !(status === '{{ $Plan::STATUS_VERIFIED }}' || status === '{{ $Plan::STATUS_APPROVED }}') && {{ $startYear }} + step <= {{ $yearMeasurement }};
                    label = {{ $startYear }} + aux + ' {{ trans('plan_indicators.labels.semester2') }}';
                    step += 1;
                    disabled = !(status === '{{ $Plan::STATUS_VERIFIED }}' || status === '{{ $Plan::STATUS_APPROVED }}') && {{ $startYear }} + step <= {{ $yearMeasurement }};
                    viewModel.addRowTolerance(step, label, min[step], max[step], disabled);
                } else if (count == 4) {
                    label = {{ $startYear }} + aux + ' {{ trans('plan_indicators.labels.trimester1') }}';
                    viewModel.addRowTolerance(step, label, min[step], max[step], disabled);
                    disabled = !(status === '{{ $Plan::STATUS_VERIFIED }}' || status === '{{ $Plan::STATUS_APPROVED }}') && {{ $startYear }} + step <= {{ $yearMeasurement }};
                    label = {{ $startYear }} + aux + ' {{ trans('plan_indicators.labels.trimester2') }}';
                    step += 1;
                    disabled = !(status === '{{ $Plan::STATUS_VERIFIED }}' || status === '{{ $Plan::STATUS_APPROVED }}') && {{ $startYear }} + step <= {{ $yearMeasurement }};
                    viewModel.addRowTolerance(step, label, min[step], max[step], disabled);
                    label = {{ $startYear }} + aux + ' {{ trans('plan_indicators.labels.trimester3') }}';
                    step += 1;
                    viewModel.addRowTolerance(step, label, min[step], max[step], disabled);
                    disabled = !(status === '{{ $Plan::STATUS_VERIFIED }}' || status === '{{ $Plan::STATUS_APPROVED }}') && {{ $startYear }} + step <= {{ $yearMeasurement }};
                    label = {{ $startYear }} + aux + ' {{ trans('plan_indicators.labels.trimester4') }}';
                    step += 1;
                    disabled = !(status === '{{ $Plan::STATUS_VERIFIED }}' || status === '{{ $Plan::STATUS_APPROVED }}') && {{ $startYear }} + step <= {{ $yearMeasurement }};
                    viewModel.addRowTolerance(step, label, min[step], max[step], disabled);
                } else {
                    disabled = !(status === '{{ $Plan::STATUS_VERIFIED }}' || status === '{{ $Plan::STATUS_APPROVED }}') && {{ $startYear }} + step <= {{ $yearMeasurement }};
                    label = {{ $startYear }} + step;
                    viewModel.addRowTolerance(step, label, min[step], max[step], disabled);
                }
                aux += 1;
            }
            myChart.setOption(dataTolerance);
        };

        if (typeIndicator === '{{ $PlanIndicatorGoal::getTolerance() }}') {

            createDatasetTolerance(frequency * count);
            printTableTolerance();

            $('#tableToleranceDiv').show();
            $('#goal_type_div').hide();
        } else {
            createDataset(frequency * count);
            $('#tableDiv').show();
            printTable();
        }

        ko.applyBindings(viewModel, document.getElementById('goals'));

        $('#btn_cancel').on('click', (e) => {

            @if(isset($modal) && $modal)
            $modal.modal('hide');
            @else
            if (indicatorableType === '{{ $PlanIndicator::INDICATORABLE_PROJECT}}') {
                $('#edit_area').empty();
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
            @endif
        });

    });
</script>