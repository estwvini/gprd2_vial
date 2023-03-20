@permission('index.budget_adjustment.budget.plans_management')
@include('business.planning.partials.justification.form', ['action' => trans('justifications.actions.approve'), 'form' => true])
@inject('BudgetItem', '\App\Models\Business\BudgetItem')
<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('budget_adjustment.title') }}
                <small>{{ trans('app.labels.budget') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row tile_count col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-5ths col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-usd"></i> {{ trans('budget_adjustment.labels.start_value') }}</span>
            <div id="icome" class="count adjustment-balance">{{ $starValue }}</div>
        </div>
        <div class="col-md-5ths col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-usd"></i> {{ trans('budget_adjustment.labels.total_spends') }}</span>
            <div id="total_spends" class="count adjustment-balance">{{ $totalSpends }}</div>
        </div>
        <div class="col-md-5ths col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-usd"></i> {{ trans('budget_adjustment.labels.balance') }}</span>
            <div id="balance" class="count text-danger adjustment-balance">{{ $balance }}</div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">

                    <div class="row">
                        <h2>
                            <i class="fa fa-database"></i> {{ trans('budget_adjustment.labels.projects') }}
                            <span>{{ $year }}</span>
                        </h2>
                    </div>
                    <table class="table table-striped" id="projects_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>
                                @if(isset($approved) && !$approved)
                                    <i role="button" data-toggle="tooltip" data-placement="top"
                                       data-original-title="{{ trans('budget_adjustment.labels.bulk_actions_tooltip') }}"
                                       class="fa fa-info-circle blue"></i>
                                    <input type="checkbox" id="checkbox" class="bulk check-all"
                                           title="{{ trans('app.labels.select_all') }}"/>
                                @endif
                            </th>
                            <th>{{ trans('app.headers.name') }}</th>
                            <th>{{ trans('projects.labels.annual_budget') }}</th>
                            <th>{{ trans('projects.labels.budget_value') }}</th>
                            <th>{{ trans('app.labels.actions') }}</th>
                        </tr>
                        </thead>
                    </table>

                    <div class="form-group col-md-offset-3 col-md-6 col-sm-6 col-xs-12">
                        <label class="control-label" for="terms_conditions">
                            {{ trans('budget_adjustment.labels.terms') }}
                        </label>
                        <div style="border: 1px solid #e5e5e5; height: 200px; overflow: auto; padding: 10px;">
                            <p>{{ trans('budget_adjustment.labels.terms_conditions') }}</p>
                            <p>{{ trans('budget_adjustment.labels.terms_conditions_2') }}</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6 col-xs-offset-3">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="agree"/> {{ trans('budget_adjustment.labels.agree') }}
                                </label>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 text-center mt-1">
        @if(!$approved)
            <button id="save_btn" name="indicatorSubmit" data-confirm="true" class="btn btn-warning">
                <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
            </button>

            <button id="approve_btn" data-confirm="true" type="submit" class="btn btn-success">
                <i class="fa fa-check"></i> {{ trans('app.labels.approve') }}
            </button>

            <button id="after_proforma_review_btn" data-confirm="true" type="submit" class="btn btn-primary">
                <i class="glyphicon glyphicon-eye-open"></i> {{ trans('proforma.labels.preview_proforma') }}
            </button>
        @else
            @if(isset($synched) && !$synched && api_available())
                <a id="syncProformaBtn" href="{{ route('sync_proforma.budget_adjustment.budget.plans_management') }}" class="btn btn-primary ajaxify">
                    <i class="glyphicon glyphicon-refresh"></i> {{ trans('budget_adjustment.labels.sync_proforma') }}
                </a>
            @endif

            <a id="proformaPreviewBtn" href="{{ route('preview_proforma.budget_adjustment.budget.plans_management') }}" class="btn btn-primary ajaxify">
                <i class="glyphicon glyphicon-eye-open"></i> {{ trans('proforma.labels.preview_proforma') }}
            </a>
        @endif

    </div>
</div>

<script>
    $(() => {
        let $table = $('#projects_tb');

        let income = parseFloat(parseFloat('{{ $starValue }}'.replace(/,/g, '')).toFixed(2));
        let totalSpend = parseFloat(parseFloat('{{ $totalSpends }}'.replace(/,/g, '')).toFixed(2));
        let balance = -1;

        build_datatable($table, {
            dom: '<f<t>r>',
            paging: false,
            ajax: '{!! route('data.index.budget_adjustment.budget.plans_management') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'bulk_action', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'name', width: '30%', sortable: true, searchable: true},
                {data: 'referential_budget', width: '25%', class: 'text-center'},
                {data: 'value_budget', width: '25%', class: 'text-center'},
                {data: 'actions', width: '5%', sortable: false, searchable: false}
            ],
            fnRowCallback: (nRow, aData) => {
                $(nRow).find('input.bulk').on('ifChecked', (e) => {
                    let valueBudget = parseFloat(parseFloat(aData.value_budget.replace(/,/g, '')).toFixed(2));

                    totalSpend = parseFloat(totalSpend.toFixed(2)) + parseFloat(valueBudget.toFixed(2));

                    $('#total_spends').text(totalSpend).number(true, 2);

                    let balance = parseFloat(income.toFixed(2)) - parseFloat(totalSpend.toFixed(2));

                    $('#balance').text(balance).number(true, 2);

                    if (balance < 0) {
                        $('#balance').text(`-${$('#balance').text()}`)
                    }
                });

                $(nRow).find('input.bulk').on('ifUnchecked', (e) => {
                    let valueBudget = parseFloat(parseFloat(aData.value_budget.replace(/,/g, '')).toFixed(2));

                    totalSpend = parseFloat(totalSpend.toFixed(2)) - parseFloat(valueBudget.toFixed(2));

                    $('#total_spends').text(totalSpend).number(true, 2);

                    balance = parseFloat(income.toFixed(2)) - parseFloat(totalSpend.toFixed(2));
                    $('#balance').text(balance).number(true, 2);

                    if (balance < 0) {
                        $('#balance').text(`-${$('#balance').text()}`)
                    }
                });
            }
        });

        $('#save_btn').on('click', (e) => {
            e.preventDefault();

            let action = $(e.currentTarget);
            let confirm = action.attr('data-confirm');
            if (confirm) {

                let checked = $table.find("input[name='table_records']:checked");
                let ids = [];
                checked.each((index, element) => {
                    let id = $(element).closest('tr').attr('id');
                    ids.push(id);
                });

                if (ids.length > 0) {
                    $('#checkbox').prop("checked", false);
                    confirmModal("{{ trans('budget_adjustment.messages.confirm.save') }}", () => {
                        pushRequest('{!! route('edit.budget_adjustment.budget.plans_management') !!}', null, null, 'put', {
                            _token: '{{ csrf_token() }}',
                            ids: ids,
                            balance: balance
                        });
                    });
                } else {
                    notify('{{ trans('budget_adjustment.messages.info.not_empty') }}', 'warning', '{{ trans('app.labels.warning') }}');
                }
            }
        });

        $('#approve_btn').on('click', (e) => {
            e.preventDefault();
            let action = $(e.currentTarget);
            let confirm = action.attr('data-confirm');
            if (confirm) {

                let checked = $table.find("input[name='table_records']:checked");
                let ids = [];
                checked.each((index, element) => {
                    let id = $(element).closest('tr').attr('id');
                    ids.push(id);
                });

                if ($('#agree').prop('checked')) {
                    if (ids.length > 0) {
                        balance = parseFloat(income.toFixed(2)) - parseFloat(totalSpend.toFixed(2));
                        if (balance == 0) {
                            $('#checkbox').prop("checked", false);

                            let callback = (data = null, options = null) => {
                                pushRequest('{!! route('approve.budget_adjustment.budget.plans_management') !!}', null, null, 'POST', data, false, options);
                            };

                            justificationModal(callback, {
                                _token: '{{ csrf_token() }}',
                                ids: ids,
                                balance: balance
                            }, '{{ trans('budget_adjustment.messages.confirm.approve') }}');
                        } else {
                            notify('{{ trans('budget_adjustment.messages.exceptions.balance_not_cero') }}', 'warning', '{{ trans('app.labels.warning') }}');
                        }
                    } else {
                        notify('{{ trans('budget_adjustment.messages.info.not_empty') }}', 'warning', '{{ trans('app.labels.warning') }}');
                    }
                } else {
                    notify('{{ trans('budget_adjustment.messages.info.terms') }}', 'warning', '{{ trans('app.labels.warning') }}');
                }
            }
        });

        $('#after_proforma_review_btn').on('click', (e) => {
            e.preventDefault();
            let action = $(e.currentTarget);
            let confirm = action.attr('data-confirm');
            if (confirm) {
                let checked = $table.find("input[name='table_records']:checked");
                let ids = [];
                checked.each((index, element) => {
                    let id = $(element).closest('tr').attr('id');
                    ids.push(id);
                });
                if (ids.length > 0) {
                    balance = parseFloat(income.toFixed(2)) - parseFloat(totalSpend.toFixed(2));
                    if (balance == 0) {
                        $('#checkbox').prop("checked", false);
                        pushRequest('{{ route('after_preview_proforma.budget_adjustment.budget.plans_management') }}', null, null, 'GET', null);
                    } else {
                        notify('{{ trans('budget_adjustment.messages.exceptions.preview_balance_not_cero') }}', 'warning', '{{ trans('app.labels.warning') }}');
                    }
                } else {
                    notify('{{ trans('budget_adjustment.messages.info.not_empty') }}', 'warning', '{{ trans('app.labels.warning') }}');
                }
            }
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
