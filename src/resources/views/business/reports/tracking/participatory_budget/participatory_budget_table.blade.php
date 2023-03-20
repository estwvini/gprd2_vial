<table class="table report-table" id="poa_tb">
    <thead>
    <tr>
        <th colspan="12"
            style="text-align: center; background-color: #B3B3B3; font-weight: bold; font-size: 18px; height: 30px">{{ trans('reports.participatory_budget.title') }}</th>
    </tr>
    <tr>
        <th colspan="12"></th>
    </tr>
    <tr>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 20px ;height: 60px">{{ trans('reports.participatory_budget.location') }}</th>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 20px ;height: 60px">{{ trans('reports.participatory_budget.code') }}</th>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 20px ;height: 60px">{{ trans('reports.participatory_budget.name') }}</th>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 20px ;height: 60px">{{ trans('reports.participatory_budget.initial_assigned') }}</th>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #FFFFFF; width: 20px ;height: 60px">{{ trans('reports.participatory_budget.encoded') }}</th>
        <th colspan="2" style="text-align: center; background-color: #6463b9; color: #ffffff; width: 20px ;height: 60px">{{ trans('reports.participatory_budget.accrued') }}</th>
    </tr>
    </thead>
    @foreach($rows as $entity)
        <tr>
            <td colspan="2">{{ $entity->geographic_location->description }}</td>
            <td colspan="2">{{ $entity->budget_classifier->full_code }}</td>
            <td colspan="2">{{ $entity->description }}</td>
            <td colspan="2">{{ $entity->assigned }}</td>
            <td colspan="2">{{ $entity->encoded }}</td>
            <td colspan="2">{{ $entity->total_accrued }}</td>
        </tr>
    @endforeach
</table>