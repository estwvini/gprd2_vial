<table class="table budget_planning" id="budget_tb">
    <thead style="color: #FFFFFF; background-color: #00537f">
    <tr>
        <th rowspan="2">
            {{ trans('reports.project_activities_poa.classifier') }}
        </th>
        <th rowspan="2">
            {{ trans('reports.project_activities_poa.name') }}
        </th>
        <th rowspan="2">
            {{ trans('reports.project_activities_poa.amount') }}
        </th>
        <th rowspan="2">
            {{ trans('reports.project_activities_poa.source') }}
        </th>
        <th colspan="4">
            {{ trans('reports.project_activities_poa.planning') }}
        </th>
    </tr>
    <tr>
        <th>
            {{ trans('reports.project_activities_poa.trim_1') }}
        </th>
        <th>
            {{ trans('reports.project_activities_poa.trim_2') }}
        </th>
        <th>
            {{ trans('reports.project_activities_poa.trim_3') }}
        </th>
        <th>
            {{ trans('reports.project_activities_poa.trim_4') }}
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{ $item->full_code }}</td>
            <td>{{ $item->title }}</td>
            <td class="text-right">{{ number_format($item->amount, 2) }}</td>
            <td>{{ $item->description }}</td>
            <td class="text-right">{{ number_format($item->trim_1, 2) }}</td>
            <td class="text-right">{{ number_format($item->trim_2, 2) }}</td>
            <td class="text-right">{{ number_format($item->trim_3, 2) }}</td>
            <td class="text-right">{{ number_format($item->trim_4, 2) }}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr style="font-weight: bold">
        <td colspan="2">{{ trans('reports.project_activities_poa.total') }}</td>
        <td class="text-right">{{ number_format($items->sum('amount'), 2) }}</td>
        <td></td>
        <td class="text-right">{{ number_format($items->sum('trim_1'), 2) }}</td>
        <td class="text-right">{{ number_format($items->sum('trim_2'), 2) }}</td>
        <td class="text-right">{{ number_format($items->sum('trim_3'), 2) }}</td>
        <td class="text-right">{{ number_format($items->sum('trim_4'), 2) }}</td>
    </tr>
    </tfoot>
</table>