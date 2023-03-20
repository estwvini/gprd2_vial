@inject('Procedure', '\App\Models\Business\Catalogs\Procedure')
@inject('PublicPurchase', '\App\Models\Business\PublicPurchase')

<table class="table report-table" id="pac_tb">
    <thead>
    <tr>
        <th colspan="19" style="text-align: center; background-color: #B3B3B3; font-weight: bold; font-size: 18px; height: 30px">{{ trans('reports.pac_xls.title') }}</th>
    </tr>
    <tr>
        <th colspan="19"></th>
    </tr>
    <tr>
        <th style="width: 13px">{{ trans('reports.pac_xls.ruc') }}</th>
        <th></th>
    </tr>
    <tr>
        <th colspan="2" style="text-align: center; background-color: #6FB4F6">{{ trans('reports.pac.budget_item_information') }}</th>
        <th colspan="17" style="text-align: center; background-color: #CCFFCC">{{ trans('reports.pac.detailed_product_information') }}</th>
    </tr>
    <tr>
        <th style="background-color: #6FB4F6">{{ trans('reports.pac_xls.year') }}</th>
        <th style="width: 30px; background-color: #6FB4F6">{{ trans('reports.pac_xls.budget_item') }}</th>
        <th style="width: 20px; background-color: #CCFFCC">{{ trans('reports.pac_xls.cpc_code') }}</th>
        <th style="width: 20px; background-color: #CCFFCC">{{ trans('reports.pac_xls.hiring_type') }}</th>
        <th style="width: 60px; background-color: #CCFFCC">{{ trans('reports.pac_xls.product_detail') }}</th>
        <th style="width: 20px; background-color: #CCFFCC">{{ trans('reports.pac_xls.annual_quantity') }}</th>
        <th style="width: 20px; background-color: #CCFFCC">{{ trans('reports.pac_xls.measure_unit') }}</th>
        <th style="width: 20px; background-color: #CCFFCC">{{ trans('reports.pac_xls.cost') }}</th>
        <th style="width: 20px; background-color: #CCFFCC">{{ trans('reports.pac_xls.c1') }}</th>
        <th style="width: 20px; background-color: #CCFFCC">{{ trans('reports.pac_xls.c2') }}</th>
        <th style="width: 20px; background-color: #CCFFCC">{{ trans('reports.pac_xls.c3') }}</th>
        <th style="width: 20px; background-color: #CCFFCC">{{ trans('reports.pac_xls.normalized_type') }}</th>
        <th style="width: 20px; background-color: #CCFFCC">{{ trans('reports.pac_xls.electronic_catalog') }}</th>
        <th style="width: 20px; background-color: #CCFFCC">{{ trans('reports.pac_xls.procedure') }}</th>
        <th style="width: 20px; background-color: #CCFFCC">{{ trans('reports.pac_xls.bid_funds') }}</th>
        <th style="width: 20px; background-color: #CCFFCC">{{ trans('reports.pac_xls.bid_loan_code') }}</th>
        <th style="width: 20px; background-color: #CCFFCC">{{ trans('reports.pac_xls.bid_project_code') }}</th>
        <th style="width: 20px; background-color: #CCFFCC">{{ trans('reports.pac_xls.regime_type') }}</th>
        <th style="width: 30px; background-color: #CCFFCC">{{ trans('reports.pac_xls.budget_type') }}</th>
    </tr>
    </thead>

    @foreach($rows as $entity)
        <tr>
            <td>{{ $year }}</td>
            <td>{{ substr($entity->budgetItem->code, 0, 31) }}</td>
            <td>{{ $entity->cpcClassifier->code }}</td>
            <td>{{ normalize($entity->hiring_type) }}</td>
            <td>{{ normalize($entity->description) }}</td>
            <td>{{ $entity->quantity }}</td>
            <td>{{ normalize($entity->measureUnit->name) }}</td>
            <td>@if(!$entity->quantity) 0.00 @else {{ number_format(($entity->amount_no_vat / $entity->quantity), 2, '.', '') }} @endif</td>
            <td>{{ $entity->c1 }}</td>
            <td>{{ $entity->c2 }}</td>
            <td>{{ $entity->c3 }}</td>
            <td>{{ $entity->procedure->normalized ? trans('reports.pac_xls.normalized') : trans('reports.pac_xls.not_normalized') }}</td>
            <td>{{ $entity->procedure->id == $Procedure::ELECTRONIC_CATALOG_ID ? trans('reports.pac_xls.yes') : trans('reports.pac_xls.no') }}</td>
            <td>{{ normalize($entity->procedure->name) }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ normalize($entity->regime_type) }}</td>
            <td>{{ normalize($entity->budget_type === $PublicPurchase::BUDGET_TYPE_CURRENT_EXPENDITURE ? trans('reports.pac_xls.budget_type_current_expenditure') : trans('reports.pac_xls.budget_type_project')) }} {{ normalize($entity->budget_type) }}</td>
        </tr>
    @endforeach

</table>

