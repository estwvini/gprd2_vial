<table class="table report-table">
    <thead>
    <tr>
        <th colspan="5" style="text-align: center; background-color: #B3B3B3; font-weight: bold; font-size: 18px; height: 30px">
            {{ trans('app.labels.budget') }} {{ $departmentName != '' ? ' - ' . $departmentName: '' }}
        </th>
    </tr>
    <tr>
        <th class="text-right" style="width: 60px; font-weight: bold; background-color: #B3B3B3">{{ trans('budget_item.labels.code') }}</th>
        <th style="width: 50px; font-weight: bold; background-color: #B3B3B3">{{ trans('budget_item.labels.name') }}</th>
        <th style="width: 50px; font-weight: bold; background-color: #B3B3B3">{{ trans('budget_item.labels.description') }}</th>
        <th style="width: 50px; font-weight: bold; background-color: #B3B3B3">{{ trans('budget_item.labels.activity') }}</th>
        <th style="width: 20px; font-weight: bold; background-color: #B3B3B3">{{ trans('budget_item.labels.amount') }}</th>
    </tr>
    </thead>

    @foreach($rows as $entity)
        <tr>
            <td>{{ $entity->code }}</td>
            <td>{{ $entity->name }}</td>
            <td>{{ $entity->description }}</td>
            <td>{{ $entity->activityProjectFiscalYear ? $entity->activityProjectFiscalYear->name : $entity->operationalActivity->name }}</td>
            <td>{{ number_format($entity->amount, 2, '.', '') }}</td>
        </tr>
    @endforeach

</table>

