@permission('index.items.operational_activities.current_expenditure_elements.programmatic_structure.execution | index.items.activities.project.programmatic_structure.execution')

@inject('BudgetItem', '\App\Models\Business\BudgetItem')

@if(isset($activityType) && $activityType === $BudgetItem::ACTIVITY_TYPE_OPERATIONAL)

    @if($incomes === 0)
        <div class="alert alert-warning align-center" role="alert">
            {{ trans('budget_item.messages.errors.no_incomes') }}
        </div>

        <a class="btn btn-success ajaxify pull-right" id="no_incomes">
            <i class="fa fa-plus"></i> {{ trans('budget_item.labels.create') }}
        </a>
    @else
        @permission('create.items.operational_activities.current_expenditure_elements.programmatic_structure.execution')
        <a href="{{ route('create.items.operational_activities.current_expenditure_elements.programmatic_structure.execution', ['activityId' => $activity->id, 'activityType' => $activityType]) }}"
           class="btn btn-success ajaxify no-scroll-top pull-right">
            <i class="fa fa-plus"></i> {{ trans('budget_item.labels.create') }}
        </a>
        @endpermission
    @endif
@else
    @permission('create.items.activities.project.programmatic_structure.execution')
    <a href="{{ route('create.items.activities.project.programmatic_structure.execution', ['activityId' => $activity->id]) }}"
       class="btn btn-success ajaxify no-scroll-top pull-right url_button">
        <i class="fa fa-plus"></i> {{ trans('budget_item.labels.create') }}
    </a>
    @endpermission

@endif

<table class="table" id="budget_items_tb">
    <thead>
    <tr>
        <th></th>
        <th>{{ trans('budget_item.labels.item') }}</th>
        <th>{{ trans('app.headers.name') }}</th>
        <th>{{ trans('budget_item.labels.geographic') }}</th>
        <th>{{ trans('budget_item.labels.source') }}</th>
        <th>{{ trans('budget_item.labels.spending_guide') }}</th>
        <th>{{ trans('budget_item.labels.participatory_budget') }}</th>
        <th>{{ trans('budget_item.labels.competence') }}</th>
        <th>{{ trans('budget_item.labels.public_purchase') }}</th>
        <th>{{ trans('budget_item.labels.amount') }}</th>
        <th>{{ trans('app.labels.actions') }}</th>
    </tr>
    </thead>

    <tfoot>
    <tr id="tfoot-tr-1">
        <th class="text-right" colspan="9">{{ trans('app.labels.footer_subtotal') }}</th>
        <th class="text-center" id="tfoot-th-subtotal"></th>
        <th></th>
    </tr>
    <tr id="tfoot-tr-2">
        <th class="text-right" colspan="9">{{ trans('app.labels.footer_total') }}</th>
        <th class="text-center" id="tfoot-th-total"></th>
        <th></th>
    </tr>
    </tfoot>
</table>

<script>
    $(() => {
        let route;

        @if(isset($activityType) && $activityType === $BudgetItem::ACTIVITY_TYPE_OPERATIONAL)
            route = '{!! route('data.index.items.operational_activities.current_expenditure_elements.programmatic_structure.execution', ['activityId' => $activity->id, 'activityType' => $activityType]) !!}';
        @else
            route = '{!! route('data.index.items.activities.project.programmatic_structure.execution', ['activityId' => $activity->id]) !!}';
        @endif

        build_datatable($('#budget_items_tb'), {
            ajax: {
                url: route,
                "dataSrc": (response) => {
                    if (response.exception !== '') {
                        notify(response.exception, 'warning')
                    }
                    return response.data;
                }
            },
            scrollX: true,
            responsive: false,
            scrollCollapse: true,
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'budgetClassifier', width: '7%', class: 'text-center'},
                {data: 'name', width: '15%'},
                {data: 'geographicLocation', width: '7%', class: 'text-center'},
                {data: 'source', width: '5%', class: 'text-center'},
                {data: 'spendingGuide', width: '7%', class: 'text-center'},
                {data: 'is_participatory_budget', width: '5%', class: 'text-center'},
                {data: 'competence', width: '7%'},
                {data: 'is_public_purchase', width: '10%', class: 'text-center'},
                {data: 'amount', width: '10%', class: 'text-center'},
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
            "fnRowCallback": (nRow) => {
                $(nRow).find('a:first-child:has("> i.fa-check")').bind('click', (e) => {

                    if ($(nRow).hasClass("selected")) {
                        $(nRow).removeClass("selected");
                        $('#public_purchases_list').empty();
                        e.preventDefault();
                    } else {
                        $('tr', '#budget_items_tb').removeClass("selected");
                        $(nRow).addClass("selected");
                    }
                });
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
                    .column(9, {page: 'current'})
                    .data()
                    .reduce((a, b) => {
                        return parseFloat(numericVal(a)) + parseFloat(numericVal(b));
                    }, 0);

                // Update footer
                $('.dataTables_scrollFoot #tfoot-tr-1 #tfoot-th-subtotal').text(
                    pageTotal
                ).number(true, 2).text(`$ ${$('.dataTables_scrollFoot #tfoot-tr-1 #tfoot-th-subtotal').text()}`);
                $('#tfoot-tr-2 #tfoot-th-total').html(
                    '$ ' + (json.totalAmount !== undefined ? json.totalAmount : 0.00)
                );
            }
        });

        $('#no_incomes').on('click', () => {
            notify('{{ trans('budget_item.messages.errors.no_incomes') }}', 'warning');
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission