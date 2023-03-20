<table class="table report-table" id="sectorial_plans_tb">
    <thead>
    <tr>
        <th><b>{{ trans('plans.labels.sectorial_plan') }}</b></th>
        <th><b>{{ trans('plan_elements.labels.OBJECTIVE') }}</b></th>
        <th><b>{{ trans('plan_elements.labels.PROGRAM') }}</b></th>
        <th><b>{{ trans('plan_elements.labels.SUBPROGRAM') }}</b></th>
    </tr>
    </thead>
    @if($rows->count())
        @foreach($rows as $row)
            <tr>
                @foreach($row as $column)
                    <td @if($column['text'] === '') style="min-width: 100px;" @endif rowspan="{{ $column['rowspan'] }}">{!! $column['text'] !!}</td>
                @endforeach
            </tr>
        @endforeach
    @else
        <tr>
            <td colspan="4"> {{ trans('reports.exceptions.no_plan_elements') }} </td>
        </tr>
    @endif
</table>