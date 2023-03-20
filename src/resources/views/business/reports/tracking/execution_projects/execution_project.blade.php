@inject('PlanIndicator', 'App\Models\Business\PlanIndicator')
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <style type="text/css">
        body {
            font-size: 13px;
            font-weight: 400;
            line-height: 1.471;
        }

        table {
            border-spacing: 0;
            border-collapse: collapse;
            background-color: transparent;
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        }

        table tr td,
        table tr th {
            border: 1px solid #ddd;
            padding: 5px;
        }

        table tr th.dark,
        table tr td.dark {
            color: rgba(0, 0, 0, .87);
        }

        table tr th.lite,
        table tr td.lite {
            color: rgba(255, 255, 255, .87);
        }

        .fixed-table {
            table-layout: fixed;
        }

        .page_break {
            page-break-before: always;
        }

        .fw-b {
            font-weight: bold;
        }

        .fs-20 {
            font-size: 20px;
        }

        .text-center {
            text-align: center;
        }

        .mb-5 {
            margin-bottom: 5px;
        }
        .row-title {
            height: 30px;
            font-size: 18px;
        }

        .row-sub-title {
            height: 20px;
            font-size: 14px;
        }

        .cell-title {
            font-weight: bold;
        }

        .circle {
            width: 20px;
            height: 20px;
            border-radius: 50%;
        }

        .bg-success {
            background-color: #43A047;
        }

        .bg-warning {
            background-color: #FDD835;
        }

        .bg-orange-A200 {
            background-color: #FFAB40;
        }

        .bg-danger {
            background-color: #F4511E;
        }

        .bg-grey {
            background-color: #CFD8DC;
        }

        .bg-dark-grey {
            background-color: #607D8B;
        }

        .col-10 {
            width: 83.33333333%;
        }

        .col-1 {
            width: 8.33333333%;
        }

        .report-table tr {
            page-break-inside: avoid
        }

    </style>
</head>
<body>

@foreach($projectFiscalYears as $projectFiscalYear)
    <div class="fs-20 fw-b text-center mb-5">{{ trans('reports.execution_projects.title') }} - {{ $year }}</div><br/>
    <div class="mb-5"><span class="fw-b">{{ trans('reports.execution_projects.current_date') }}: </span>{{ $date }}</div>
    <table class="fixed-table">
        <tbody>
        <tr class="row-title bg-dark-grey">
            <td colspan="12" class="text-center lite fw-b">{{ trans('reports.execution_projects.general_information') }}</td>
        </tr>
        <tr>
            <td colspan="2" class="cell-title col-1">{{ trans('reports.execution_projects.name') }}:</td>
            <td colspan="10" class="col-10">{{ $projectFiscalYear->project->name }}</td>
        </tr>
        <tr>
            <td colspan="2" class="cell-title">{{ trans('reports.execution_projects.strategic_objective') }}:</td>
            <td colspan="10" class="col-10">{{ $projectFiscalYear->project->subProgram->parent->parent->description }}</td>
        </tr>
        <tr>
            <td colspan="2" class="cell-title col-2">{{ trans('reports.execution_projects.program') }}:</td>
            <td colspan="10" class="col-10">{{ $projectFiscalYear->project->subProgram->parent->parent->description }}</td>
        </tr>
        <tr>
            <td colspan="2" class="cell-title col-2">{{ trans('reports.execution_projects.start_date') }}:</td>
            <td colspan="2" class="col-2">{{ $projectFiscalYear->project->date_init }}</td>
            <td colspan="2" class="cell-title col-2">{{ trans('reports.execution_projects.end_date') }}:</td>
            <td colspan="2" class="col-2">{{ $projectFiscalYear->project->date_end }}</td>
            <td colspan="2" class="cell-title col-2">{{ trans('reports.execution_projects.duration') }}:</td>
            <td colspan="2" class="col-2">{{ $projectFiscalYear->project->month_duration }} {{ trans('reports.execution_projects.months') }}</td>
        </tr>
        <tr>
            <td colspan="2" class="cell-title col-1">{{ trans('reports.execution_projects.project_leader') }}:</td>
            <td colspan="3" class="col-3">{{ $projectFiscalYear->project->activeLeader()->fullName() }}</td>
            <td colspan="2" class="cell-title col-1">{{ trans('reports.execution_projects.responsible_unit') }}:</td>
            <td colspan="5" class="col-7">{{ $projectFiscalYear->project->responsibleUnit->name }}</td>
        </tr>
        <tr class="row-title text-center bg-dark-grey fw-b">
            <td colspan="12" class="lite">{{ trans('reports.execution_projects.general_objective') }}</td>
        </tr>
        <tr>
            <td colspan="2" class="cell-title">{{ trans('reports.execution_projects.description') }}:</td>
            <td colspan="9">{{ $projectFiscalYear->project->purpose }}</td>
        </tr>
        <tr>
            <td colspan="12">
                <table class="report-table">
                    <thead>
                    <tr class="row-sub-title bg-grey">
                        <th colspan="12" class="dark">{{ trans('reports.execution_projects.indicators') }}</th>
                    </tr>
                    <tr class="row-sub-title bg-grey">
                        <th width="55%" class="dark">{{ trans('reports.execution_projects.name') }}</th>
                        <th width="10%" class="dark">{{ trans('reports.execution_projects.base_line') }}</th>
                        <th width="10%" class="dark">{{ trans('reports.execution_projects.frequency') }}</th>
                        <th width="10%" class="dark">{{ trans('reports.execution_projects.planned') }}</th>
                        <th width="10%" class="dark">{{ trans('reports.execution_projects.executed') }}</th>
                        <th width="10%" class="dark">{{ trans('reports.execution_projects.percentage') }}</th>
                        <th width="10%" class="dark">{{ trans('reports.execution_projects.state') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projectFiscalYear->project->indicators as $indicator)
                        <tr>
                            <td @if($indicator->measurement_frequency_per_year == $PlanIndicator::BIANNUAL_FREQUENCY) rowspan="2" @endif>{{ $indicator->name }}</td>
                            <td @if($indicator->measurement_frequency_per_year == $PlanIndicator::BIANNUAL_FREQUENCY) rowspan="2" @endif class="text-center">
                                {{ $indicator->base_line }}
                            </td>
                            <td @if($indicator->measurement_frequency_per_year == $PlanIndicator::BIANNUAL_FREQUENCY) rowspan="2" @endif class="text-center">
                                {{ trans('reports.execution_projects.frequency_' . $indicator->measurement_frequency_per_year) }}
                            </td>
                            @if(isset($indicator->planIndicatorGoals) && $indicator->planIndicatorGoals->count())
                                <td class="text-center">
                                    @if($indicator->type == $PlanIndicator::TYPE_TOLERANCE)
                                        {{ $indicator->planIndicatorGoals->first()->min }} - {{ $indicator->planIndicatorGoals->first()->max }}
                                    @else
                                        {{ $indicator->planIndicatorGoals->first()->goal_value }}
                                    @endif
                                </td>
                                <td class="text-center">{{ $indicator->planIndicatorGoals->first()->actual_value }}</td>
                                <td class="text-center">{{ number_format($indicator->planIndicatorGoals->first()->calculatePercentage(), 2) }} %</td>
                                <td>
                                    <div class="circle bg-{{ $indicator->planIndicatorGoals->first()->getThresholdColor() }}" style="margin-left: 40%"></div>
                                </td>
                            @else
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            @endif
                        </tr>
                        @if($indicator->measurement_frequency_per_year == $PlanIndicator::BIANNUAL_FREQUENCY)
                            <tr>
                                @if(isset($indicator->planIndicatorGoals) && $indicator->planIndicatorGoals->count() && $indicator->planIndicatorGoals->get(1))
                                    <td class="text-center">
                                        @if($indicator->type == $PlanIndicator::TYPE_TOLERANCE)
                                            {{ $indicator->planIndicatorGoals->get(1)->min }} - {{ $indicator->planIndicatorGoals->get(1)->max }}
                                        @else
                                            {{ $indicator->planIndicatorGoals->get(1)->goal_value }}
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $indicator->planIndicatorGoals->get(1)->actual_value }}</td>
                                    <td class="text-center">{{ number_format($indicator->planIndicatorGoals->get(1)->calculatePercentage(), 2) }} %</td>
                                    <td>
                                        <div class="circle bg-{{ $indicator->planIndicatorGoals->get(1)->getThresholdColor() }}" style="margin-left: 40%"></div>
                                    </td>
                                @else
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                @endif
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="12" class="row-title text-center bg-dark-grey lite fw-b">{{ trans('reports.execution_projects.budget_progress') }}</td>
        </tr>
        <tr>
            <td colspan="4">
                <div id="budget_chart-{{ $projectFiscalYear->id }}" class="chart-{{ $projectFiscalYear->id }}" data-percent="{{ $projectFiscalYear->percent }}"
                     style="height:300px; width: 300px"></div>
            </td>
            <td colspan="8">
                <table>
                    <thead>
                    <tr class="row-sub-title bg-grey">
                        <th rowspan="2">{{ trans('reports.execution_projects.total_amount') }}</th>
                        <th colspan="11">{{ trans('reports.execution_projects.amount_accrued') }}</th>
                    </tr>
                    <tr class="row-sub-title bg-grey">
                        <th class="dark">{{ trans('reports.execution_projects.encoded') }}</th>
                        <th class="dark">{{ trans('reports.execution_projects.accrued') }}</th>
                        <th class="dark">{{ trans('reports.execution_projects.percentage') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-center">{{ number_format($projectFiscalYear->project->referential_budget, 2) }}</td>
                        <td class="text-center">{{ number_format($projectFiscalYear->encoded, 2) }}</td>
                        <td class="text-center">{{ number_format($projectFiscalYear->accrued, 2) }}</td>
                        <td class="text-center">{{ number_format($projectFiscalYear->percent, 2) }} %</td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="12" class="row-title text-center bg-dark-grey lite fw-b">{{ trans('reports.execution_projects.physical_progress') }}</td>
        </tr>
        <tr>
            <td colspan="4">
                <div id="physical_chart-{{ $projectFiscalYear->id }}" class="chart-{{ $projectFiscalYear->id }}" data-percent="{{ $projectFiscalYear->physical_progress }}"
                     style="height: 300px; width: 300px"></div>
            </td>
            <td colspan="8">
                <table class="report-table">
                    <thead>
                    <tr class="row-sub-title bg-success">
                        <th colspan="12" class="lite">{{ trans('reports.execution_projects.executed_milestone') }}</th>
                    </tr>
                    <tr class="row-sub-title bg-success">
                        <th class="lite">{{ trans('reports.execution_projects.milestone') }}</th>
                        <th class="lite">{{ trans('reports.execution_projects.date') }}</th>
                        <th class="lite">{{ trans('reports.execution_projects.responsible') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projectFiscalYear->executedMilestone as $task)
                        <tr>
                            <td class="text-center">{{ $task->name }}</td>
                            <td class="text-center">{{ $task->due_date }}</td>
                            <td class="text-center">{{ $task->responsible->first()->fullName() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <table class="report-table">
                    <thead>
                    <tr class="row-sub-title bg-danger">
                        <th colspan="12" class="lite">{{ trans('reports.execution_projects.delayed_milestone') }}</th>
                    </tr>
                    <tr class="row-sub-title bg-danger">
                        <th class="lite">{{ trans('reports.execution_projects.milestone') }}</th>
                        <th class="lite">{{ trans('reports.execution_projects.date') }}</th>
                        <th class="lite">{{ trans('reports.execution_projects.responsible') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projectFiscalYear->delayedMilestones as $task)
                        <tr>
                            <td class="text-center">{{ $task->name }}</td>
                            <td class="text-center">{{ $task->date_end }}</td>
                            <td class="text-center">{{ $task->responsible->first()->fullName() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <table class="report-table">
                    <thead>
                    <tr class="row-sub-title bg-orange-A200">
                        <th colspan="12" class="lite">{{ trans('reports.execution_projects.next_milestone') }}</th>
                    </tr>
                    <tr class="row-sub-title bg-orange-A200 lite">
                        <th class="lite">{{ trans('reports.execution_projects.milestone') }}</th>
                        <th class="lite">{{ trans('reports.execution_projects.date') }}</th>
                        <th class="lite">{{ trans('reports.execution_projects.responsible') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($projectFiscalYear->nextMilestone as $task)
                        <tr>
                            <td class="text-center">{{ $task->name }}</td>
                            <td class="text-center">{{ $task->date_end }}</td>
                            <td class="text-center">{{ $task->responsible->first()->fullName() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>

    @if(!$loop->last)
        <div class="page_break"></div>
    @endif
@endforeach

<script src="{{ mix('vendor/gentelella/vendors/echarts/dist/echarts.js') }}"></script>

<script>

    // No ES6 in script

    var option = {
        tooltip: {
            formatter: "{a} <br/>{b} : {c}%"
        },
        animation: false,
        toolbox: {
            show: false,
        },
        series: [
            {
                name: '',
                type: 'gauge',
                splitNumber: 10,
                axisLine: {
                    lineStyle: {
                        color: [[0.7, '#ff4500'], [0.9, '#FDD835'], [1, '#228b22']],
                        width: 8
                    }
                },
                axisTick: {
                    splitNumber: 10,
                    length: 12,
                    lineStyle: {
                        color: 'auto'
                    }
                },
                axisLabel: {
                    textStyle: {
                        color: 'auto'
                    }
                },
                splitLine: {
                    show: true,
                    length: 30,
                    lineStyle: {
                        color: 'auto'
                    }
                },
                pointer: {
                    width: 5
                },
                title: {
                    show: true,
                    offsetCenter: [0, '-40%'],
                    textStyle: {
                        fontWeight: 'bolder'
                    }
                },
                detail: {
                    formatter: '{value}%',
                    textStyle: {
                        color: 'auto',
                        fontWeight: 'bolder',
                        fontSize: 20
                    }
                },
                data: [{value: 0, name: '{{ trans('reports.execution_projects.progress') }}'}]
            }
        ]
    };
    var elements = document.querySelectorAll("div[class^='chart-']");
    for (var i = 0; i < elements.length; i++) {
        option.series[0].data[0].value = elements[i].getAttribute('data-percent');
        echarts.init(document.getElementById(elements[i].getAttribute('id'))).setOption(option);
    }
</script>

</body>
</html>
