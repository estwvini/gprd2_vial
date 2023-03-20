@permission('index.budget_review.plans_management')
<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('budget_item.labels.review_approvals') }} - {{ \Carbon\Carbon::now()->addYear()->year }}
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row" id="review_content">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row mb-4">
                        <div class="col-md-1">
                            <label class="control-label" for="executing_unit">
                                {{ trans('activities.labels.executingUnit') }}
                            </label>

                        </div>
                        <div class="col-md-4">
                            <select class="form-control" id="executing_unit">
                                <option value="">{{ trans('app.labels.select') }}</option>
                                @foreach($executingUnits as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->code . ' - ' . $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label" for="status">
                                {{ trans('app.headers.status') }}
                            </label>
                            <input type="checkbox" name="status" id="status" class="js-switch"/>
                            {{ trans('activities.labels.approved') }}
                        </div>
                        <div class="text-right pull-right">
                            <a id="export_excel" class="btn pdf-export-button"><i class="fa fa-file-excel-o"></i>
                                {{ trans('reports.export.excel') }}
                            </a>
                        </div>
                    </div>

                    <div class="row tile_count" id="budget_totals">
                        <div class="col-md-5ths col-sm-4 col-xs-6 tile_stats_count">
                            <span class="count_top"><i class="fa fa-usd"></i> {{ trans('app.labels.footer_total') }}</span>
                            <div id="total" class="count adjustment-balance">0</div>
                        </div>
                    </div>

                    <hr>

                    <div class="row" id="bulk-actions" style="display: none;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <button id="approve_btn" class="btn btn-success">
                                <i class="fa fa-check"></i> {{ trans('project_review.labels.approve') }}
                            </button>
                            <span class="action-cnt"></span>
                            <script>
                                $(() => {
                                    $('#approve_btn').on('click', (e) => {
                                        e.preventDefault();
                                        let $table = $('#item_tb');
                                        let checked = $table.find("input[name='table_records']:checked");
                                        let ids = [];
                                        checked.each(function () {
                                            let id = $(this).closest('tr').attr('id');
                                            ids.push(id);
                                        });
                                        $('#checkbox').prop("checked", false);

                                        confirmModal("{{ trans('budget_item.messages.confirm.approve') }}", () => {
                                            pushRequest('{!! route('approve.index.budget_review.plans_management') !!}', null, function () {
                                                $table.DataTable().draw();
                                            }, 'put', {
                                                _token: '{{ csrf_token() }}',
                                                ids: ids
                                            });
                                        });
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    <table class="table" id="item_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>
                                <input type="checkbox" id="checkbox" class="bulk check-all" title="{{ trans('app.labels.select_all') }}"/>
                            </th>
                            <th class="text-right">{{ trans('budget_item.labels.code') }}</th>
                            <th>{{ trans('budget_item.labels.name') }}</th>
                            <th>{{ trans('budget_item.labels.description') }}</th>
                            <th>{{ trans('budget_item.labels.activity') }}</th>
                            <th>{{ trans('budget_item.labels.amount') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script id="itemList" type="text/x-jQuery-tmpl">
    <div class="col-md-5ths col-sm-4 col-xs-6 tile_stats_count">
        <span class="count_top">
            <i class="fa fa-usd"></i> {$code} - {$title}
        </span>
        <div class="count adjustment-balance">{$total}</div>
    </div>
</script>
<script>
    $(() => {
        let $table = build_datatable($('#item_tb'), {
            lengthMenu: [25, 50, 75, 100],
            ajax: {
                url: '{!! route('data.index.budget_review.plans_management') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        status: $('input[type=checkbox][name=status]:checked').val(),
                        executing_unit: $('#executing_unit').val()
                    });
                }
            },
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'bulk_action', width: '3%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'code', width: '25%'},
                {data: 'name', width: '25%'},
                {data: 'description', width: '25%'},
                {data: 'activity', width: '10%'},
                {data: 'amount', width: '10%', class: 'text-center'},
            ],
            fnRowCallback: (nRow, aData) => {
                if (aData.status === '{{ \App\Models\Business\BudgetItem::STATUS_REVIEWED }}') {
                    $(nRow).addClass('tr-status');
                }
            },
            footerCallback: function () {
                let json = this.api().ajax.json();
                $('#budget_totals').html(
                    '<div class="col-md-5ths col-sm-4 col-xs-6 tile_stats_count">' +
                        '<span class="count_top">' +
                            '<i class="fa fa-usd"></i> {{ strtoupper(trans('app.labels.footer_total')) }} </span> ' +
                        '<div id="total" class="count adjustment-balance">' + json.total +'</div>' +
                    '</div>');

                $.each(json.expenseByType, function(index, item) {
                    $('#budget_totals').append(
                        '<div class="col-md-5ths col-sm-4 col-xs-6 tile_stats_count">' +
                            '<span class="count_top">' +
                                '<i class="fa fa-usd"></i> ' + item.title +
                            '</span>' +
                            '<div class="count adjustment-balance format">' + item.total + '</div>' +
                        '</div>'
                    );
                });
                $('.format').number(true, 2);
            }
        });
        $('#executing_unit').on('change', () => {
            $table.draw();
        });

        $('#status').on('change', () => {
            $table.draw();
        });

        $('#export_excel').on('click', (e) => {
            e.preventDefault();

            $.ajax({
                url: '{{ route('export.index.budget_review.plans_management') }}',
                data: {
                    status: $('input[type=checkbox][name=status]:checked').val(),
                    executing_unit: $('#executing_unit').val()
                },
                method: 'GET',
                beforeSend: () => {
                    showLoading();
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: (response) => {
                    let a = document.createElement('a');
                    let url = window.URL.createObjectURL(response);
                    a.href = url;
                    a.download = '{{ trans('app.labels.budget') }}';
                    document.body.append(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                }
            }).always(() => {
                hideLoading();
            });
        });

    });
</script>

@else
    @include('errors.403')
    @endpermission