@permission('project_dashboard.control_panel')
@inject('ProjectFiscalYear', 'App\Models\Business\Planning\ProjectFiscalYear')
@inject('Task', 'App\Models\Business\Task')
@inject('BudgetItem', 'App\Models\Business\BudgetItem')

@if(!$sfgprovException && !$exception)
    <div class="row tile_count col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-5ths col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-product-hunt"></i> {{ trans('budget_project_tracking.labels.projects_quantity') }}</span>
            <div id="projects_quantity" class="count adjustment-balance"></div>
        </div>
        <div class="col-md-5ths col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-tasks"></i> {{ trans('budget_project_tracking.labels.projects_quantity_risk') }}</span>
            <div id="total_spends" class="count adjustment-balance text-danger">{{ $quantityProjectsAtRisk }}</div>
        </div>
        <div class="col-md-5ths col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-task"></i> {{ trans('budget_project_tracking.labels.projects_quantity_in_time') }}</span>
            <div id="balance" class="count adjustment-balance text-success">{{ $quantityProjectsInTime }}</div>
        </div>
        <div class="col-md-5ths col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-usd"></i> {{ trans('budget_project_tracking.labels.encoded_total') }}</span>
            <div id="icome" class="count adjustment-balance"> {{ $encoded }} </div>
        </div>
        <div class="col-md-5ths col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-usd"></i> {{ trans('budget_project_tracking.labels.accrued_total') }}</span>
            <div id="currentExpenses" class="count adjustment-balance"> {{ $accrued }} </div>
            <span class="count_bottom label @if($percent >= $ProjectFiscalYear::GREEN_LIMIT) label-success @elseif($percent >= $ProjectFiscalYear::ORANGE_LIMIT) label-warning
              @else label-danger @endif">{{ number_format($percent, 2) }}%</span>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <label class="control-label" for="project_id">
                {{ trans('budget_project_tracking.labels.projects') }}
            </label>
            <select class="form-control select2" id="project_id" name="project_id">
                <option value="0">{{ trans('app.labels.all') }}</option>
                @foreach($projectFiscalYears as $pfy)
                    <option value="{{ $pfy->id }}">
                        {{ $pfy->project->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <label class="control-label" for="criteria_id">
                {{ trans('budget_project_tracking.labels.criteria.title') }}
            </label>
            <select class="form-control select2" id="criteria_id" name="criteria_id">
                @foreach($BudgetItem::CRITERIA as $criteria)
                    <option value="{{ $criteria }}" @if($BudgetItem::CRITERIA[1] == $criteria) selected @endif>
                        {{ trans('budget_project_tracking.labels.criteria.' . $criteria) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <h2 class="text-center mt-0">
                        <i class="fa fa-money"></i> {{ trans('budget_project_tracking.labels.encoded_accrued') }}
                    </h2>
                    <div id="projectsBudgetBarChart" class="h-300"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <h2 class="text-center mt-0">
                        <i class="fa fa-money"></i> {{ trans('budget_project_tracking.labels.encoded_accrued_responsible_unit') }}
                    </h2>
                    <div id="criteriaBudgetBarChart" class="h-300"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_content">
                    <h2 class="text-center mt-0">
                        <i class="fa fa-money"></i> {{ trans('budget_project_tracking.labels.projects_progress') }}
                    </h2>
                    <div id="projectsProgressBarChart" class="h-500"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <h2 class="text-center mt-0">
                        <i class="fa fa-product-hunt"></i> {{ trans('budget_project_tracking.labels.projects_status') }}
                    </h2>
                    <div id="projectsStatusPieChart" class="h-300"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <label class="control-label" for="physical_project_id">
                {{ trans('budget_project_tracking.labels.projects') }}
            </label>
            <select class="form-control select2" id="physical_project_id" name="physical_project_id">
                <option value="0">{{ trans('app.labels.all') }}</option>
                @foreach($projectFiscalYears as $pfy)
                    <option value="{{ $pfy->id }}">
                        {{ $pfy->project->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <h2 class="text-center mt-0">
                        <i class="fa fa-tasks"></i> {{ trans('budget_project_tracking.labels.task') }}
                    </h2>
                    <div id="tasksPieChart" style="height:300px;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <h2 class="text-center mt-0">
                        <i class="fa fa-tasks"></i> {{ trans('budget_project_tracking.labels.delayed_tasks') }}
                    </h2>
                    <table class="table scroll-table-x" id="delayedTasksTable">
                        <thead>
                        <tr>
                            <th style="width: 10%">{{ trans('budget_project_tracking.labels.days') }}</th>
                            <th style="width: 40%">{{ trans('budget_project_tracking.labels.task') }}</th>
                            <th style="width: 20%">{{ trans('budget_project_tracking.labels.responsible') }}</th>
                            <th style="width: 15%">{{ trans('budget_project_tracking.labels.due_date') }}</th>
                            <th style="width: 15%">{{ trans('budget_project_tracking.labels.status') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($delayedTasks as $task)
                            <tr id="task_{{ $task->id }}">
                                <td class="text-center">
                                    <span class="badge">{{ \Carbon\Carbon::parse($task->date_end)->diffInDays(now()) }}</span>
                                </td>
                                <td>{{ $task->name }}</td>
                                <td class="text-center">{{ $task->responsible->first()->fullName() }}</td>
                                <td class="text-center"><span class="label label-danger">{{ $task->date_end }}</span></td>
                                <td class="text-center">
                                    @switch($task->status)
                                        @case($Task::STATUS_TO_REVIEW)
                                            <span class="label label-warning">{{ trans('physical_progress.labels.' . $Task::STATUS_TO_REVIEW) }}</span>
                                            @break

                                        @case($Task::STATUS_PENDING)
                                            <span class="label label-primary">{{ trans('physical_progress.labels.' . $Task::STATUS_PENDING) }}</span>
                                            @break

                                        @case($Task::STATUS_REJECTED)
                                            <span class="label label-danger">{{ trans('physical_progress.labels.' . $Task::STATUS_REJECTED) }}</span>
                                            @break

                                        @case($Task::STATUS_DELAYED)
                                            <span class="label label-danger">{{ trans('physical_progress.labels.' . $Task::STATUS_DELAYED) }}</span>
                                            @break

                                    @endswitch
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>

        $(() => {

            // Projects Horizontal Bar
            let projects = $.parseJSON('{!! $projectFiscalYears !!}'.replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t"));

            $('#projects_quantity').text(projects.length);

            let eChartProjectsHBar = echarts.init(document.getElementById('projectsProgressBarChart'));
            let optionProjectsHBarChart = {
                    tooltip: {
                        trigger: 'item',
                        formatter: "{a} <br/>{b} : {c}%"
                    },
                    toolbox: {
                        show: false
                    },
                    color: ['#0e3d84', '#67b7dc'],
                    calculable: true,
                    legend: {
                        data: [
                            '{{ trans('budget_project_tracking.labels.physical_progress') }}',
                            '{{ trans('budget_project_tracking.labels.budgetary_progress') }}'
                        ],
                    },
                    grid: {
                        x: '40%'
                    },
                    xAxis: [
                        {
                            type: 'value',
                            name: '{{ trans('budget_project_tracking.labels.percent_progress') }}',
                            min: 0,
                            max: 100,
                            splitLine: {show: false}
                        }
                    ],
                    yAxis:
                        [
                            {
                                type: 'category',
                                data: [],
                                name: '{{ trans('budget_project_tracking.labels.projects') }}',
                                splitLine: {show: false}
                            }
                        ],
                    series:
                        [
                            {
                                name: '{{ trans('budget_project_tracking.labels.physical_progress') }}',
                                type: 'bar',
                                data: [],
                                markPoint: {
                                    clickable: false,
                                    data: []
                                }
                            }, {
                            name: '{{ trans('budget_project_tracking.labels.budgetary_progress') }}',
                            type: 'bar',
                            data: [],
                            markPoint: {
                                clickable: false,
                                data: []
                            }
                        }
                        ]
                }
            ;

            $.each(projects, (index, value) => {
                optionProjectsHBarChart.yAxis[0].data.push(value.project.name);

                switch (value.physical_semaphore) {
                    case '{{ $ProjectFiscalYear::COLOR_RED }}':
                        optionProjectsHBarChart.series[0].data.push(value.physical_progress);
                        optionProjectsHBarChart.series[0].markPoint.data.push({
                            yAxis: value.project.name,
                            xAxis: value.physical_progress,
                            value: value.physical_progress,
                            symbol: 'circle',
                            symbolSize: 40,
                            itemStyle: {
                                normal: {
                                    color: '#d9534f'
                                }
                            }
                        });
                        break;
                    case '{{ $ProjectFiscalYear::COLOR_ORANGE }}':
                        optionProjectsHBarChart.series[0].data.push(value.physical_progress);
                        optionProjectsHBarChart.series[0].markPoint.data.push({
                            yAxis: value.project.name,
                            xAxis: value.physical_progress,
                            value: value.physical_progress,
                            symbol: 'circle',
                            symbolSize: 40,
                            itemStyle: {
                                normal: {
                                    color: '#f0ad4e',
                                }
                            }
                        });
                        break;
                    case '{{ $ProjectFiscalYear::COLOR_GREEN }}':
                        optionProjectsHBarChart.series[0].data.push(value.physical_progress);
                        optionProjectsHBarChart.series[0].markPoint.data.push({
                            yAxis: value.project.name,
                            xAxis: value.physical_progress,
                            value: value.physical_progress,
                            symbol: 'circle',
                            symbolSize: 40,
                            itemStyle: {
                                normal: {
                                    color: '#15b943'
                                }
                            }
                        });
                        break;
                }

                switch (value.budget_semaphore) {
                    case '{{ $ProjectFiscalYear::COLOR_RED }}':
                        optionProjectsHBarChart.series[1].data.push(value.budgetProgress || 0);
                        optionProjectsHBarChart.series[1].markPoint.data.push({
                            yAxis: value.project.name,
                            xAxis: value.budgetProgress || 0,
                            value: value.budgetProgress || 0,
                            symbol: 'circle',
                            symbolSize: 40,
                            itemStyle: {
                                normal: {
                                    color: '#d9534f'
                                }
                            }
                        });
                        break;
                    case '{{ $ProjectFiscalYear::COLOR_ORANGE }}':
                        optionProjectsHBarChart.series[1].data.push(value.budgetProgress || 0);
                        optionProjectsHBarChart.series[1].markPoint.data.push({
                            yAxis: value.project.name,
                            xAxis: value.budgetProgress || 0,
                            value: value.budgetProgress || 0,
                            symbol: 'circle',
                            symbolSize: 40,
                            itemStyle: {
                                normal: {
                                    color: '#f0ad4e'
                                }
                            }
                        });
                        break;
                    case '{{ $ProjectFiscalYear::COLOR_GREEN }}':
                        optionProjectsHBarChart.series[1].data.push(value.budgetProgress || 0);
                        optionProjectsHBarChart.series[1].markPoint.data.push({
                            yAxis: value.project.name,
                            xAxis: value.budgetProgress || 0,
                            value: value.budgetProgress || 0,
                            symbol: 'circle',
                            symbolSize: 40,
                            itemStyle: {
                                normal: {
                                    color: '#15b943'
                                }
                            }
                        });
                        break;
                }
            });

            eChartProjectsHBar.setOption(optionProjectsHBarChart);
            // End Projects Horizontal Bar

            // Projects Status Pie
            let projectsByStatus = $.parseJSON('{!! $projectsByStatus !!}'.replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t"));
            let eChartProjectsPie = echarts.init(document.getElementById('projectsStatusPieChart'));
            let optionProjectPieChart = {
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                toolbox: {
                    show: false
                },
                calculable: true,
                series: [{
                    name: '{{ trans('budget_project_tracking.labels.projects') }}',
                    type: 'pie',
                    radius: '50%',
                    center: ['50%', '50%'],
                    data: []
                }]
            };

            $.each(projectsByStatus, (index, value) => {
                switch (index) {
                    case '{{ $ProjectFiscalYear::COLOR_RED }}':
                        optionProjectPieChart.series[0].data.push({
                            value: value.length,
                            name: '{{ trans('physical_progress.labels.activityStatus.' . $ProjectFiscalYear::COLOR_RED) }}', itemStyle: {
                                normal: {color: '#d9534f'}
                            }
                        });
                        break;
                    case '{{ $ProjectFiscalYear::COLOR_ORANGE }}':
                        optionProjectPieChart.series[0].data.push({
                            value: value.length,
                            name: '{{ trans('physical_progress.labels.activityStatus.' . $ProjectFiscalYear::COLOR_ORANGE) }}', itemStyle: {
                                normal: {color: '#f0ad4e'}
                            }
                        });
                        break;
                    case '{{ $ProjectFiscalYear::COLOR_GREEN }}':
                        optionProjectPieChart.series[0].data.push({
                            value: value.length,
                            name: '{{ trans('physical_progress.labels.activityStatus.' . $ProjectFiscalYear::COLOR_GREEN) }}', itemStyle: {
                                normal: {color: '#15b943'}
                            }
                        });
                        break;
                }
            });

            eChartProjectsPie.setOption(optionProjectPieChart);
            // End Projects Status Pie

            // Task Status Pie
            let selectPhysicalProject = $('#physical_project_id').select2({
                placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
            }).on('change', () => {
                let url = '{{ route('physical.project_dashboard.control_panel', ['projectFiscalYearId'=> '__ID__']) }}';
                url = url.replace('__ID__', selectPhysicalProject.val());

                pushRequest(url, null, (response) => {
                    if (response) {
                        setTasksChartPie(response.tasks);

                        $("#delayedTasksTable > tbody > tr").hide();

                        $.each(response.delayedTasks, (index, value) => {
                            $(`#task_${value.id}`).show();
                        });
                    }
                }, 'get', null, false)
            });

            let tasks = $.parseJSON('{!! $tasks !!}'.replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t"));
            let eChartPie = echarts.init(document.getElementById('tasksPieChart'));
            let optionTaskPieChart = {
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                toolbox: {
                    show: false
                },
                calculable: true,
                series: [{
                    name: '{{ trans('budget_project_tracking.labels.task') }}',
                    type: 'pie',
                    radius: '50%',
                    data: []
                }]
            };

            /**
             * Actualiza gráfica de tareas por estados
             *
             * @param items
             */
            const setTasksChartPie = (items) => {

                optionTaskPieChart.series[0].data = [];

                $.each(items, (index, value) => {
                    switch (index) {
                        case '{{ $Task::STATUS_TO_REVIEW }}':
                            optionTaskPieChart.series[0].data.push({
                                value: value.length,
                                name: '{{ trans('physical_progress.labels.' . $Task::STATUS_TO_REVIEW) }}', itemStyle: {
                                    normal: {color: '#f0ad4e'}
                                }
                            });
                            break;
                        case '{{ $Task::STATUS_PENDING }}':
                            optionTaskPieChart.series[0].data.push({
                                value: value.length,
                                name: '{{ trans('physical_progress.labels.' . $Task::STATUS_PENDING) }}',
                                itemStyle: {
                                    normal: {color: '#2a77b9'}
                                }
                            });
                            break;
                        case '{{ $Task::STATUS_COMPLETED_ONTIME }}':
                            optionTaskPieChart.series[0].data.push({
                                value: value.length,
                                name: '{{ trans('physical_progress.labels.' . $Task::STATUS_COMPLETED_ONTIME) }}',
                                itemStyle: {
                                    normal: {color: '#15b943'}
                                }
                            });
                            break;
                        case '{{ $Task::STATUS_COMPLETED_OUTOFTIME }}':
                            optionTaskPieChart.series[0].data.push({
                                value: value.length,
                                name: '{{ trans('physical_progress.labels.' . $Task::STATUS_COMPLETED_OUTOFTIME) }}',
                                itemStyle: {
                                    normal: {color: '#d986be'}
                                }
                            });
                            break;
                        case '{{ $Task::STATUS_REJECTED }}':
                            optionTaskPieChart.series[0].data.push({
                                value: value.length,
                                name: '{{ trans('physical_progress.labels.' . $Task::STATUS_REJECTED) }}',
                                itemStyle: {
                                    normal: {color: '#d9534f'}
                                }
                            });
                            break;
                    }
                });

                eChartPie.setOption(optionTaskPieChart);
            };

            setTasksChartPie(tasks);
            // End Task Status Pie

            // Budget Encoded vs Accrued Monthly
            let selectProject = $('#project_id').select2({
                placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
            }).on('change', () => {
                let url = '{{ route('budget_monthly.project_dashboard.control_panel', ['projectFiscalYearId'=> '__ID__']) }}';
                url = url.replace('__ID__', selectProject.val());

                pushRequest(url, null, (response) => {
                    if (response) {
                        setOptionBudgetMonthly(response);
                    }
                }, 'get', null, false)
            });

            let budgetMonthly = $.parseJSON('{!! $budgetMonthly !!}'.replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t"));
            let optionBudgetMonthly = {
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross'
                    }
                },

                calculable: true,
                color: ['#15b943', '#03586A', '#f0ad4e'],
                toolbox: {
                    show: true,
                    feature: {
                        magicType: {
                            show: true,
                            title: {
                                line: '{{ trans('budget_project_tracking.labels.line') }}',
                                bar: '{{ trans('budget_project_tracking.labels.bar') }}'
                            },
                            type: ['line', 'bar']
                        },
                        restore: {
                            show: true,
                            title: '{{ trans('budget_project_tracking.labels.restore') }}'
                        }
                    }
                },
                legend: {
                    data: [
                        "{{ trans('budget_project_tracking.labels.encoded') }}",
                        "{{ trans('budget_project_tracking.labels.accrued') }}",
                        "{{ trans('budget_project_tracking.labels.budget_execution') }}"
                    ]
                },
                xAxis: [
                    {
                        type: 'category',
                        splitLine: {show: false},
                        data: ['{{ trans('budget_project_tracking.labels.jan') }}', '{{ trans('budget_project_tracking.labels.feb') }}',
                            '{{ trans('budget_project_tracking.labels.mar') }}', '{{ trans('budget_project_tracking.labels.apr') }}',
                            '{{ trans('budget_project_tracking.labels.may') }}', '{{ trans('budget_project_tracking.labels.jun') }}',
                            '{{ trans('budget_project_tracking.labels.jul') }}', '{{ trans('budget_project_tracking.labels.aug') }}',
                            '{{ trans('budget_project_tracking.labels.sep') }}', '{{ trans('budget_project_tracking.labels.oct') }}',
                            '{{ trans('budget_project_tracking.labels.nov') }}', '{{ trans('budget_project_tracking.labels.dec') }}']
                    }
                ],
                yAxis: [
                    {
                        type: 'value',
                        name: '{{ trans('budget_project_tracking.labels.budget') }}',
                        position: 'left',
                        splitLine: {show: false},
                        axisLabel: {
                            formatter: '$ {value}'
                        }
                    },
                    {
                        type: 'value',
                        name: "{{ trans('budget_project_tracking.labels.budget_execution') }}",
                        position: 'right',
                        splitLine: {show: false},
                        axisLabel: {
                            formatter: '{value} %'
                        }
                    }
                ],
                series: [
                    {
                        name: "{{ trans('budget_project_tracking.labels.encoded') }}",
                        type: 'bar',
                        data: []
                    },
                    {
                        name: "{{ trans('budget_project_tracking.labels.accrued') }}",
                        type: 'bar',
                        data: []
                    },
                    {
                        name: "{{ trans('budget_project_tracking.labels.budget_execution') }}",
                        type: 'line',
                        yAxisIndex: 1,
                        data: []
                    }
                ]
            };

            let eChartProjectsBudgetBar = echarts.init(document.getElementById('projectsBudgetBarChart'));

            const setOptionBudgetMonthly = (param) => {
                optionBudgetMonthly.series[0].data = [];
                optionBudgetMonthly.series[1].data = [];
                optionBudgetMonthly.series[2].data = [];
                for (let i = 0; i < 12; i++) {
                    optionBudgetMonthly.series[0].data.push(param.encoded[i]);
                    optionBudgetMonthly.series[1].data.push(param.accrued[i]);

                    let percent = param.encoded[i] ? (param.accrued[i] * 100 / param.encoded[i]).toFixed(2) : 0.00;
                    optionBudgetMonthly.series[2].data.push(percent);
                }

                eChartProjectsBudgetBar.setOption(optionBudgetMonthly);
            };

            setOptionBudgetMonthly(budgetMonthly);
            // End Budget Encoded vs Accrued Monthly

            // Budget Encoded vs Accrued By Criteria
            let selectCriteria = $('#criteria_id').select2({
                placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
            }).on('change', () => {
                let url = '{{ route('criteria.project_dashboard.control_panel', ['criteria'=> '__ID__']) }}';
                url = url.replace('__ID__', selectCriteria.val());

                pushRequest(url, null, (response) => {
                    if (response) {
                        setOptionCriteriaChart(response);
                    }
                }, 'get', null, false)
            });

            let budgetByCriteria = $.parseJSON('{!! $budgetByResponsibleUnits !!}'.replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t"));

            let optionCriteria = {
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross'
                    }
                },
                color: ['#15b943', '#03586A', '#f0ad4e'],
                calculable: true,
                toolbox: {
                    show: true,
                    feature: {
                        magicType: {
                            show: true,
                            title: {
                                line: '{{ trans('budget_project_tracking.labels.line') }}',
                                bar: '{{ trans('budget_project_tracking.labels.bar') }}'
                            },
                            type: ['line', 'bar']
                        },
                        restore: {
                            show: true,
                            title: '{{ trans('budget_project_tracking.labels.restore') }}'
                        }
                    }
                },
                legend: {
                    data: [
                        "{{ trans('budget_project_tracking.labels.encoded') }}",
                        "{{ trans('budget_project_tracking.labels.accrued') }}",
                        "{{ trans('budget_project_tracking.labels.budget_execution') }}"
                    ]
                },
                xAxis: [
                    {
                        type: 'category',
                        splitLine: {show: false},
                        data: []
                    }
                ],
                yAxis: [
                    {
                        type: 'value',
                        name: '{{ trans('budget_project_tracking.labels.budget') }}',
                        position: 'left',
                        splitLine: {show: false},
                        axisLabel: {
                            formatter: '$ {value}'
                        }
                    },
                    {
                        type: 'value',
                        name: "{{ trans('budget_project_tracking.labels.budget_execution') }}",
                        position: 'right',
                        splitLine: {show: false},
                        axisLabel: {
                            formatter: '{value} %'
                        }
                    }
                ],
                series: [
                    {
                        name: "{{ trans('budget_project_tracking.labels.encoded') }}",
                        type: 'bar',
                        data: []
                    },
                    {
                        name: "{{ trans('budget_project_tracking.labels.accrued') }}",
                        type: 'bar',
                        data: []
                    },
                    {
                        name: "{{ trans('budget_project_tracking.labels.budget_execution') }}",
                        type: 'line',
                        yAxisIndex: 1,
                        data: []
                    }
                ]
            };

            let budgetCriteriaChart = echarts.init(document.getElementById('criteriaBudgetBarChart'));

            const setOptionCriteriaChart = (param) => {
                optionCriteria.series[0].data = [];
                optionCriteria.series[1].data = [];
                optionCriteria.series[2].data = [];
                optionCriteria.xAxis[0].data = [];

                $.each(param, (index, value) => {
                    let encoded = 0;
                    let accrued = 0;
                    optionCriteria.xAxis[0].data.push(index);
                    $.each(value, (index, value) => {
                        encoded += (parseFloat(value.assigned) || 0) + (parseFloat(value.total_reform) || 0);
                        accrued += parseFloat(value.accrued) || parseFloat(value.total_accrued) || 0;
                    });
                    optionCriteria.series[0].data.push(encoded);
                    optionCriteria.series[1].data.push(accrued);

                    let percent = encoded ? (accrued * 100 / encoded).toFixed(2) : 0.00;
                    optionCriteria.series[2].data.push(percent);
                });

                budgetCriteriaChart.setOption(optionCriteria);
            };

            setOptionCriteriaChart(budgetByCriteria);
            // End Budget Encoded vs Accrued By UR

        });

    </script>
@else
    @include('default_dashboard')
    <script>
        $(() => {
            @if($sfgprovException)
            notify('{{ trans('app.messages.exceptions.sfgprov_not_available') }}', 'warning')
            @endif
        })
    </script>
@endif
@else
    @include('default_dashboard')
    @endpermission
