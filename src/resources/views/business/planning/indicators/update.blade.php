@inject('PlanIndicatorGoal', 'App\Models\Business\PlanIndicatorGoal')
@inject('PlanIndicator', 'App\Models\Business\PlanIndicator')
@inject('Plan', 'App\Models\Business\Plan')

<div class="x_panel">
    <div class="x_title">

        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                <li role="presentation" class="active" id="li_content1">
                    <a href="#tab_content1" id="home-tab" role="tab"
                       data-toggle="tab"
                       aria-expanded="true">{{ trans('plan_indicators.labels.indicator') }}</a>
                </li>
                <li role="presentation" class="" id="li_content2">
                    <a href="#tab_content2" role="tab" id="profile-tab"
                       data-toggle="tab"
                       aria-expanded="false">{{ trans('plan_indicators.labels.planned_measurements') }}</a>
                </li>
            </ul>
            <form role="form"
                  action="@stack('url')"
                  method="post"
                  enctype="multipart/form-data"
                  class="form-horizontal form-label-left" id="planIndicatorUpdateFm" novalidate>
                @method('PUT')
                @csrf
                <div id="myTabContent" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                    <div class="x_title">
                                        <h2>
                                            {{ trans('plan_indicators.labels.edit') }}
                                        </h2>

                                        <div class="clearfix"></div>
                                    </div>

                                    <div class="x_content">

                                        <input type="hidden" value="draft" name="status">
                                        <input type="hidden" value="{{ currentUser()->id }}" name="creator_user_id">

                                        @stack('route')

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                   for="indicatorName">
                                                {{ trans('plan_indicators.labels.name') }} <span
                                                        class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input name="name" id="indicatorName" maxlength="150"
                                                       class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12"
                                                       value="{{ $entity->name }}"
                                                       placeholder="{{ trans('plan_indicators.placeholder.name') }}"/>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                                {{ trans('plan_indicators.labels.description') }} <span
                                                        class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="description" id="description" rows="5"
                                          class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12 vertical">{{ $entity->description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                   for="measuring_unit">
                                                {{ trans('plan_indicators.labels.measuring_unit') }} <span
                                                        class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="disabledInputs form-control select2 select2_measuring_unit"
                                                        id="measuring_unit"
                                                        name="measure_unit_id">
                                                    @foreach($measuringUnits as $value)
                                                        <option value="{{ $value->id }}" data-abbv="{{ $value->abbreviation }}"
                                                                @if($entity->measure_unit_id === $value->id) selected @endif>{{ $value->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                   for="calculation_formula">
                                                {{ trans('plan_indicators.labels.calculation_formula') }}
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="calculation_formula" id="calculation_formula" rows="5"
                                          class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12 vertical">{{ $entity->calculation_formula }}</textarea>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-2">
                            <span class="fa fa-info-circle fa-2x"
                                  data-toggle="tooltip" rel="tooltip" data-placement="right"
                                  data-original-title="{{ trans('plan_indicators.calculation_formula_description') }}"></span>
                                            </div>

                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="source">
                                                {{ trans('plan_indicators.labels.source') }} <span
                                                        class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="source" id="source" rows="5"
                                          class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12 vertical">{{ $entity->source }}</textarea>
                                            </div>
                                        </div>

                                        <div id="dynamic_files">
                                            @include('business.planning.indicators.partial.inputs')
                                        </div>

                                        <h2 class="page-header">
                                            {{ trans('plan_indicators.labels.goal') }}
                                        </h2>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="base_line">
                                                {{ trans('plan_indicators.labels.base_line') }}
                                                <span class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-10">
                                                <div class="input-group">
                                                    <input type="number" name="base_line" id="base_line"
                                                           class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12"
                                                           value="{{ $entity->base_line }}"
                                                           placeholder="{{ trans('plan_indicators.placeholder.base_line') }}"/>
                                                    <span class="input-group-addon measure_unit_abbrev">{{ $entity->measureUnit->abbreviation }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-sm-1 col-xs-2">
                            <span class="fa fa-info-circle fa-2x"
                                  data-toggle="tooltip" rel="tooltip" data-placement="right"
                                  title="{{ trans('plan_indicators.base_line_description') }}"></span>
                                            </div>

                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                   for="base_line_year">
                                                {{ trans('plan_indicators.labels.base_line_year') }} <span
                                                        class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="number" name="base_line_year" id="base_line_year"
                                                       class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12"
                                                       value="{{ $entity->base_line_year }}"
                                                       placeholder="{{ trans('plan_indicators.placeholder.base_line_year') }}"/>

                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="goal">
                                                {{ trans('plan_indicators.labels.goal') }}  {{ trans('plan_indicators.labels.year') }}
                                                <span>{{ $yearPlanning }}</span> <span
                                                        class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="input-group">
                                                    <input type="number" name="goal" id="goal" maxlength="200"
                                                           class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12"
                                                           value="{{ $entity->goal }}"
                                                           placeholder="{{ trans('plan_indicators.placeholder.goal') }}"/>
                                                    <span class="input-group-addon measure_unit_abbrev">{{ $entity->measureUnit->abbreviation }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-3 col-xs-2">
                            <span class="fa fa-info-circle fa-2x"
                                  data-toggle="tooltip" rel="tooltip" data-placement="right"
                                  data-original-title="{{ trans('plan_indicators.goal_description') }}"></span>
                                            </div>
                                        </div>

                                        <div class="item form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                   for="goal_description">
                                                {{ trans('plan_indicators.labels.description_goal') }} <span
                                                        class="required text-danger">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="goal_description" id="goal_description" rows="5"
                                          class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12 vertical">{{ $entity->goal_description }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                            <a class="btn btn-info ajaxify btn_cancel">
                                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                                            </a>
                                            <a class="btn btn-success" href="#tab_content2" role="tab" id="nex"
                                               data-toggle="tab"
                                               aria-expanded="false">
                                                <i class="fa fa-arrow-right"></i> {{ trans('app.labels.next') }}
                                            </a>

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
                                                        <span id="measuringUnitValue"> </span>
                                                    </span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <span>
                                                        <b>{{ trans('plan_indicators.labels.base_line') }}{{ trans('plan_indicators.labels.year') }}
                                                            <span id="lineBaseYearValue"> </span> :</b>
                                                            <span id="lineBaseValue" class="badge badge-warning"> </span>
                                                    </span>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12">
                                                    <span>
                                                        <b>{{ trans('plan_indicators.labels.goal') }} {{ trans('plan_indicators.labels.year') }} {{ $yearPlanning }}:</b>
                                                            <span
                                                                    id="goalValue" class="badge badge-warning"> </span>
                                                            </span>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12 mt-4">
                                                <div class="item form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">
                                                        {{ trans('plan_indicators.labels.type') }} <span class="required text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select class="disabledInputs form-control select2 select2_type"
                                                                id="type" name="type">
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
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                           for="goal_type">
                                                        {{ trans('plan_indicators.labels.goal_type') }} <span
                                                                class="required text-danger">*</span>
                                                    </label>
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <select class="disabledInputs form-control select2 select2_goal_type"
                                                                id="goal_type"
                                                                name="goal_type">
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

                                                @if($planType == $Plan::TYPE_PEI )
                                                    <div class="item form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"
                                                               for="measurement_frequency_per_year">
                                                            {{ trans('plan_indicators.labels.measurement_frequency_per_year') }}
                                                            <span
                                                                    class="required text-danger">*</span>
                                                        </label>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <select class="disabledInputs form-control select2 select2_frequency"
                                                                    id="measurement_frequency_per_year"
                                                                    name="measurement_frequency_per_year">
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
                                                        <label class="control-label col-md-12 col-sm-12 col-xs-12 table-cell">
                                                            {{ trans('plan_indicators.labels.period') }}
                                                        </label>
                                                    </th>
                                                    <th align="center">
                                                        <label id="type1"
                                                               class="control-label col-md-8 col-sm-8 col-xs-12 table-cell">
                                                            @if($entity->goal_type == $PlanIndicatorGoal::getDiscrete())
                                                                {{ trans('plan_indicators.labels.discrete') }}
                                                            @else
                                                                {{ trans('plan_indicators.labels.cumulative') }}
                                                            @endif
                                                        </label>
                                                    </th>
                                                    <th align="center">

                                                        <label id="type2"
                                                               class="control-label col-md-3 col-sm-3 col-xs-12 table-cell">
                                                            @if($entity->goal_type == $PlanIndicatorGoal::getDiscrete())
                                                                {{ trans('plan_indicators.labels.cumulative') }}
                                                            @else
                                                                {{ trans('plan_indicators.labels.discrete') }}
                                                            @endif

                                                        </label>
                                                    </th>
                                                </tr>

                                                <!-- ko foreach: rows -->
                                                <tr>
                                                    <td align="center">
                                                        <label class="control-label col-md-12 col-sm-12 col-xs-12">
                                                            <span data-bind="text: a"></span><span
                                                                    class="required text-danger">*</span>
                                                        </label>
                                                    </td>
                                                    <td align="center" data-bind="style: { 'border': styling }">
                                                        <div class="col-md-6 col-sm-6 col-xs-12 table-cell">
                                                            <input type="number"
                                                                   onclick="this.select()"
                                                                   data-bind=" textInput: value, attr:{id: id, required:true, name:id, min: 0, readonly: enabled}"
                                                                   class="number-input-cell form-control col-md-7 col-sm-7 col-xs-12"
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
                                                        <label id="type1"
                                                               class="control-label col-md-12 col-sm-12 col-xs-12 table-cell">
                                                            {{ trans('plan_indicators.labels.min') }}
                                                        </label>
                                                    </th>
                                                    <th align="center" class="col-md-4 col-sm-4 col-xs-4">
                                                        <label id="type2"
                                                               class="control-label col-md-12 col-sm-12 col-xs-12 table-cell">
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
                                                        <input type="number"
                                                               onclick="this.select()"
                                                               data-bind="textInput: min, attr:{id: 'min' + id, required:true, readonly: enabled, name:'min' + id, min: 0}"
                                                               class="form-control col-md-12 col-sm-12 col-xs-12 number-input-cell"
                                                               placeholder="0"/>
                                                    </td>
                                                    <td align="center">
                                                        <input type="number"
                                                               onclick="this.select()"
                                                               data-bind=" textInput: max, attr:{id: 'max' + id, required:true, name:'max' + id, min: 0, readonly: enabled}"
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
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                <a class="btn btn-info" href="#tab_content1" role="tab" id="back"
                                                   data-toggle="tab"
                                                   aria-expanded="false">
                                                    <i class="fa fa-arrow-left"></i> {{ trans('app.labels.back') }}
                                                </a>
                                                <a class="btn btn-info ajaxify btn_cancel">
                                                    <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                                                </a>
                                                @if(isset($justifiable) && $justifiable)
                                                    <button id="indicatorSubmit" name="indicatorSubmit"
                                                            class="btn btn-success">
                                                        <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                                                    </button>
                                                @else
                                                    <button id="btnSaveIndicator" type="submit" class="btn btn-success">
                                                        <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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

        let count = {{ $entity->measurement_frequency_per_year }};

        let myChart = echarts.init(document.getElementById('myChart'));
        let frequency = {{ $yearPlanning }} - {{ $startYear }};
        let frequencyLiteral = {{ $startYear }};
        let goal = {{ $entity->goal }};
        let status = '{{ $status }}';
        let indicatorableType = '{{ $indicatorable }}';

        //Función para pintar el cuadro
        let createChart = (index, value) => {
            data.series[0].data[index].value = value;
            data.title.text = $("#indicatorName").val();
            data.title.subtext = '{{ trans('plan_indicators.labels.base_line') }}: ' + $('#base_line').val() +
                '\n{{ trans('plan_indicators.labels.base_line_year') }}: ' + $('#base_line_year').val();
            data.yAxis[0].name = $("#measuring_unit option:selected").text();
            myChart.setOption(data, true);
        };

        //Función para pintar la grafica de tolerancia
        let createChartToleranceMin = (index, min) => {
            dataTolerance.series[0].data[index] = min;
            dataTolerance.title.text = $("#indicatorName").val();
            dataTolerance.title.subtext = '{{ trans('plan_indicators.labels.base_line') }}: ' + $('#base_line').val() +
                '\n{{ trans('plan_indicators.labels.base_line_year') }}: ' + $('#base_line_year').val();
            dataTolerance.yAxis[0].name = $("#measuring_unit option:selected").text();
            myChart.setOption(dataTolerance, true);
        };

        //Función para pintar la grafica de tolerancia
        let createChartToleranceMax = (index, max) => {
            dataTolerance.series[1].data[index] = max;
            myChart.setOption(dataTolerance, true);
        };

        //Función para construir los datos del gráfico
        let createDataset = (frequency) => {
            let xData = [];
            let seriesData = [];

            if (count ==2) {
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

            if (count ==2) {
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
            createChartToleranceMax(0, 0);
        };

        $('#profile-tab').on('shown.bs.tab', () => {
            myChart.resize();
            myChart.setOption({
                title: {
                    text: $("#indicatorName").val(),
                    subtext: '{{ trans('plan_indicators.labels.base_line') }}: ' + $('#base_line').val() + '\n{{ trans('plan_indicators.labels.base_line_year') }}: ' + $('#base_line_year').val()
                },
                yAxis: {name: $("#measuring_unit option:selected").text()}
            });
        });

        // Redimensiona el echart al cambiar de tamaño de la ventana
        $(window).resize(() => {
            myChart.resize();
        });

        let measuringUnitSelect = $("#measuring_unit option:selected");
        let baseLineYear = $("#base_line_year").val();
        let baselineSelect = $("#base_line").val();
        $("#measuringUnitLabel").text(measuringUnitSelect.text());
        $("#measuringUnitValue").text(measuringUnitSelect.text());
        $("#labelName").text($("#indicatorName").val());
        $("#base_line_yearLabel").text(baseLineYear);
        $("#lineBaseYearValue").text(baseLineYear);
        $("#goalValue").text($("#goal").val());
        $("#labelSource").text($("#source").val());
        $("#base_lineLabel").text(baselineSelect);
        $("#lineBaseValue").text(baselineSelect);

        let baseline = {{ $entity->base_line }};
        let typeIndicator = '{{ $entity->type }}';
        let goalType = '{{ $entity->goal_type }}';
        let $planIndicatorUpdateFm = $('#planIndicatorUpdateFm');

        $planIndicatorUpdateFm.validate($.extend(false, $validateDefaults, {
            rules: {
                name: {
                    required: true,
                    //Función para retornar a la pestaña anterior en caso de no llenar data en indicadores
                    function(value) {
                        if (!value.value) {
                            $('#tab_content2').removeClass('active in');
                            $('#tab_content1').addClass('active in');
                            $('#li_content2').removeClass('active');
                            $('#li_content1').addClass('active');
                        }
                    }
                },
                description: {
                    required: true,
                    //Función para retornar a la pestaña anterior en caso de no llenar data en indicadores
                    function(value) {
                        if (!value.value) {
                            $('#tab_content2').removeClass('active in');
                            $('#tab_content1').addClass('active in');
                            $('#li_content2').removeClass('active');
                            $('#li_content1').addClass('active');
                        }
                    }
                },
                measuring_unit: {
                    required: true,
                    //Función para retornar a la pestaña anterior en caso de no llenar data en indicadores
                    function(value) {
                        if (!value.value) {
                            $('#tab_content2').removeClass('active in');
                            $('#tab_content1').addClass('active in');
                            $('#li_content2').removeClass('active');
                            $('#li_content1').addClass('active');
                        }
                    }
                },
                source: {
                    required: true,
                    //Función para retornar a la pestaña anterior en caso de no llenar data en indicadores
                    function(value) {
                        if (!value.value) {
                            $('#tab_content2').removeClass('active in');
                            $('#tab_content1').addClass('active in');
                            $('#li_content2').removeClass('active');
                            $('#li_content1').addClass('active');
                        }
                    }
                },
                base_line: {
                    required: true,
                    min: 0,
                    //Función para retornar a la pestaña anterior en caso de no llenar data en indicadores
                    function(value) {
                        if (!value.value) {
                            $('#tab_content2').removeClass('active in');
                            $('#tab_content1').addClass('active in');
                            $('#li_content2').removeClass('active');
                            $('#li_content1').addClass('active');
                        }
                    }
                },
                base_line_year: {
                    required: true,
                    onlyIntegers: true,
                    min: 1900,
                    max: 3000,
                    //Función para retornar a la pestaña anterior en caso de no llenar data en indicadores
                    function(value) {
                        if (!value.value) {
                            $('#tab_content2').removeClass('active in');
                            $('#tab_content1').addClass('active in');
                            $('#li_content2').removeClass('active');
                            $('#li_content1').addClass('active');
                        }
                    }
                },
                goal: {
                    required: true,
                    min: 0,
                    //Función para retornar a la pestaña anterior en caso de no llenar data en indicadores
                    function(value) {
                        if (!value.value) {
                            $('#tab_content2').removeClass('active in');
                            $('#tab_content1').addClass('active in');
                            $('#li_content2').removeClass('active');
                            $('#li_content1').addClass('active');
                        }
                    }
                },
                goal_description: {
                    required: true,
                    //Función para retornar a la pestaña anterior en caso de no llenar data en indicadores
                    function(value) {
                        if (!value.value) {
                            $('#tab_content2').removeClass('active in');
                            $('#tab_content1').addClass('active in');
                            $('#li_content2').removeClass('active');
                            $('#li_content1').addClass('active');
                        }
                    }
                },
                type: {
                    required: true
                },
                measurement_frequency_per_year: {
                    required: true
                },
                'goals[]': {
                    required: true,
                    min: 0,
                    max: 5
                },
                technical_file: {
                    required: false
                }
            },
            messages: {}
        }));

        //Evento para no guardar el formulario al presionar Enter
        $planIndicatorUpdateFm.on('keypress', (e) => {
            let keyCode = e.which;
            if (keyCode === 13 && !$(e.target).is('textarea')) {
                e.preventDefault();
            }
        });

        $("#measuring_unit", $planIndicatorUpdateFm).on('change', () => {
            let measuringUnit = $("#measuring_unit option:selected");
            $("#measuringUnitLabel").text(measuringUnit.text());
            $("#measuringUnitValue").text(measuringUnit.text());
            $(".measure_unit_abbrev").text(measuringUnit.attr('data-abbv'));
        });

        $("#nex", $planIndicatorUpdateFm).on('click', () => {
            $('#myTab a[href="#tab_content2"]').tab('show');
        });

        $("#back", $planIndicatorUpdateFm).on('click', () => {
            $('#myTab a[href="#tab_content1"]').tab('show');
        });

        $("#measurement_frequency_per_year", $planIndicatorUpdateFm).on('change', () => {
            let measurementFrequencyPerYear = $("#measurement_frequency_per_year").val();
            if (measurementFrequencyPerYear > 0) {
                count = Number(measurementFrequencyPerYear);
            } else {
                count = {{ $entity->measurement_frequency_per_year }};
            }
            if (typeIndicator !== '{{ $PlanIndicatorGoal::getTolerance() }}') {
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
                createChartToleranceMin(0, 0);
                createChartToleranceMax(0, 0);
                createDatasetTolerance(frequency * count);
                printTableTolerance();
            }

        });

        $("#goal_type", $planIndicatorUpdateFm).on('change', () => {
            goalType = $("#goal_type").val();
            let measurementFrequencyPerYear = $('#measurement_frequency_per_year').val();
            let goalTypeSelect = $("#goal_type option:selected").text();
            if (measurementFrequencyPerYear > 0) {
                count = $("#measurement_frequency_per_year").val();
            }
            $("#type1").text(goalTypeSelect);
            if (goalTypeSelect === '{{ trans('plan_indicators.labels.cumulative') }}') {
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
            let measurementFrequencyPerYear = $('#measurement_frequency_per_year').val();
            if (measurementFrequencyPerYear > 0) {
                count = measurementFrequencyPerYear;
            }
            typeIndicator = $("#type").val();

            if (typeIndicator === '{{ $PlanIndicatorGoal::getTolerance() }}') {
                $('#goal_type_div').hide();
                $('#tableToleranceDiv').show();
                $('#tableDiv').hide();
                viewModel.rowsTolerance.removeAll();
                viewModel.rows.removeAll();
                createChartToleranceMin(0, 0);
                createChartToleranceMax(0, 0);
                createDatasetTolerance(frequency * count);
                printTableTolerance();
            } else {
                $('#goal_type_div').show();
                $('#tableToleranceDiv').hide();
                $('#tableDiv').show();
                viewModel.rows.removeAll();
                viewModel.rowsTolerance.removeAll();
                createChart(0, 0);
                createDataset(frequency * count);
                printTable();
            }
        });

        $("#source", $planIndicatorUpdateFm).focusout(() => {
            $("#labelSource").text($("#source").val());
        });

        $("#base_line", $planIndicatorUpdateFm).focusout(() => {
            let baseLineSelect = $("#base_line").val();
            let measurementFrequencyPerYear = $("#measurement_frequency_per_year").val();
            $("#base_lineLabel").text(baseLineSelect);
            $("#lineBaseValue").text(baseLineSelect);
            if (measurementFrequencyPerYear > 0) {
                count = measurementFrequencyPerYear;
            }

            baseline = Number(baseLineSelect);

        });

        $("#goal", $planIndicatorUpdateFm).focusout(() => {
            goal = $("#goal").val();
            let measurementFrequencyPerYear = $("#measurement_frequency_per_year").val();
            $("#goalValue").text(goal);
            if (measurementFrequencyPerYear > 0) {
                count = measurementFrequencyPerYear;
            }

            if (typeIndicator !== '{{ $PlanIndicatorGoal::getTolerance() }}') {
                viewModel.rows.removeAll();
                createDataset(frequency * count);
                printTable();
            }
        });

        $("#base_line_year", $planIndicatorUpdateFm).focusout(() => {
            let baseLineYear = $("#base_line_year").val();
            $("#base_line_yearLabel").text(baseLineYear);
            $("#lineBaseYearValue").text(baseLineYear);
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
            self.styling = ko.observable('');
            self.validRow = true;
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

            self.validateValue = (row, value) => {
                //Ascending type validations
                if (typeIndicator === '{{ $PlanIndicatorGoal::getAscending() }}') {
                    //Discrete measure validations
                    if (goalType === '{{ $PlanIndicatorGoal::getDiscrete() }}') {
                        if (value > goal) {
                            row.styling('2px solid red');
                            row.validRow = false;
                        } else {
                            row.styling('');
                            row.validRow = true;
                        }
                    } else {    //Cumulative measure validations
                        if (value > goal || value < baseline) {
                            row.styling('2px solid red');
                            row.validRow = false;
                        } else {
                            if (row.id === 0) {
                                if (value > goal || value < baseline) {
                                    row.styling('2px solid red');
                                    row.validRow = false;
                                } else {
                                    row.styling('');
                                    row.validRow = true;
                                }
                            } else {
                                if (value > goal || value < self.rows()[row.id - 1].value()) {
                                    row.styling('2px solid red');
                                    row.validRow = false;
                                } else {
                                    row.styling('');
                                    row.validRow = true;
                                }
                            }
                        }
                    }
                } else {    //Descending type validations
                    //Discrete measure validations
                    if (goalType === '{{ $PlanIndicatorGoal::getDiscrete() }}') {
                        if (value < goal) {
                            row.styling('2px solid red');
                            row.validRow = false;
                        } else {
                            row.styling('');
                            row.validRow = true;
                        }
                    } else {    //Cumulative measure validations
                        if (value < goal || value > baseline) {
                            row.styling('2px solid red');
                            row.validRow = false;
                        } else {
                            if (row.id === 0) {
                                if (value < goal || value > baseline) {
                                    row.styling('2px solid red');
                                    row.validRow = false;
                                } else {
                                    row.styling('');
                                    row.validRow = true;
                                }
                            } else {
                                if (value < goal || value > self.rows()[row.id - 1].value()) {
                                    row.styling('2px solid red');
                                    row.validRow = false;
                                } else {
                                    row.styling('');
                                    row.validRow = true;
                                }
                            }
                        }
                    }
                }
                self.results[row.id] = value;
            };

            //Función para calcular cada valor según el tipo de indicador y el tipo de meta
            self.calculateValue = (currentPos) => {
                let totalRows = self.rows().length;
                let sum = baseline;
                let result;
                let row;
                let pos = currentPos();
                let value = 0;

                if (totalRows > 0) {
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
                                sum += Number(value);
                            } else {
                                sum = Number(value) + self.results[pos - 1];
                            }
                            self.validateValue(row, sum);
                        } else {    //Measure type: Cumulative
                            if (pos === 0) {
                                sum = Number(value) - baseline;
                            } else {
                                sum = Number(value) - self.results[pos - 1];
                            }
                            self.validateValue(row, Number(value));
                        }
                        //Descending
                    } else {
                        //Measure type: Discrete
                        if (goalType === '{{ $PlanIndicatorGoal::getDiscrete() }}') {
                            if (pos === 0) {
                                sum -= Number(value);
                            } else {
                                sum = self.results[pos - 1] - Number(value);
                            }
                            self.validateValue(row, sum);
                        } else {    //Measure type: Cumulative
                            if (pos === 0) {
                                sum = baseline - Number(value);
                            } else {
                                sum = self.results[pos - 1] - Number(value);
                            }
                            self.validateValue(row, Number(value));
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
            let contAux = 0;
            let goals = [];
            let label;
            let disabled = true;
            let enabledGoals = [];

            @foreach($entity->planIndicatorGoals as $goal)

            goals.push('{{isset($goal->goal_value) ? $goal->goal_value : 0}}');
            {{--            @if($goal->year <= date("Y"))--}}
            {{--            enabledGoals.push(true)--}}
            {{--            @else--}}
            {{--            enabledGoals.push(false)--}}
            {{--                    @endif--}}
            enabledGoals.push(false)
                    @endforeach

            for (let step = 0; step <= frequency; step++) {

                if (count == 2) {
                    label = {{ $startYear }} + step + ' {{ trans('plan_indicators.labels.semester1') }}';
                    viewModel.addRow(contAux, label, goals[contAux], enabledGoals[contAux]);
                    contAux += 1;
                    label = {{ $startYear }} + step + ' {{ trans('plan_indicators.labels.semester2') }}';
                    viewModel.addRow(contAux, label, goals[contAux], enabledGoals[contAux]);
                    contAux += 1;
                } else if (count == 4) {
                    label = {{ $startYear }} + step + ' {{ trans('plan_indicators.labels.trimester1') }}';
                    viewModel.addRow(contAux, label, goals[contAux], enabledGoals[contAux]);
                    contAux += 1;
                    label = {{ $startYear }} + step + ' {{ trans('plan_indicators.labels.trimester2') }}';
                    viewModel.addRow(contAux, label, goals[contAux], enabledGoals[contAux]);
                    contAux += 1;
                    label = {{ $startYear }} + step + ' {{ trans('plan_indicators.labels.trimester3') }}';
                    viewModel.addRow(contAux, label, goals[contAux], enabledGoals[contAux]);
                    contAux += 1;
                    label = {{ $startYear }} + step + ' {{ trans('plan_indicators.labels.trimester4') }}';
                    viewModel.addRow(contAux, label, goals[contAux], enabledGoals[contAux]);
                    contAux += 1;
                } else {
                    label = {{ $startYear }} + step;
                    viewModel.addRow(step, label, goals[step], enabledGoals[step]);
                }
            }
        };

        let loadDataTolerance = () => {
            let min = [];
            let max = [];

            @foreach($entity->planIndicatorGoals as $goal)
            min.push('{{ isset($goal->min) ? $goal->min:0 }}');
            max.push('{{ isset($goal->max) ? $goal->max:0 }}');
            @endforeach
                dataTolerance.series[0].data = min;
            dataTolerance.series[1].data = max;

            myChart.setOption(dataTolerance);
        };

        //función para imprimir la tablaTolerance
        let printTableTolerance = () => {

            let contAux = 0;
            let min = [];
            let max = [];
            let label;
            let maxValue = 0;
            let disabled = true;
            let enabledGoals = [];


            @foreach($entity->planIndicatorGoals as $goal)
            min.push('{{ isset($goal->min) ? $goal->min:0 }}');
            max.push('{{ isset($goal->max) ? $goal->max:0 }}');
            {{--            @if($goal->year <= date("Y"))--}}
            {{--            enabledGoals.push(true)--}}
            {{--            @else--}}
            {{--            enabledGoals.push(false)--}}
            {{--                    @endif--}}
            enabledGoals.push(false)

                    @endforeach

            for (let step = 0; step <= frequency; step++) {

                if (maxValue < max[step]) {
                    maxValue = max[step];
                }

                if (count == 2) {

                    label = {{ $startYear }} + step + ' {{ trans('plan_indicators.labels.semester1') }}';
                    viewModel.addRowTolerance(contAux, label, min[contAux], max[contAux], enabledGoals[contAux]);
                    createChartToleranceMin(contAux, min[contAux]);
                    createChartToleranceMax(contAux, max[contAux]);
                    contAux += 1;

                    label = {{ $startYear }} + step + ' {{ trans('plan_indicators.labels.semester2') }}';
                    viewModel.addRowTolerance(contAux, label, min[contAux], max[contAux], enabledGoals[contAux]);
                    createChartToleranceMin(contAux, min[contAux]);
                    createChartToleranceMax(contAux, max[contAux]);
                    contAux += 1;
                } else if (count == 4) {
                    label = {{ $startYear }} + step + ' {{ trans('plan_indicators.labels.trimester1') }}';
                    viewModel.addRowTolerance(contAux, label, min[contAux], max[contAux], enabledGoals[contAux]);
                    createChartToleranceMin(contAux, min[contAux]);
                    createChartToleranceMax(contAux, max[contAux]);
                    contAux += 1;
                    label = {{ $startYear }} + step + ' {{ trans('plan_indicators.labels.trimester2') }}';
                    viewModel.addRowTolerance(contAux, label, min[contAux], max[contAux], enabledGoals[contAux]);
                    createChartToleranceMin(contAux, min[contAux]);
                    createChartToleranceMax(contAux, max[contAux]);
                    contAux += 1;
                    label = {{ $startYear }} + step + ' {{ trans('plan_indicators.labels.trimester3') }}';
                    viewModel.addRowTolerance(contAux, label, min[contAux], max[contAux], enabledGoals[contAux]);
                    createChartToleranceMin(contAux, min[contAux]);
                    createChartToleranceMax(contAux, max[contAux]);
                    contAux += 1;
                    label = {{ $startYear }} + step + ' {{ trans('plan_indicators.labels.trimester4') }}';
                    viewModel.addRowTolerance(contAux, label, min[contAux], max[contAux], enabledGoals[contAux]);
                    createChartToleranceMin(contAux, min[contAux]);
                    createChartToleranceMax(contAux, max[contAux]);
                    contAux += 1;
                } else {
                    label = {{ $startYear }} + step;
                    viewModel.addRowTolerance(step, label, min[step], max[step], enabledGoals[step]);
                    createChartToleranceMin(step, min[step]);
                    createChartToleranceMax(step, max[step]);
                }
            }
        };

        if (typeIndicator === '{{ $PlanIndicatorGoal::getTolerance() }}') {

            createDatasetTolerance(frequency * count);
            loadDataTolerance();
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

        $('.btn_cancel').on('click', (e) => {

            if (indicatorableType === '{{ $PlanIndicator::INDICATORABLE_PROJECT }}') {
                $('#edit_area').empty();
            } else if (indicatorableType === '{{ $PlanIndicator::INDICATORABLE_COMPONENT }}') {
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

            let validate = $planIndicatorUpdateFm.valid();

            if (validate) {
                showLoading();
                processResponse(response, null, () => {
                    $validateDefaults.rules = {};
                    $validateDefaults.messages = {};
                    $('#load-area').empty();
                    $('#load-tree').empty();

                    const url = '{!! route('loadstructure.edit.plans.plans_management', ['id' => isset($planId) ? $planId : 0]) !!}';
                    pushRequest(url, '#load-tree', () => {

                    }, 'GET', {'_token': '{!! csrf_token() !!}'}, false);
                });
                $('html, body').animate({scrollTop: 0}, 500);
            }
        };

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

        let processResponseOperationalGoal = (response) => {
            let validate = $planIndicatorUpdateFm.valid();

            if (validate) {
                showLoading();
                processResponse(response, null, () => {
                    $validateDefaults.rules = {};
                    $validateDefaults.messages = {};
                    $('#load-area').empty();
                    $('#load-tree').empty();

                    const url = '{!! route('loadstructure.operational_goals.plans_management') !!}';
                    pushRequest(url, '#load-tree', () => {

                    }, 'GET', {'_token': '{!! csrf_token() !!}'}, false);
                });
                $('html, body').animate({scrollTop: 0}, 500);
            }
        };

        $planIndicatorUpdateFm.ajaxForm($.extend(false, $formAjaxDefaults, {
            beforeSubmit: () => {
                $('#btnSaveIndicator').attr("disabled", true)

                let maxGoalValidation = true;
                $.each(viewModel.rows(), (id, row) => {
                    if (!row.validRow) {
                        maxGoalValidation = false;
                    }
                });

                if (!maxGoalValidation) {
                    $('#btnSaveIndicator').removeAttr('disabled')
                    notify('{{ trans('plan_indicators.messages.validation.goal_limit') }}', 'warning');
                }
                return maxGoalValidation;
            },
            success: (response) => {

                if (indicatorableType === '{{ $PlanIndicator::INDICATORABLE_PLAN }}') {
                    processResponsePlan(response);
                } else if (indicatorableType === '{{ $PlanIndicator::INDICATORABLE_COMPONENT }}') {
                    processResponseActivity(response);
                } else if (indicatorableType === '{{ $PlanIndicator::INDICATORABLE_OPERATIONAL_GOAL }}') {
                    processResponseOperationalGoal(response);
                } else {
                    processResponseProject(response);
                }
            }
        }));

        $('span.input-group-addon.remove-file').on('click', (e) => {

            if ((status !== '{{ $Plan::STATUS_VERIFIED }}' && status !== '{{ $Plan::STATUS_APPROVED }}')) {
                let url = "{!! route('destroy.indicator_attachments.full.indicator.plan_elements.plans.plans_management', ['id' => '__ID__']) !!}";
                url = url.replace('__ID__', $(e.currentTarget).attr('data-indicator'));

                pushRequest(url, '#dynamic_files', null, 'DELETE', {
                    _token: '{{ csrf_token() }}',
                    fileId: $(e.currentTarget).attr('data-file')
                }, false);

                $(e.currentTarget).unbind('click')
            }
        });

        @if($justifiable)
        let indicatorSubmit = $('#indicatorSubmit');

        let callback = (data = null, options = null) => {
            pushRequest($planIndicatorUpdateFm.attr('action'), null, () => {
                $('#load-area').empty();
                $('#load-tree').empty();

                const url = '{!! route('loadstructure.edit.plans.plans_management', ['id' => $planId]) !!}'
                pushRequest(url, '#load-tree', () => {

                }, 'GET', {'_token': '{!! csrf_token() !!}'}, false);
            }, 'POST', data, false, options)
        };

        indicatorSubmit.on('click', (e) => {
            e.preventDefault();
            if ($planIndicatorUpdateFm.valid()) {
                justificationModalMultiple(callback, new FormData($planIndicatorUpdateFm[0]), null, '{{ trans('justifications.actions.update') }}', true)
            }
        });
        @endif
    });
</script>