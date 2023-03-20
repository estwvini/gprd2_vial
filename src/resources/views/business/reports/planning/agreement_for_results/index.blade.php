@permission('agreement_for_results.reports')
<div class="page-title">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h3>{{ trans('app.labels.reports') }}</h3>
        <h2>
            <i class="fa fa-list-alt"></i> {{ trans('reports.agreement_for_results.title') }}
        </h2>
    </div>
</div>
<div class="clearfix"></div>

<div id="report" class="row mb-15">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <form class="form-horizontal" role="form" target="_blank" action="{{ route('export.agreement_for_results.reports') }}" method="get"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="title_left">
                        <div class="form-group">
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <label class="col-md-6 col-sm-6 col-xs-12 control-label text-right" for="executing_unit_id">
                                    {{ trans('reports.labels.executing_unit').':' }}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" name="executingUnitId" id="executing_unit_id">
                                        <option></option>
                                        @foreach($executingUnits as $executingUnit)
                                            <option value="{{ $executingUnit->id }}">{{ $executingUnit->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <label class="col-md-6 col-sm-6 col-xs-12 control-label text-right" for="user_id">
                                    {{ trans('reports.labels.servant').':' }}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" name="userId" id="user_id" disabled></select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <label class="col-md-6 col-sm-6 col-xs-12 control-label text-right" for="fiscal_year_id">
                                    {{ trans('reports.labels.select_year').':' }}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" name="fiscalYearId" id="fiscal_year_id" disabled>
                                        @foreach($fiscalYears as $fiscalYear)
                                            <option value="{{ $fiscalYear->id }}" @if($fiscalYear->year === $currentFiscalYear) selected @endif>{{ $fiscalYear->year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-12">
                                <label class="col-md-6 col-sm-6 col-xs-12 control-label text-right" for="total_advance_id">
                                    {{ trans('reports.agreement_for_results.total_advance').':' }}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label id="total_advance_id" class="form-control-static"></label>
                                </div>
                            </div>

                            @permission('export.agreement_for_results.reports')
                            <button id="export_pdf" type="submit" class="btn pull-right pdf-export-button">
                                <i class="fa fa-file-pdf-o"></i>
                                {{ trans('reports.export.pdf') }}
                            </button>
                            @endpermission
                        </div>
                    </div>
                </form>

                <div class="clearfix"></div>
            </div>
            <div class="x_content overflow-scroll">
                <table class="table report-table" id="agreement_for_results_tb">
                    <thead>
                    <tr>
                        <th><b>{{ trans('reports.agreement_for_results.activity_task') }}</b></th>
                        <th><b>{{ trans('reports.agreement_for_results.due_date') }}</b></th>
                        <th><b>{{ trans('reports.agreement_for_results.advance_log_date') }}</b></th>
                        <th><b>{{ trans('reports.agreement_for_results.completion') }}</b></th>
                        <th><b>{{ trans('reports.agreement_for_results.status') }}</b></th>
                        <th><b>{{ trans('reports.agreement_for_results.semaphore') }}</b></th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

<footer class="navbar-default navbar-fixed-bottom text-center">
    <a id="cancelLinks" href="{{ route('index.reports') }}"
       class="btn btn-info ajaxify">{{ trans('app.labels.backward') }}
    </a>
</footer>

<script>
    $(() => {
        let fiscalYearSelect = $('#fiscal_year_id');
        let userSelect = $('#user_id');
        let executingUnitSelect = $('#executing_unit_id');
        let totalAdvanceValue = $('#total_advance_id');
        let exportButton = $('#export_pdf');
        exportButton.hide();

        fiscalYearSelect.select2();
        executingUnitSelect.select2({
            placeholder: '{{ trans('reports.placeholders.executing_unit') }}'
        });
        userSelect.select2({
            ajax: {
                url: '{{ route('servant_search.agreement_for_results.reports') }}',
                dataType: 'json',
                delay: 100,
                cache: true,
                data: function (params) {
                    return {
                        q: params.term,
                        executingUnitId: executingUnitSelect.find('option:selected').val()
                    };
                },
                processResults: (data) => {
                    return {
                        results: data
                    };
                }
            },
            placeholder: '{{ trans('reports.placeholders.servant') }}'
        });

        let dataTable = build_datatable($('#agreement_for_results_tb'), {
            ajax: {
                url: '{!! route('data.agreement_for_results.reports') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        'userId': !userSelect.find('option:selected').val() ? 0 : parseInt(userSelect.find('option:selected').val()),
                        'fiscalYearId': parseInt(fiscalYearSelect.find('option:selected').val())
                    });
                }
            },
            responsive: false,
            scrollX: true,
            columns: [
                {data: 'activity_task', width: '30%', sortable: false, class: 'text-center'},
                {data: 'due_date', width: '20%', sortable: false, class: 'text-center'},
                {data: 'advance_log_date', width: '20%', class: 'text-center', sortable: false},
                {data: 'completion', width: '10%', class: 'text-center', searchable: false, sortable: false},
                {data: 'status', width: '10%', class: 'text-center', sortable: false},
                {data: 'semaphore', width: '10%', class: 'text-center', searchable: false, sortable: false}
            ],
            initComplete: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
                $('.dataTables_filter').addClass('pull-left');
            },
            drawCallback: function () {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
                $('.dataTables_filter').addClass('pull-left');
                let api = this.api();
                let totalAdvance = !api.ajax.json().totalAdvance ? '' : api.ajax.json().totalAdvance;

                totalAdvanceValue.text(totalAdvance);
            }
        });

        let executingUnitChanged = false;
        executingUnitSelect.on('change', () => {
            if (!executingUnitChanged) {
                userSelect.enable();
                executingUnitChanged = true;
            }
            userSelect.val('').trigger('change');
        });

        let userChanged = false;
        userSelect.on('change', () => {
            if (!userChanged) {
                exportButton.show();
                fiscalYearSelect.enable();
                userChanged = true;
            }
            dataTable.draw();
        });

        fiscalYearSelect.on('change', () => {
            dataTable.draw();
        });

        /**
         * Ajusta tamaño de headers y footers de la tabla cuando se redimensiona la pantalla
         */
        $(window).resize(() => {
            $('#agreement_for_results_tb').DataTable().columns.adjust()
            $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
            $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
        })

    });
</script>

@else
    @include('errors.403')
    @endpermission