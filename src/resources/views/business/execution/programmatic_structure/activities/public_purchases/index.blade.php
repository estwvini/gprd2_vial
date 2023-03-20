@inject('BudgetItem', '\App\Models\Business\BudgetItem')

@permission('index.purchases.items.activities.project.programmatic_structure.execution | index.purchases.items.operational_activities.current_expenditure_elements.programmatic_structure.execution')

<div class="alert alert-warning align-center alert_message" role="alert" @if($difference > 0) style="display: none" @endif>
    {{ trans('public_purchases.messages.exceptions.not_available_budget') }}
</div>
<fieldset id="budgets_fieldset" class="mt-5">
    <legend class="scheduler-border">
        <i class="fa fa-money"></i> {{ trans('public_purchases.labels.item_purchase_list') }}
        @permission('create.purchases.items.activities.project.programmatic_structure.execution | create.purchases.items.operational_activities.current_expenditure_elements.programmatic_structure.execution')

        @if(isset($activityType) && $activityType === $BudgetItem::ACTIVITY_TYPE_OPERATIONAL)
            <a href="{{ route('create.purchases.items.operational_activities.current_expenditure_elements.programmatic_structure.execution', ['budgetItemId' => $budgetItemId,
            'activityTpe' => $activityType])
             }}"
               class="btn btn-success ajaxify no-scroll-top pull-right url_button"
               @if($difference == 0) style="display: none" @endif>
                <i class="fa fa-plus"></i> {{ trans('public_purchases.labels.create') }}
            </a>
        @else
            <a href="{{ route('create.purchases.items.activities.project.programmatic_structure.execution', ['budgetItemId' => $budgetItemId]) }}"
               class="btn btn-success ajaxify no-scroll-top pull-right url_button"
               @if($difference == 0) style="display: none" @endif>
                <i class="fa fa-plus"></i> {{ trans('public_purchases.labels.create') }}
            </a>
        @endif
        @endpermission
    </legend>
    <table class="table" id="public_purchase_tb">
        <thead>
        <tr>
            <th></th>
            <th>{{ trans('public_purchases.labels.budget_item') }}</th>
            <th>{{ trans('public_purchases.labels.cpc') }}</th>
            <th>{{ trans('public_purchases.labels.cpc_description') }}</th>
            <th>{{ trans('public_purchases.labels.international_funds') }}</th>
            <th>{{ trans('public_purchases.labels.procedure') }}</th>
            <th>{{ trans('public_purchases.labels.hiring_type') }}</th>
            <th>{{ trans('public_purchases.labels.measure_unit') }}</th>
            <th>{{ trans('public_purchases.labels.description') }}</th>
            <th>{{ trans('public_purchases.labels.quantity') }}</th>
            <th>{{ trans('public_purchases.labels.amount_no_vat') }}</th>
            <th>{{ trans('app.labels.actions') }}</th>
        </tr>
        </thead>

        <tfoot>
        <tr id="tfoot-tr-3">
            <th class="text-right" colspan="10">{{ trans('app.labels.footer_subtotal') }}</th>
            <th class="text-center" id="tfoot-th-subtotal"></th>
            <th></th>
        </tr>
        <tr id="tfoot-tr-4">
            <th class="text-right" colspan="10">{{ trans('app.labels.footer_total') }}</th>
            <th class="text-center" id="tfoot-th-total"></th>
            <th></th>
        </tr>
        </tfoot>
    </table>
</fieldset>

<script>
    $(() => {
        let route;
        @if(isset($activityType) && $activityType === $BudgetItem::ACTIVITY_TYPE_OPERATIONAL)
            route = '{{ route('data.index.purchases.items.operational_activities.current_expenditure_elements.programmatic_structure.execution', ['budgetItemId' =>
            $budgetItemId, 'activityType' => $activityType]) }}';
        @else
            route = '{{ route('data.index.purchases.items.activities.project.programmatic_structure.execution', ['budgetItemId' => $budgetItemId, 'activityType' => $activityType]) }}';
        @endif
        build_datatable($('#public_purchase_tb'), {
            ajax: route,
            scrollX: true,
            responsive: false,
            scrollCollapse: true,
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'budgetClassifier', width: '9%', class: 'text-center'},
                {data: 'cpcClassifier', width: '9%', class: 'text-center'},
                {data: 'cpcClassifierDescription', width: '15%'},
                {data: 'is_international_fund', width: '5%', class: 'text-center'},
                {data: 'procedure', width: '10%'},
                {data: 'hiring_type', width: '8%', class: 'text-center'},
                {data: 'measureUnit', width: '8%', class: 'text-center'},
                {data: 'description', width: '15%'},
                {data: 'quantity', width: '9%', class: 'text-center'},
                {data: 'amount_no_vat', width: '9%', class: 'text-center'},
                {data: 'actions', width: '10%', class: 'text-center'},
            ],
            initComplete: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            drawCallback: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            footerCallback: function () {
                let api = this.api(), json = api.ajax.json();

                // Remove the formatting to get numeric data for summation
                let numericVal = (i) => {

                    if (typeof i === 'string') {
                        i = i.replace(/[\£,]/g, '') * 1;
                    }
                    // check if number is valid.
                    if (Number.isNaN(i)) {
                        return 0;
                    }
                    return i;
                };

                // Current page total
                let pageTotal = api
                    .column(10, {page: 'current'})
                    .data()
                    .reduce((a, b) => {
                        return parseFloat(numericVal(a)) + parseFloat(numericVal(b));
                    }, 0);

                // Update footer
                $('.dataTables_scrollFoot #tfoot-tr-3 #tfoot-th-subtotal').text(
                    pageTotal
                ).number(true, 2).text(`$ ${$('.dataTables_scrollFoot #tfoot-tr-3 #tfoot-th-subtotal').text()}`);
                $('#tfoot-tr-4 #tfoot-th-total').html(
                    '$ ' + (json.totalAmount !== undefined ? json.totalAmount : 0.00)
                );
            }
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission