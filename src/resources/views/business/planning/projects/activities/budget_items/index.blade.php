@permission('index.items.activities.projects.plans_management | index.items.operational_activities.current_expenditure_elements.budget.plans_management')

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
        <a href="{{ route('create.items.operational_activities.current_expenditure_elements.budget.plans_management', ['activityId' => $activity->id, 'activityType' => $activityType]) }}"
           class="btn btn-success ajaxify no-scroll-top pull-right">
            <i class="fa fa-plus"></i> {{ trans('budget_item.labels.create') }}
        </a>
    @endif
@else
    <div class="alert alert-warning align-center alert_message" role="alert" @if($difference > 0) style="display: none" @endif>
        {{ trans('activities.messages.validation.not_available_budget') }}
    </div>
    <a href="{{ route('create.items.activities.projects.plans_management', ['activityId' => $activity->id]) }}"
       class="btn btn-success ajaxify no-scroll-top pull-right url_button"
       @if($difference == 0) style="display: none" @endif>
        <i class="fa fa-plus"></i> {{ trans('budget_item.labels.create') }}
    </a>
@endif

<table class="table" id="budget_items_tb">
    <thead>
    <tr>
        <th></th>
        <th>{{ trans('app.labels.actions') }}</th>
        <th>{{ trans('budget_item.labels.amount') }}</th>
        <th>{{ trans('budget_item.labels.item') }}</th>
        <th>{{ trans('app.headers.name') }}</th>
        <th>{{ trans('budget_item.labels.geographic') }}</th>
        <th>{{ trans('budget_item.labels.source') }}</th>
        <th>{{ trans('budget_item.labels.spending_guide') }}</th>
        <th>{{ trans('budget_item.labels.public_purchase') }}</th>
        <th>{{ trans('budget_item.labels.competence') }}</th>
        <th>{{ trans('budget_item.labels.participatory_budget') }}</th>
        <th>{{ trans('budget_item.labels.description') }}</th>
    </tr>
    </thead>

    <tfoot>
    <tr id="tfoot-tr-1">
        <th class="text-right" colspan="2">{{ trans('app.labels.footer_subtotal') }}</th>
        <th class="text-center" id="tfoot-th-subtotal"></th>
        <th colspan="8"></th>
    </tr>
    <tr id="tfoot-tr-2">
        <th class="text-right" colspan="2">{{ trans('app.labels.footer_total') }}</th>
        <th class="text-center" id="tfoot-th-total"></th>
        <th colspan="8"></th>
    </tr>
    </tfoot>
</table>

<script>
    $(() => {
        let route;
        @if(isset($activityType) && $activityType === $BudgetItem::ACTIVITY_TYPE_OPERATIONAL)
            route = '{!! route('data.index.items.operational_activities.current_expenditure_elements.budget.plans_management', ['activityId' => $activity->id, 'activityType' => $activityType]) !!}';
        @else
            route = '{!! route('data.index.items.activities.projects.plans_management', ['activityId' => $activity->id]) !!}';
            let referentialBudget = '{{ $referentialBudget }}'.replace(/[\$,]/g, '') * 1;
            const updateTotals = (planningBudget) => {
                let difference = referentialBudget - planningBudget;
                $('#planningBudget').text(planningBudget).number(true, 2).text(`$ ${$('#planningBudget').text()}`);
                $('#difference').text(difference).number(true, 2).text(`$ ${$('#difference').text()}`);
                if (difference > 0) {
                    $('.url_button').show();
                    $('.alert_message').hide();
                } else {
                    $('.alert_message').show();
                    $('.url_button').hide();
                }
            };
        @endif

        // Recarga la información de control.
        const updateControl = (planningBudget) => {
            let incomes = $('#incomes').val();
            let percentage_of_control = $('#percentage_of_control').val();
            percentage_of_control = incomes * percentage_of_control;
            if (planningBudget > percentage_of_control) {
                $('#div_percentage_of_control').show();
            } else {
                $('#div_percentage_of_control').hide();
            }
        };

        @if(currentUser()->can('data.index.items.activities.projects.plans_management') or currentUser()->can('data.index.items.operational_activities.current_expenditure_elements.budget.plans_management'))
            build_datatable($('#budget_items_tb'), {
                ajax: route,
                scrollX: true,
                responsive: false,
                scrollCollapse: true,
                columns: [
                    {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                    {data: 'actions', width: '10%', class: 'text-center'},
                    {data: 'amount', width: '10%', class: 'text-center'},
                    {data: 'budgetClassifier', width: '7%', class: 'text-center'},
                    {data: 'name', width: '15%'},
                    {data: 'geographicLocation', width: '7%', class: 'text-center'},
                    {data: 'source', width: '5%', class: 'text-center'},
                    {data: 'spendingGuide', width: '7%', class: 'text-center'},
                    {data: 'is_public_purchase', width: '10%', class: 'text-center'},
                    {data: 'competence', width: '7%', class: 'text-center'},
                    {data: 'is_participatory_budget', width: '5%', class: 'text-center'},
                    {data: 'description', width: '15%'},
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
                            i = i.replace(/[\$,]/g, '') * 1;
                        }
                        // check if number is valid.
                        if (Number.isNaN(i)) {
                            return 0;
                        }
                        return i;
                    };

                    // Current page total
                    let pageTotal = api
                        .column(2, {page: 'current'})
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

                    updateControl(numericVal(json.totalActivitiesAmount !== undefined ? json.totalActivitiesAmount : 0.00));

                    @if(!isset($activityType))
                    // Update Totals
                    updateTotals(numericVal(json.totalActivitiesAmount !== undefined ? json.totalActivitiesAmount : 0.00));
                    @endif
                }
            });
        @endif

        $('#no_incomes').on('click', () => {
            notify('{{ trans('budget_item.messages.errors.no_incomes') }}', 'warning');
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission