@permission('index.reforms.reforms_reprogramming.execution')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('reforms.title') }}
                <small>{{ trans('app.labels.tracking') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-money"></i> {{ trans('reforms.title') }}
                    </h2>
                    @if($checkPEI)
                        @permission('create.reforms.reforms_reprogramming.execution')
                        <ul class="nav navbar-right panel_toolbox">
                            <li class="pull-right">
                                <button href="{{ route('create.reforms.reforms_reprogramming.execution') }}" class="btn btn-box-tool" id="create-reform">
                                    <i class="fa fa-plus"></i> {{ trans('reforms.labels.create') }}
                                </button>
                            </li>
                        </ul>
                        @endpermission
                    @endif

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    @if(!$checkPEI)
                        <div class="alert alert-warning align-center" role="alert">
                            {{ trans('indicator_tracking.messages.validations.noApprovedPEI') }}
                        </div>
                    @else

                        <div class="row vertical-align-end">
                            <div class="form-group col-md-2">
                                <label class="control-label" for="status">
                                    {{ trans('reforms.labels.state') }}
                                </label>
                                <select class="form-control select2" id="status" data-column="1">
                                    <option value="0">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>
                                    <option value="{{ trans('reforms.labels.status_3') }}">{{ trans('reforms.labels.status_3') }}</option>
                                    <option value="{{ trans('reforms.labels.status_2') }}">{{ trans('reforms.labels.status_2') }}</option>
                                    <option value="{{ trans('reforms.labels.status_1') }}">{{ trans('reforms.labels.status_1') }}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label class="control-label" for="type">
                                    {{ trans('reforms.labels.type') }}
                                </label>
                                <select class="form-control select2" id="type" data-column="3">
                                    <option value="0">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>
                                    <option value="{{ trans('reforms.labels.type_transfer') }}">{{ trans('reforms.labels.type_transfer') }}</option>
                                    <option value="{{ trans('reforms.labels.type_increase') }}">{{ trans('reforms.labels.type_increase') }}</option>
                                    <option value="{{ trans('reforms.labels.type_decrease') }}">{{ trans('reforms.labels.type_decrease') }}</option>
                                </select>
                            </div>

                            <div class="form-group col-md-2">
                                <label class="control-label" for="date_from">
                                    {{ trans('reforms.labels.from') }}
                                </label>
                                <div class="input-group mb-0">
                                    <input type="text" class="form-control picker readonly-white" id="date_from" autocomplete="off" readonly>
                                    <span class="input-group-addon clear-selection"
                                          data-toggle="tooltip"
                                          data-placement="right"
                                          data-original-title="{{ trans('app.labels.clear_selection') }}">
                                    <span class="glyphicon glyphicon-erase"></span>
                                </span>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <label class="control-label" for="date_to">
                                    {{ trans('reforms.labels.to') }}
                                </label>
                                <div class="input-group mb-0">
                                    <input type="text" class="form-control picker readonly-white" id="date_to" autocomplete="off" readonly>
                                    <span class="input-group-addon clear-selection"
                                          data-toggle="tooltip"
                                          data-placement="right"
                                          data-original-title="{{ trans('app.labels.clear_selection') }}">
                                    <span class="glyphicon glyphicon-erase"></span>
                                </span>
                                </div>
                            </div>
                        </div>
                        <table class="table table-striped" id="reforms_tb">
                            <thead>
                            <tr>
                                <th>{{ trans('reforms.labels.number') }}</th>
                                <th>{{ trans('reforms.labels.state') }}</th>
                                <th>{{ trans('reforms.labels.approved_date') }}</th>
                                <th>{{ trans('reforms.labels.type') }}</th>
                                <th>{{ trans('reforms.labels.description') }}</th>
                                <th>{{ trans('reforms.labels.budget_type_income') }}</th>
                                <th>{{ trans('reforms.labels.budget_type_expense') }}</th>
                                <th>{{ trans('app.labels.actions') }}</th>
                            </tr>
                            </thead>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        @if($checkPEI)
        let reformsTable = build_datatable($('#reforms_tb'), {
            ajax: {
                url: '{!! route('data.index.reforms.reforms_reprogramming.execution') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        "filters": {
                            date_from: $("#date_from").val(),
                            date_to: $("#date_to").val()
                        }
                    });
                },
                "dataSrc": (response) => {
                    if (response.exception !== '') {
                        notify(response.exception, 'warning')
                    }
                    return response.data;
                }
            },
            columns: [
                {data: 'operation_number', sortable: false, width: '5%', class: 'text-center'},
                {data: 'state', width: '10%', class: 'text-center'},
                {data: 'approved_date', width: '10%', class: 'text-center'},
                {data: 'type', width: '10%', class: 'text-center'},
                {data: 'description', width: '30%'},
                {data: 'total_credit', width: '10%', class: 'text-center'},
                {data: 'total_debit', width: '10%', class: 'text-center'},
                {data: 'actions', width: '15%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

        $('.select2').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', (e) => {

            // If the value of the option is 0 clear the search in that column
            if ($(e.currentTarget).val() === '0') {
                reformsTable
                    .column($(e.currentTarget).data('column'))
                    .search('')
                    .draw();
            } else if (reformsTable.column($(e.currentTarget).data('column')).search() !== $(e.currentTarget).val()) {
                reformsTable
                    .column($(e.currentTarget).data('column'))
                    .search($(e.currentTarget).val())
                    .draw();
            }
        });

        $('.picker').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: 'es-es',
            useCurrent: false,
            ignoreReadonly: true
        });

        $('.picker').on('dp.change', () => {
            reformsTable.draw();
        });

        $('.input-group').each((index, element) => {
            let input = $(element).find('input');
            $(element).find('span.input-group-addon').on('click', () => {
                input.val(null).trigger('change');
                input.datetimepicker('show');
            })
        });

        $('#create-reform').on('click', () => {
            confirmModal("{{ trans('reforms.messages.actions.create') }}", () => {
                pushRequest('{!! route('create.reforms.reforms_reprogramming.execution') !!}');
            });
        });
        @endif
    })
</script>

@else
    @include('errors.403')
    @endpermission
