@inject('PlanIndicator', '\App\Models\Business\PlanIndicator')

<div class="mb-3">
    <b>{{ trans($type . '.labels.' . $elementType) }}:</b>
    <p id="{{ $elementType }}_description">
        @if($elementType === 'project')
            {{ $project->description }}
        @elseif($elementType === 'component')
            {{ $component->name }}
        @else
            @if($objective->description)
                {{ $objective->description }}
            @else
                {{ $objective->name }}
            @endif
        @endif
    </p>
</div>
@foreach($indicators as $index => $indicator)
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 p-0">
        <div class="x_panel tile indicator-div" title="{{ $indicator['indicator_name'] }}">
            <div class="x_title fixed_height_70">
                <h6><b>{{ trans($type . '.labels.indicator') }}: </b>{{ $indicator['indicator_name'] }}</h6>
                <h6><b>{{ trans($type . '.labels.goal_indicator') }}: </b>{{ $indicator['indicator_goal_description'] }}</h6>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-md-8 col-xs-12 col-sm-12 bs4-align-self-center">
                        <canvas id="speedChart{{ $index }}" width="600" height="400"></canvas>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <h6 class="align-center">
                            <strong>{{ trans('thresholds.threshold.title') }}<br></strong>
                        </h6>
                        <div class="row">
                            @foreach($indicator['thresholds'] as $thresholds)
                                <div class="col-md-4 text-center mt-2">
                                    @if($thresholds['color'] === 'success')
                                        <i class="fa fa-circle fa-2x" style="color: #3c763d;"></i>
                                    @elseif($thresholds['color'] === 'warning')
                                        <i class="glyphicon glyphicon-triangle-top fa-2x" style="color: #f39c12;"></i>
                                    @else
                                        <i class="glyphicon glyphicon-stop fa-2x" style="color: #e74c3c;"></i>
                                    @endif
                                </div>
                                <div class="col-md-8">
                                    <h6>{{ trans('plan_indicators.labels.min_abbrev') . ': ' . $thresholds['min'] }}<br>
                                        {{ trans('plan_indicators.labels.max_abbrev') . ': ' . $thresholds['max'] }}</h6>
                                </div>
                            @endforeach
                        </div>
                        <canvas id="chart_gauge{{ $index }}" style="width: 100%"></canvas>
                        <div class="goal-wrapper" id="percentage_meter{{ $index }}">
                            <span id="gauge-text{{ $index }}" class="gauge-value pull-left"></span>
                            <span id="gauge-text_{{ $index }}" class="gauge-value pull-left divHidden"></span>
                            <span class="gauge-value pull-left">%</span>
                            <span id="goal-text{{ $index }}" class="goal-value pull-right">100%</span>
                        </div>
                        <div class="goal-wrapper" id="percentage_no_data{{ $index }}">
                            <h6 class="align-center">
                                <span id="no_data_text{{ $index }}" class="gauge-value pull-left"></span>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach


<script>
    $(() => {
        let goal_values;
        let actual_values;
        let min_values;
        let max_values;

        $.each({!! $indicators !!}, (index, element) => {
            let total_goal_values = 0;
            let total_actual_values = 0;
            let total_min_values = 0;
            let total_max_values = 0;
            let const_progress = 0;
            let const_goal = 0;

            if (element.indicator_type === '{{ $PlanIndicator::TYPE_ASCENDING }}') {
                if (element.indicator_goal_type === '{{ $PlanIndicator::TYPE_DISCREET }}') {
                    goal_values = element.goal_values.map((data, count) => {
                        if (count === 0) {
                            const_progress = data + element.indicator_base_line;
                        } else {
                            const_progress = data + const_progress;
                        }
                        return const_progress.toFixed(2);
                    });
                    actual_values = element.actual_values.map((data, count) => {
                        if (count === 0) {
                            const_goal = data + element.indicator_base_line;
                        } else {
                            const_goal = data + const_goal;
                        }
                        return const_goal.toFixed(2);
                    });

                    if (goal_values.length > 0) {
                        total_goal_values = (goal_values[goal_values.length - 1] - element.indicator_base_line).toFixed(2);
                    }
                    if (actual_values.length > 0) {
                        total_actual_values = (actual_values[actual_values.length - 1] - element.indicator_base_line).toFixed(2);
                    }
                } else {
                    goal_values = element.goal_values;
                    actual_values = element.actual_values;

                    if (goal_values.length > 0) {
                        total_goal_values = goal_values[goal_values.length - 1];
                    }
                    if (actual_values.length > 0) {
                        total_actual_values = actual_values[actual_values.length - 1];
                    }
                }
            } else if (element.indicator_type === '{{ $PlanIndicator::TYPE_DESCENDING }}') {
                if (element.indicator_goal_type === '{{ $PlanIndicator::TYPE_DISCREET }}') {
                    goal_values = element.goal_values.map((data, count) => {
                        if (data) {
                            if (count === 0) {
                                const_progress = element.indicator_base_line - data;
                            } else {
                                const_progress = const_progress - data;
                            }
                            return const_progress.toFixed(2);
                        } else {
                            return 0;
                        }
                    });
                    actual_values = element.actual_values.map((data, count) => {
                        if (data) {
                            if (count === 0) {
                                const_goal = element.indicator_base_line - data;
                            } else {
                                const_goal = const_goal - data;
                            }
                            return const_goal.toFixed(2);
                        } else {
                            return 0;
                        }
                    });
                    if (goal_values.length > 0) {
                        total_goal_values = (element.indicator_base_line - goal_values[goal_values.length - 1]).toFixed(2);
                    }
                    if (actual_values.length > 0) {
                        total_actual_values = (element.indicator_base_line - actual_values[actual_values.length - 1]).toFixed(2);
                    }
                } else {
                    goal_values = element.goal_values;
                    actual_values = element.actual_values;
                    if (goal_values.length > 0) {
                        total_goal_values = goal_values[goal_values.length - 1];
                    }
                    if (actual_values.length > 0) {
                        total_actual_values = actual_values[actual_values.length - 1];
                    }
                }
            } else {
                actual_values = element.actual_values;
                min_values = element.min_values;
                max_values = element.max_values;
                if (actual_values.length > 0) {
                    total_actual_values = actual_values[actual_values.length - 1];
                }
                if (min_values.length > 0) {
                    total_min_values = min_values[min_values.length - 1];
                }
                if (max_values.length > 0) {
                    total_max_values = max_values[max_values.length - 1];
                }
            }

            let speedCanvas = document.getElementById("speedChart" + index);
            Chart.defaults.global.defaultFontSize = 12;

            let chartOptions = {};
            let speedData = {};
            if (element.indicator_type === '{{ $PlanIndicator::TYPE_ASCENDING }}' || element.indicator_type === '{{ $PlanIndicator::TYPE_DESCENDING }}') {
                chartOptions = {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            useLineStyle: true,
                            borderWidth: 1
                        }
                    },
                    title: {
                        display: true,
                        text: '{{ trans($type . '.labels.chart_title') }}'
                    },
                    animation: {
                        animateScale: true,
                        duration: 10,
                        onComplete: function () {
                            let chartInstance = this.chart, ctx = chartInstance.ctx;
                            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                            ctx.textAlign = 'center';
                            chartInstance.config.data.datasets.forEach(function (element) {
                                if (element.label === "{{ trans($type . '.labels.goal') }}") {
                                    ctx.textBaseline = 'bottom';
                                } else {
                                    ctx.textBaseline = 'top';
                                }
                            });
                        }
                    }, tooltips: {
                        enabled: true
                    },
                    scales: {
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: '{{ trans($type . '.labels.label_y') }}'
                            }
                        }],
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: '{{ trans($type . '.labels.label_x') }}'
                            }
                        }]
                    }
                };
                speedData = {
                    labels: element.indicators_labels,
                    datasets: [{
                        label: "{{ trans($type . '.labels.goal') }}",
                        data: goal_values,
                        lineTension: 0.3,
                        fill: false,
                        borderColor: 'green',
                        backgroundColor: 'green',
                        borderWidth: 1
                    }, {
                        label: "{{ trans($type . '.labels.progress') }}",
                        data: actual_values,
                        lineTension: 0.3,
                        fill: false,
                        borderColor: 'blue',
                        backgroundColor: 'blue',
                        borderWidth: 1
                    }]
                };
            } else {
                chartOptions = {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            useLineStyle: true,
                            borderWidth: 1
                        }
                    },
                    title: {
                        display: true,
                        text: '{{ trans($type . '.labels.chart_title') }}'
                    },
                    animation: {
                        animateScale: true,
                        duration: 10,
                        onComplete: function () {
                            let chartInstance = this.chart, ctx = chartInstance.ctx;
                            ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontSize, Chart.defaults.global.defaultFontStyle, Chart.defaults.global.defaultFontFamily);
                            ctx.textAlign = 'center';
                            chartInstance.config.data.datasets.forEach(function (element) {
                                if (element.label === "{{ trans($type . '.labels.tolerance_max') }}") {
                                    ctx.textBaseline = 'bottom';
                                } else if (element.label === "{{ trans($type . '.labels.tolerance_min') }}") {
                                    ctx.textBaseline = 'top';
                                } else {
                                    ctx.textBaseline = 'top';
                                }
                            });
                        }
                    }, tooltips: {
                        enabled: true
                    },
                    scales: {
                        yAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: '{{ trans($type . '.labels.label_y') }}'
                            }
                        }],
                        xAxes: [{
                            scaleLabel: {
                                display: true,
                                labelString: '{{ trans($type . '.labels.label_x') }}'
                            }
                        }]
                    }
                };
                speedData = {
                    labels: element.indicators_labels,
                    datasets: [{
                        label: "{{ trans($type . '.labels.tolerance_min') }}",
                        data: min_values,
                        lineTension: 0.3,
                        fill: false,
                        borderColor: 'orange',
                        backgroundColor: 'orange',
                        borderWidth: 1
                    }, {
                        label: "{{ trans($type . '.labels.tolerance_max') }}",
                        data: max_values,
                        lineTension: 0.3,
                        fill: false,
                        borderColor: 'green',
                        backgroundColor: 'green',
                        borderWidth: 1
                    }, {
                        label: "{{ trans($type . '.labels.goal') }}",
                        data: actual_values,
                        lineTension: 0.3,
                        fill: false,
                        borderColor: 'blue',
                        backgroundColor: 'blue',
                        borderWidth: 1
                    }]
                };
            }

            new Chart(speedCanvas, {
                type: 'line',
                data: speedData,
                options: chartOptions
            });

            let color = '#e74c3c';
            let percentage = 0;
            let draw_speed = 0;
            if (total_actual_values !== 0) {
                if (element.indicator_type === '{{ $PlanIndicator::TYPE_ASCENDING }}') {
                    if (total_goal_values > 0) {
                        percentage = parseFloat((total_actual_values * 100) / total_goal_values).toFixed(2);
                    }
                } else if (element.indicator_type === '{{ $PlanIndicator::TYPE_DESCENDING }}') {
                    if (total_goal_values > 0) {
                        if (element.indicator_goal_type === '{{ $PlanIndicator::TYPE_DISCREET }}') {
                            percentage = (((element.indicator_base_line - (element.indicator_base_line - total_actual_values)) /
                                ((element.indicator_base_line - (element.indicator_base_line - total_goal_values)))) * 100).toFixed(2);
                        } else {
                            percentage = (((element.indicator_base_line - total_goal_values) / (element.indicator_base_line - total_actual_values)) * 100).toFixed(2);
                        }
                    }
                } else {
                    let percentage_max = total_actual_values * 100 / parseFloat(total_max_values);
                    let percentage_min = total_actual_values * 100 / parseFloat(total_min_values);
                    let deviation_percentage_max = Math.abs((percentage_max - 100));
                    let deviation_percentage_min = Math.abs((percentage_min - 100));
                    if (total_actual_values >= total_min_values && total_actual_values <= total_max_values) {
                        percentage = 0;
                        $("#percentage_meter" + index).hide();
                        $("#percentage_no_data" + index).show();
                        $("#no_data_text" + index).text('No hay porcentaje de desviación');
                        draw_speed = 1;
                    } else {
                        let measurement_value = deviation_percentage_max;
                        if (deviation_percentage_max > deviation_percentage_min) {
                            measurement_value = deviation_percentage_min;
                        }
                        percentage = measurement_value.toFixed(2);
                        $("#percentage_meter" + index).show();
                        $("#percentage_no_data" + index).hide();
                        $("#no_data_text" + index).text();
                    }
                }
            }
            if (percentage <= 0) {
                percentage = 1;
            }
            let labelPercentage = percentage;
            if (percentage > 100) {
                percentage = 100;
            }

            $.each(element.thresholds, (item) => {
                if (percentage >= item.min && percentage <= item.max && item.color === 'danger') {
                    color = '#e74c3c';
                } else if (percentage >= item.min && percentage <= item.max && item.color === 'warning') {
                    color = '#f39c12';
                } else if (percentage >= item.min && percentage <= item.max && item.color === 'success') {
                    color = '#3c763d';
                }
            });

            // Mostrar medidor de porcentaje
            if (draw_speed === 0) {
                let a = {
                    lines: 12,
                    angle: 0,
                    lineWidth: .4,
                    pointer: {
                        length: .75,
                        strokeWidth: .042,
                        color: "#1D212A"
                    },
                    limitMax: 100,
                    colorStart: color,
                    colorStop: color,
                    strokeColor: "#F0F3F3",
                    generateGradient: !0
                };
                if ($("#chart_gauge" + index).length) {
                    var b = document.getElementById("chart_gauge" + index), c = new Gauge(b).setOptions(a);
                }
                if ($("#gauge-text" + index).length && (c.maxValue = 100, c.set(parseInt(percentage)), c.setTextField(document.getElementById("gauge-text" + index))), $("#chart_gauge_02" + index).length) {
                    var d = document.getElementById("chart_gauge_02" + index),
                        e = new Gauge(d).setOptions(a);
                }
                $('#gauge-text_' + index).show();
                $('#gauge-text' + index).hide();
                if (percentage === 1) {
                    $('#gauge-text_' + index).text('0');
                } else {
                    $('#gauge-text_' + index).text(labelPercentage);
                }
                $('#chart_gauge' + index).css("height", "");
                $('#chart_gauge' + index).css("width", "100%");
            } else {
                $('#chart_gauge' + index).css("width", "0%");
            }
        });

        @if($backRoute)
        $('#backButton').on('click', () => {
            let url = '{{ $backRoute }}';
            pushRequest(url);
        });
        @endif
    });
</script>
