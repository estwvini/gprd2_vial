@permission('index.budget_card_expenses.reports')
<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('app.labels.reports') }}</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel mb-15">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-list-alt"></i> {{ trans('reports.budget_card_expenses.title') }}
                    </h2>

                    @permission('export.index.budget_card_expenses.reports')
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a id="export_pdf" class="btn pdf-export-button">
                                <i class="fa fa-file-pdf-o"></i>{{ trans('reports.export.pdf') }}
                            </a>
                        </li>
                    </ul>
                    @endpermission

                    <div class="clearfix"></div>
                </div>
                <div class="x_content mb-15">
                    <div class="row">

                        <div class="form-group col-md-2 col-xs-12">
                            <label class="control-label" for="year">
                                {{ trans('reports.budget_card_expenses.year') }}
                            </label>
                            <select class="form-control" id="year">
                                @foreach($years as $year)
                                    <option value="{{ $year->year }}"
                                            @if($year->year == $currentYear) selected @endif >{{ $year->year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2 col-xs-12 text-center mt-4">
                            <button class="btn btn-success mb-0" id="search">{{ trans('app.labels.search') }}</button>
                        </div>
                    </div>

                    <table class="table report-table" id="budget_card">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('reports.budget_card_expenses.item') }}</th>
                            <th>{{ trans('reports.budget_card_expenses.name') }}</th>
                            <th>{{ trans('reports.budget_card_expenses.assigned') }}</th>
                            <th>{{ trans('reports.budget_card_expenses.reform') }}</th>
                            <th>{{ trans('reports.budget_card_expenses.encoded') }}</th>
                            <th>{{ trans('reports.budget_card_expenses.committed') }}</th>
                            <th>{{ trans('reports.budget_card_expenses.accrued') }}</th>
                            <th>{{ trans('reports.budget_card_expenses.by_committed') }}</th>
                            <th>{{ trans('reports.budget_card_expenses.by_accrued') }}</th>
                            <th>{{ trans('reports.budget_card_expenses.paid') }}</th>
                            <th>{{ trans('reports.budget_card_expenses.percent_run') }}</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th></th>
                            <th colspan="2">{{ trans('reports.budget_card_expenses.total') }}</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
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
        let totales = (data, column) => {
            let api = data.api(), json = api.ajax.json();
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
            let i = 0
            let total = api.column(column, {page: 'current'}).data().reduce((a, b) => {
                let valcolum = api.column(1, {page: 'current'}).data()[i];
                if (valcolum.indexOf('00.00.00') > -1) {
                    b = 0;
                }
                i += 1;
                return numericVal(a) + numericVal(b);
            }, 0);


            // Update footer
            $(api.column(column).footer()).html($.number(total, 2, '.', ','));
            return total;
        };
        let datatable = build_datatable($('#budget_card'), {
            dom: '<t>ir',
            ajax: {
                url: '{!! route('data.index.budget_card_expenses.reports') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        year: $('#year').val()
                    });
                },
                "dataSrc": function (response) {
                    if (response.exception !== '') {
                        notify(response.exception, 'warning')
                    }
                    return response.data;
                }
            },
            paging: false,
            responsive: false,
            scrollX: true,
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false},
                {data: 'partida', width: '10%', sortable: false},
                {data: 'nom_cue', width: '45%', sortable: false},
                {data: 'asig_ini', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'reformas', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'codificado', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'comprometido', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'devengado', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'por_comprometer', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'por_devengar', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'pagado', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'porciento_ejecucion', width: '5%', sortable: false, searchable: false, class: "text-center"},
            ],
            initComplete: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            drawCallback: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            createdRow: function (row, data, index) {
                if (data['partida'].indexOf('00.00.00') > -1) {
                    $(row).addClass('row-subtotal');
                }
            },
            footerCallback: function (row, data, start, end, display) {
                // Current page total
                numcolums = [3, 4, 5, 6, 7, 8, 9, 10];
                data = this;
                let codificado = 0;
                let devengado = 0;
                $.each(numcolums, function (index, value) {
                    let total = totales(data, value);
                    if (value == 5) {
                        codificado = total;
                    }
                    if (value == 7) {
                        devengado = total;
                    }
                });
                let api = data.api(), json = api.ajax.json();
                $(api.column(11).footer()).html($.number(devengado * 100 / codificado, 2, '.', ','));

            }
        });

        $('.select2').select2({});

        $('#search').on('click', () => {
            datatable.draw();
        });
        let logoBase64;

        imgToBase64('{{ mix('images/logo_login.png') }}', function (base64) {
            logoBase64 = base64;
        });
        $('#export_pdf').on('click', (e) => {
            let startYTable = 70, totalPagesExp = "{total_pages_count_string}";
            let doc = new jsPDF('l', 'mm', 'a3');
            doc.autoTable({
                html: '#budget_card',
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
                    minCellWidth: 30
                },
                columnStyles: {
                    2: {halign: 'right'},
                    3: {halign: 'right'},
                    4: {halign: 'right'},
                    5: {halign: 'right'},
                    6: {halign: 'right'},
                    7: {halign: 'right'},
                    8: {halign: 'right'},
                    9: {halign: 'right'},
                    10: {halign: 'right'},
                },
                showFoot: 'lastPage',
                footStyles: {
                    halign: 'right'
                },
                didDrawPage: (data) => {
                    doc = setDocHeaderAndFooter(data, doc, logoBase64, `{{ trans('reports.budget_card_expenses.title') }}`, `{{ trans('reports.budget_card_expenses.year') }}: ${$('#year option:selected').text()}`, `{{ trans('app.labels.date') }}: ${moment().format('DD/MM/YYYY')}`, totalPagesExp);
                },
                margin: {top: startYTable},
                didParseCell: (data) => {
                    if (data.row.cells[0].text[0].indexOf('00.00.00') > -1) {
                        data.cell.styles.textColor = '#008000';
                        data.cell.styles.fillColor = '#e0e0e0';
                        data.cell.styles.fontStyle = 'bold';
                    }
                }
            });

            if (typeof doc.putTotalPages === 'function') {
                doc.putTotalPages(totalPagesExp);
            }

            doc.save('{{ trans('reports.budget_card_expenses.title_export') }}' + '.pdf')
        });

        /**
         * Ajusta tamaño de headers y footers de la tabla cuando se redimensiona la pantalla
         */
        $(window).resize(() => {
            $('#budget_card').DataTable().columns.adjust()
            $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
            $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
        })
    });
</script>

@else
    @include('errors.403')
    @endpermission
