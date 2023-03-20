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

        .fs-15 {
            font-size: 15px;
        }

        .fs-13 {
            font-size: 13px;
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

@foreach($rows as $row)
    <div class="fs-20 fw-b text-center mb-5">{{ trans('reports.planning_execution_projects.title') }} {{ $date }}</div><br/>
    <div class="mb-5 text-center"><span class="fw-b fs-15">{{ trans('reports.planning_execution_projects.executing_unit_title') }}
            {{ strtoupper($row['project']->executingUnit->name) }} </span></div>
    <div class="mb-5 text-center fs-15">{{ trans('reports.planning_execution_projects.title_description') }}</div>
    <table class="fixed-table">
        <tbody>
        <tr class="row-title bg-dark-grey">
            <td colspan="12" class="text-center lite fw-b">{{ trans('reports.planning_execution_projects.general_information') }}</td>
        </tr>
        <tr>
            <td colspan="2" class="cell-title col-1">{{ trans('reports.planning_execution_projects.project') }}:</td>
            <td colspan="10" class="col-10">{{ $row['project']->name }}</td>
        </tr>
        <tr>
            <td colspan="2" class="cell-title col-1">{{ trans('reports.planning_execution_projects.project_leader') }}:</td>
            <td colspan="10" class="col-10"> {{ $row['project']->activeLeader()->fullName() }} </td>
        </tr>
        <tr>
            <td colspan="2" class="cell-title col-2">{{ trans('reports.planning_execution_projects.start_date') }}:</td>
            <td colspan="10" class="col-10">{{ $row['project']->date_init }}</td>
        </tr>
        <tr>
            <td colspan="2" class="cell-title col-2">{{ trans('reports.planning_execution_projects.end_date') }}:</td>
            <td colspan="10" class="col-10">{{ $row['project']->date_end }}</td>
        </tr>
        <tr>
            <td colspan="12" class="row-title text-center bg-dark-grey lite fw-b">{{ trans('reports.planning_execution_projects.physical_progress') }}</td>
        </tr>
        <tr>
            <td colspan="12" class="col-12 text-center fs-15">{{ $row['projectProgress'] }} %</td>
        </tr>
        <tr>
            <td colspan="12">

                <table class="table report-table">
                    <thead>
                    <tr>
                        <th style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('physical_progress.labels.activity') }}</th>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('physical_progress.labels.quarter1') }}</th>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('physical_progress.labels.quarter2') }}</th>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('physical_progress.labels.quarter3') }}</th>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('physical_progress.labels.quarter4') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($row['progressStructure'] as $activity)
                        <tr>
                            <td>{{ $activity['name'] }}</td>
                            <td>{{ $activity['progress']['q1'] }} %</td>
                            <td>{{ $activity['progress']['q2'] }} %</td>
                            <td>{{ $activity['progress']['q3'] }} %</td>
                            <td>{{ $activity['progress']['q4'] }} %</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('physical_progress.labels.cumulative') }}</td>
                        <td style="text-align: center; background-color: #1abb9c; color: #ffffff; font-weight: bold">{{ number_format($row['cumulative']['q1'], 2) }} %</td>
                        <td style="text-align: center; background-color: #1abb9c; color: #ffffff; font-weight: bold">{{ number_format($row['cumulative']['q2'], 2) }} %</td>
                        <td style="text-align: center; background-color: #1abb9c; color: #ffffff; font-weight: bold">{{ number_format($row['cumulative']['q3'], 2) }} %</td>
                        <td style="text-align: center; background-color: #1abb9c; color: #ffffff; font-weight: bold">{{ number_format($row['cumulative']['q4'], 2) }} %</td>
                    </tr>
                    </tbody>
                </table>

            </td>
        </tr>
        <tr>
            <td colspan="12" class="row-title text-center bg-dark-grey lite fw-b">{{ trans('reports.planning_execution_projects.budget_progress') }}</td>
        </tr>
        <tr>
            <td colspan="12" class="col-12 text-center fs-15">{{ number_format($row['budgetTotals']->budget_execution, 2) }} %</td>
        </tr>
        <tr>
            <td colspan="2" class="cell-title col-2">{{ trans('reports.planning_execution_projects.encoded') }}:</td>
            <td colspan="2" class="col-2">{{ number_format($row['budgetTotals']->encoded, 2) }}</td>
            <td colspan="2" class="cell-title col-2">{{ trans('reports.planning_execution_projects.accrued') }}:</td>
            <td colspan="2" class="col-2">{{ number_format($row['budgetTotals']->accrued, 2) }}</td>
            <td colspan="2" class="cell-title col-2">{{ trans('reports.planning_execution_projects.for_accrued') }}:</td>
            <td colspan="2" class="col-2">{{ number_format($row['budgetTotals']->encoded - $row['budgetTotals']->accrued, 2) }}</td>
        </tr>
        <tr>
            <td colspan="12">
                <table class="table report-table" id="tracking_project_tb">
                    <thead>
                    <tr>
                        <th rowspan="2"
                            style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.activity') }}</th>
                        <th rowspan="2"
                            style="text-align: center; background-color: #1abb9c; width: 50px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.budget_item') }}</th>
                        <th rowspan="2"
                            style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.encoded') }}</th>
                        <th rowspan="2"
                            style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.accrued') }}</th>
                        <th rowspan="2"
                            style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.budget_execution') }}</th>
                        <th colspan="12"
                            style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.accrued') }}</th>
                    </tr>
                    <tr>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.jan') }}</th>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.feb') }}</th>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.mar') }}</th>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.apr') }}</th>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.may') }}</th>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.jun') }}</th>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.jul') }}</th>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.aug') }}</th>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.sep') }}</th>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.oct') }}</th>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.nov') }}</th>
                        <th style="text-align: center; background-color: #1abb9c; width: 15px; color: #ffffff; font-weight: bold">{{ trans('budget_project_tracking.labels.dec') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($row['budgetData'] as $row)
                        <tr>
                            <td>{{ $row->activity }}</td>
                            <td>{!! $row->budget_item !!}</td>
                            <td>{{ $row->encoded }}</td>
                            <td>{{ $row->accrued_aggregated }}</td>
                            <td>{{ $row->budget_execution }}</td>
                            <td>{{ $row->jan_accrued }}</td>
                            <td>{{ $row->feb_accrued }}</td>
                            <td>{{ $row->mar_accrued }}</td>
                            <td>{{ $row->apr_accrued }}</td>
                            <td>{{ $row->may_accrued }}</td>
                            <td>{{ $row->jun_accrued }}</td>
                            <td>{{ $row->jul_accrued }}</td>
                            <td>{{ $row->aug_accrued }}</td>
                            <td>{{ $row->sep_accrued }}</td>
                            <td>{{ $row->oct_accrued }}</td>
                            <td>{{ $row->nov_accrued }}</td>
                            <td>{{ $row->dec_accrued }}</td>
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

</body>
</html>