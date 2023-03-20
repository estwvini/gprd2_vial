@permission('index.ppi.reports')
<div class="page-title">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('app.labels.reports') }}</h3>
            <h2>
                <i class="fa fa-list-alt"></i> {{ trans('reports/planning/ppi.title') }}
            </h2>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<div class="row mb-15">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel mb-15">
            <div class="x_title">

                <div class="title_left">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <h6>{{ trans('reports.labels.select_year') }}</h6>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            @if(count($years))
                                <select class="form-control select2 select2_type" id="years" name="years">
                                    <option value="">{{ trans('app.labels.select') }}</option>
                                    @foreach($years as $year)
                                        <option value="{{ $year->id }}">{{ $year->year }}</option>
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
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="text-right pull-right mt-3">
                            @permission('export.index.ppi.reports')
                            <a id="export_pdf" class="btn ajaxify pdf-export-button">
                                <i class="fa fa-file-pdf-o"></i>{{ trans('reports/planning/ppi.labels.export.pdf') }}
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
                        <th>{{ trans('reports/planning/ppi.labels.header.program_cup') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.program_name') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.executing_unit') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.project_cup') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.project_name') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.project_year') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.referential_budget') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.articulation') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.zone') }}</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th></th>
                        <th colspan="7">{{ trans('reports/planning/ppi.labels.footer.total_budget') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.footer.total') }}</th>
                        <th></th>
                        <th></th>
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

        let dataTable = build_datatable($('#ppi_tb'), {
            dom: 'tr',
            ajax: {
                url: '{!! route('data.index.ppi.reports') !!}',
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
            scrollY: '700px',
            columns: [
                {data: 'objective_id', visible: false, sortable: false, searchable: false},
                {data: 'objective_description', width: '20%', sortable: false, searchable: false},
                {data: 'program_cup', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'program_name', width: '10%', sortable: false, searchable: false},
                {data: 'executing_unit', width: '10%', sortable: false, searchable: false},
                {data: 'project_cup', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'project_name', width: '10%', sortable: false, searchable: false},
                {data: 'fiscal_year.year', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'referential_budget', width: '10%', sortable: false, searchable: false, class: "text-center"},
                {data: 'articulation', width: '10%', sortable: false, searchable: false},
                {data: 'zone', width: '15%', sortable: false, searchable: false}
            ],
            initComplete: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            drawCallback: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            rowsGroup: [1, 2, 3, 4, 5, 6],
            footerCallback: function (row, data, start, end, display) {
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
                    .column(8, {page: 'current'})
                    .data()
                    .reduce((a, b) => {
                        return numericVal(a) + numericVal(b);
                    }, 0);

                // Update footer
                $(api.column(8).footer()).html(
                    '{{ trans('reports/planning/ppi.labels.footer.total') }}'.replace(':totalBudget', json.totalBudget)
                );
            }
        });

        $("#years, #executing_unit_id").on('change', () => {
            dataTable.draw();
        });

        let logoBase64;

        imgToBase64('{{ mix('images/logo_login.png') }}', function (base64) {
            logoBase64 = base64;
        });

        $('#export_pdf').on('click', () => {
            let startYTable = 70, totalPagesExp = "{total_pages_count_string}";
            let doc = new jsPDF('l', 'mm', 'a3');

            doc.autoTable({
                html: '#ppi_tb',
                theme: 'grid',
                tableWidth: 'auto',
                headStyles: {
                    halign: 'center',
                    lineWidth: '0.5',
                    lineColor: [226, 226, 226]
                },
                styles: {
                    overflow: 'linebreak',
                    cellWidth: 'auto',
                    valign: 'middle',
                    minCellWidth: 20
                },
                columnStyles: {
                    0: {cellWidth: 80},
                    2: {cellWidth: 50},
                    3: {cellWidth: 30},
                    5: {cellWidth: 40},
                    7: {cellWidth: 25}
                },
                showFoot: 'lastPage',
                didDrawPage: (data) => {
                    doc = setDocHeaderAndFooter(data, doc, logoBase64, `{{ trans('reports/planning/ppi.title') }} - ${$('#years option:selected').text()}`, '{{ $gad }}', `{{ trans('app.labels.date') }}: ${moment().format('DD/MM/YYYY')}`, totalPagesExp);
                },
                margin: {top: startYTable}
            });

            if (typeof doc.putTotalPages === 'function') {
                doc.putTotalPages(totalPagesExp);
            }

            doc.save('{{ trans('reports/planning/ppi.title') }}' + '.pdf')
        })

        /**
         * Ajusta tamaño de headers y footers de la tabla cuando se redimensiona la pantalla
         */
        $(window).resize(() => {
            $('#ppi_tb').DataTable().columns.adjust()
            $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
            $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
        })
    });
</script>

@else
    @include('errors.403')
    @endpermission
