<table class="table report-table">
    <thead>
    <tr>
        <th colspan="11" style="text-align: center; background-color: #B3B3B3; font-weight: bold; font-size: 18px; height: 30px">{{ $reportTitle }}</th>
    </tr>
    <tr>
        <th colspan="11"></th>
    </tr>
    <tr>
        <th style="background-color: #B3B3B3; font-weight: bold;">{{trans('reports.budget_card.movements.date')}}</th>
        <th colspan="10">{{ $date }}</th>
    </tr>
    <tr>
        <th style="background-color: #B3B3B3; font-weight: bold;">{{trans('reports.budget_card.level')}}</th>
        <th colspan="10">{{ $levelDescription }}</th>
    </tr>
    <tr>
        <th colspan="11"></th>
    </tr>
    <tr>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 35px; height: 30px">{{ trans('reports.budget_card.item') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 35px">{{ trans('reports.budget_card.name') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 15px">{{ trans('reports.budget_card.assigned') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 15px">{{ trans('reports.budget_card.reform') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 15px">{{ trans('reports.budget_card.encoded') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 15px">{{ trans('reports.budget_card.certified') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 15px">{{ trans('reports.budget_card.committed') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 15px">{{ trans('reports.budget_card.accrued') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 15px">{{ trans('reports.budget_card.by_committed') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 15px">{{ trans('reports.budget_card.by_accrued') }}</th>
        <th style="text-align: center; background-color: #B3B3B3; font-weight: bold; width: 15px">{{ trans('reports.budget_card.paid') }}</th>
    </tr>
    </thead>
    @foreach($rows as $entity)
        <tr>
            <td style="height: 30px">{{ $entity->cuenta }}</td>
            <td>{{ $entity->nom_cue }}</td>
            <td>{{ $entity->asig_ini }}</td>
            <td>{{ $entity->reformas }}</td>
            <td>{{ $entity->codificado }}</td>
            <td>{{ $entity->certificado  }}</td>
            <td>{{ $entity->comprometido  }}</td>
            <td>{{ $entity->devengado  }}</td>
            <td>{{ $entity->por_comprometer_real  }}</td>
            <td>{{ $entity->por_devengar  }}</td>
            <td>{{ $entity->pagado  }}</td>
        </tr>
    @endforeach
</table>