<table class="table report-table" id="report_tb">
    <thead>
    <tr>
        <th colspan="20">{{ $executingUnit }}</th>
    </tr>
    <tr>
        <th rowspan="2">
            {{ trans('reports.planning_accrued.code') }}
        </th>
        <th rowspan="2">
            {{ trans('reports.planning_accrued.project') }}
        </th>
        <th colspan="3" style="background-color: rgba(0,83,127,0.25) !important;">
            {{ trans('reports.planning_accrued.execution') }}
        </th>
        <th colspan="3" style="background-color: rgba(0,83,127,0.50) !important;">
            {{ trans('reports.planning_accrued.trim_1') }}
        </th>
        <th colspan="3" style="background-color: rgba(0,83,127,0.65) !important;">
            {{ trans('reports.planning_accrued.trim_2') }}
        </th>
        <th colspan="3" style="background-color: rgba(0,83,127,0.80) !important;">
            {{ trans('reports.planning_accrued.trim_3') }}
        </th>
        <th colspan="3" style="background-color: #00537f !important;">
            {{ trans('reports.planning_accrued.trim_4') }}
        </th>
        <th colspan="3" style="background-color: #05212d !important;">
            {{ trans('reports.planning_accrued.index') }}
        </th>
    </tr>
    <tr>
        <th style="background-color: rgba(0,83,127,0.25) !important;">{{ trans('reports.planning_accrued.encoded') }}</th>
        <th style="background-color: rgba(0,83,127,0.25) !important;">{{ trans('reports.planning_accrued.accrued') }}</th>
        <th style="background-color: rgba(0,83,127,0.25) !important;">{{ trans('reports.planning_accrued.percent') }}</th>
        <th style="background-color: rgba(0,83,127,0.50) !important;">{{ trans('reports.planning_accrued.planning') }}</th>
        <th style="background-color: rgba(0,83,127,0.50) !important;">{{ trans('reports.planning_accrued.accrued') }}</th>
        <th style="background-color: rgba(0,83,127,0.50) !important;">{{ trans('reports.planning_accrued.percent') }}</th>
        <th style="background-color: rgba(0,83,127,0.65) !important;">{{ trans('reports.planning_accrued.planning') }}</th>
        <th style="background-color: rgba(0,83,127,0.65) !important;">{{ trans('reports.planning_accrued.accrued') }}</th>
        <th style="background-color: rgba(0,83,127,0.65) !important;">{{ trans('reports.planning_accrued.percent') }}</th>
        <th style="background-color: rgba(0,83,127,0.80) !important;">{{ trans('reports.planning_accrued.planning') }}</th>
        <th style="background-color: rgba(0,83,127,0.80) !important;">{{ trans('reports.planning_accrued.accrued') }}</th>
        <th style="background-color: rgba(0,83,127,0.80) !important;">{{ trans('reports.planning_accrued.percent') }}</th>
        <th style="background-color: #00537f !important;">{{ trans('reports.planning_accrued.planning') }}</th>
        <th style="background-color: #00537f !important;">{{ trans('reports.planning_accrued.accrued') }}</th>
        <th style="background-color: #00537f !important;">{{ trans('reports.planning_accrued.percent') }}</th>
        <th style="background-color: #05212d !important;">{{ trans('reports.planning_accrued.index_trim1') }}</th>
        <th style="background-color: #05212d !important;">{{ trans('reports.planning_accrued.index_trim2') }}</th>
        <th style="background-color: #05212d !important;">{{ trans('reports.planning_accrued.index_trim3') }}</th>
    </tr>
    </thead>
    <tbody>
    @forelse($data as $projectFiscalYear)
        <tr>
            <td>{{ $projectFiscalYear->project->getProgramSubProgramCode() }}</td>
            <td>{{ $projectFiscalYear->project->name }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->encoded, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->accrued, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->budgetExecutionProgress, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->trim_1, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->accruedtrim_1, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->budgetProgressTrim_1, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->trim_2, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->accruedtrim_2, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->budgetProgressTrim_2, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->trim_3, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->accruedtrim_3, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->budgetProgressTrim_3, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->trim_4, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->accruedtrim_4, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->budgetProgressTrim_4, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->indexTrim1, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->indexTrim2, 2) }}</td>
            <td class="text-right">{{ number_format($projectFiscalYear->indexTrim3, 2) }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="20" class="text-center"> {{ trans('reports.planning_accrued.no_project_info') }}</td>
        </tr>
    @endforelse
    </tbody>
    <tfoot>
    <tr style="font-weight: bold" class="text-right">
        <td colspan="2">{{ trans('reports.planning_accrued.total') }}</td>
        <td style="background-color: rgba(0,83,127,0.50) !important;">{{ number_format($data->sum('encoded'), 2) }}</td>
        <td style="background-color: rgba(0,83,127,0.50) !important;">{{ number_format($data->sum('accrued'), 2) }}</td>
        <td style="background-color: rgba(0,83,127,0.50) !important;">
            @if($data->sum('encoded') != 0)
                {{ number_format( ($data->sum('accrued') * 100) / $data->sum('encoded'), 2) }}
            @else
                0.00
            @endif
        </td>
        <td style="background-color: rgba(0,83,127,0.50) !important;">{{ number_format($data->sum('trim_1'), 2) }}</td>
        <td style="background-color: rgba(0,83,127,0.50) !important;">{{ number_format($data->sum('accruedtrim_1'), 2) }}</td>
        <td style="background-color: rgba(0,83,127,0.50) !important;">
            @if($data->sum('trim_1') != 0)
                {{ number_format( ($data->sum('accruedtrim_1') * 100) / $data->sum('trim_1'), 2) }}
            @else
                0.00
            @endif
        </td>
        <td style="background-color: rgba(0,83,127,0.65) !important;">{{ number_format($data->sum('trim_2'), 2) }}</td>
        <td style="background-color: rgba(0,83,127,0.65) !important;">{{ number_format($data->sum('accruedtrim_2'), 2) }}</td>
        <td style="background-color: rgba(0,83,127,0.65) !important;">
            @if($data->sum('trim_2') != 0)
                {{ number_format( ($data->sum('accruedtrim_2') * 100) / $data->sum('trim_2'), 2) }}
            @else
                0.00
            @endif
        </td>
        <td style="background-color: rgba(0,83,127,0.80) !important;">{{ number_format($data->sum('trim_3'), 2) }}</td>
        <td style="background-color: rgba(0,83,127,0.80) !important;">{{ number_format($data->sum('accruedtrim_3'), 2) }}</td>
        <td style="background-color: rgba(0,83,127,0.80) !important;">
            @if($data->sum('trim_3') != 0)
                {{ number_format( ($data->sum('accruedtrim_3') * 100) / $data->sum('trim_3'), 2) }}
            @else
                0.00
            @endif
        </td>
        <td style="background-color: #00537f !important;">{{ number_format($data->sum('trim_4'), 2) }}</td>
        <td style="background-color: #00537f !important;">{{ number_format($data->sum('accruedtrim_4'), 2) }}</td>
        <td style="background-color: #00537f !important;">
            @if($data->sum('trim_4') != 0)
                {{ number_format( ($data->sum('accruedtrim_4') * 100) / $data->sum('trim_4'), 2) }}
            @else
                0.00
            @endif
        </td>
        <td style="background-color: #05212d !important;">
            @if(count($data))
                {{ number_format($data->sum('indexTrim1') / count($data), 2) }}
            @else
                0.00
            @endif
        </td>
        <td style="background-color: #05212d !important;">
            @if(count($data))
                {{ number_format($data->sum('indexTrim2') / count($data), 2) }}
            @else
                0.00
            @endif
        </td>
        <td style="background-color: #05212d !important;">
            @if(count($data))
                {{ number_format($data->sum('indexTrim3') / count($data), 2) }}
            @else
                0.00
            @endif
        </td>
    </tr>
    </tfoot>
</table>
