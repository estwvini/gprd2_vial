@permission('purchases.items.activities.projects_review.plans_management')

<fieldset id="budgets_fieldset" class="mt-5">
    <legend class="scheduler-border">
        <i class="fa fa-money"></i> {{ trans('public_purchases.labels.item_purchase_list') }}
    </legend>
    <table class="table" id="public_purchase_tb">
        <thead>
        <tr>
            <th></th>
            <th>{{ trans('public_purchases.labels.budget_item') }}</th>
            <th>{{ trans('public_purchases.labels.cpc') }}</th>
            <th>{{ trans('public_purchases.labels.cpc_description') }}</th>
            <th>{{ trans('public_purchases.labels.international_funds') }}</th>
            <th>{{ trans('public_purchases.labels.budget_type') }}</th>
            <th>{{ trans('public_purchases.labels.hiring_type') }}</th>
            <th>{{ trans('public_purchases.labels.measure_unit') }}</th>
            <th>{{ trans('public_purchases.labels.amount_no_vat') }}</th>
            <th>{{ trans('app.labels.actions') }}</th>
        </tr>
        </thead>

        <tfoot>
        <tr id="tfoot-tr-3">
            <th class="text-right" colspan="8">{{ trans('app.labels.footer_subtotal') }}</th>
            <th class="text-center" id="tfoot-th-subtotal"></th>
            <th></th>
        </tr>
        <tr id="tfoot-tr-4">
            <th class="text-right" colspan="8">{{ trans('app.labels.footer_total') }}</th>
            <th class="text-center" id="tfoot-th-total"></th>
            <th></th>
        </tr>
        </tfoot>
    </table>
</fieldset>
<script>
    $(() => {
        build_datatable($('#public_purchase_tb'), {
            ajax: '{!! route('data.purchases.items.activities.projects_review.plans_management', ['budgetItemId' => $budgetItemId]) !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'budgetClassifier', width: '9%', class: 'text-center'},
                {data: 'cpcClassifier', width: '9%', class: 'text-center'},
                {data: 'cpcClassifierDescription', width: '15%'},
                {data: 'is_international_fund', width: '5%', class: 'text-center'},
                {data: 'procedure', width: '10%'},
                {data: 'hiring_type', width: '8%', class: 'text-center'},
                {data: 'measureUnit', width: '8%', class: 'text-center'},
                {data: 'amount_no_vat', width: '9%', class: 'text-center'},
                {data: 'actions', width: '10%', class: 'text-center'}
            ],
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
                    .column(8, {page: 'current'})
                    .data()
                    .reduce((a, b) => {
                        return parseFloat(numericVal(a)) + parseFloat(numericVal(b));
                    }, 0);

                // Update footer
                $('#tfoot-tr-3 #tfoot-th-subtotal').text(
                    pageTotal
                ).number(true, 2).text(`$ ${$('#tfoot-tr-3 #tfoot-th-subtotal').text()}`);
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