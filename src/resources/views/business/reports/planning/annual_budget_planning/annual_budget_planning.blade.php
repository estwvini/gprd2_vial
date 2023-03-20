@permission('annual_budget_planning.reports')
<div class="page-title">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h3>{{ trans('app.labels.reports') }}</h3>
        <h2>
            <i class="fa fa-list-alt"></i> {{ trans('reports.annual_budget_planning.title') }}
        </h2>
        <div class="clearfix"></div>
    </div>
</div>
<div class="clearfix"></div>

<div class="row mb-15">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="title_left">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <h6>{{ trans('reports.labels.select_year') }}</h6>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            @if(count($years))
                                <select class="form-control select2" id="years" name="years">
                                    @foreach($years as $year)
                                        <option value="{{ $year->id }}" @if($year->year == $currentYear) selected @endif >{{ $year->year }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <h6>{{ trans('reports.labels.executing_unit') }}</h6>
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control select2 select2_type" id="executing_unit_id" name="executing_unit_id">
                                <option value="">{{ trans('app.labels.select') }}</option>
                                @foreach($executingUnits as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 mt-3">
                        <div class="text-right pull-right">
                            @permission('export.annual_budget_planning.reports')
                            <a id="export_excel" class="btn pdf-export-button" href=""><i
                                        class="fa fa-file-excel-o"></i> {{ trans('reports.export.excel') }}
                            </a>
                            @endpermission
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table class="table report-table" id="ppi_tb">
                    <thead>
                    <tr>
                        <th></th>
                        <th>{{ trans('reports/planning/ppi.labels.header.objective_description') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.program_name') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.project_name') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.executing_unit') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.component') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.activity') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.referential_budget') }}</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th></th>
                        <th colspan="6">{{ trans('reports/planning/ppi.labels.footer.total_budget') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.footer.total') }}</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
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

        $('.select2').select2({});

        let yearSelected = $("#years").val();

        let export_url = '{{ route('export.annual_budget_planning.reports', ['fiscalYearId' => '__FISCAL_YEAR__']) }}';
        export_url = export_url.replace('__FISCAL_YEAR__', yearSelected);
        $('#export_excel').attr('href', export_url);

        let dataTable = build_datatable($('#ppi_tb'), {
            dom: 'tr',
            ajax: {
                url: '{!! route('data.annual_budget_planning.reports') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        "fiscalYearId": $('#years').val(),
                        "departmentId": $('#executing_unit_id').val()
                    });
                }
            },
            paging: false,
            responsive: false,
            scrollX: true,
            scrollY: '400px',
            columns: [
                {data: 'objective_id', visible: false, sortable: false, searchable: false},
                {data: 'objective_description', width: '20%', sortable: false, searchable: false},
                {data: 'program_name', width: '14%', sortable: false, searchable: false},
                {data: 'project_name', width: '14%', sortable: false, searchable: false},
                {data: 'executing_unit', width: '14%', sortable: false, searchable: false},
                {data: 'component', width: '14%', sortable: false, searchable: false},
                {data: 'activity', width: '14%', sortable: false, searchable: false},
                {data: 'referential_budget', width: '10%', sortable: false, searchable: false, class: "text-center"},
            ],
            initComplete: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            drawCallback: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            rowsGroup: [1, 2, 3, 4, 5, 6, 7],
            footerCallback: function (row, data, start, end, display) {
                let api = this.api(), json = api.ajax.json();

                // Update footer
                $(api.column(7).footer()).html(
                    '{{ trans('reports.labels.footer.total') }}'.replace(':totalBudget', json.totalBudget)
                );
            }
        });

        $("#years, #executing_unit_id").on('change', () => {

            yearSelected = parseInt($("#years").val());

            let export_url = '{{ route('export.annual_budget_planning.reports', ['fiscalYearId' => '__FISCAL_YEAR__', 'departmentId' => '__DEPARTMENT_ID__']) }}';
            export_url = export_url.replace('__FISCAL_YEAR__', yearSelected);
            export_url = export_url.replace('__DEPARTMENT_ID__', $('#executing_unit_id').val());
            $('#export_excel').attr('href', export_url);

            dataTable.draw();
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission