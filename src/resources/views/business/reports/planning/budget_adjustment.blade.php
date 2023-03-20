@permission('budget_adjustment.reports')
<div>
    <div class="page-title">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-11 col-sm-11 col-xs-11">
                <h3>{{ trans('app.labels.reports') }}</h3>
                <h2>
                    <i class="fa fa-list-alt"></i> {{ trans('reports.budget_adjustment.title') }}
                </h2>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row mb-15">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <h6>{{ trans('reports.labels.select_year') }}</h6>
                        </div>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            @if(count($years))
                                <select class="form-control select2" id="years" name="years">
                                    @foreach($years as $year)
                                        @if($loop->first)
                                            <option value="{{ $year->id }}" selected>{{ $year->year }}</option>
                                        @else
                                            <option value="{{ $year->id }}">{{ $year->year }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                    <ul class="nav navbar-right panel_toolbox mt-5">
                        <li class="pull-right">
                            <a class="btn pdf-export-button" id="export_pdf" style="display: none">
                                <i class="fa fa-file-pdf-o"></i>{{ trans('reports.export.pdf') }}
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table report-table" id="budget_adjustment">
                        <thead>
                        <tr>
                            <th>{{ trans('proforma.labels.year') }}</th>
                            <th>{{ trans('proforma.labels.company_code') }}</th>
                            <th>{{ trans('proforma.labels.type') }}</th>
                            <th>{{ trans('proforma.labels.code') }}</th>
                            <th>{{ trans('proforma.labels.description') }}</th>
                            <th>{{ trans('proforma.labels.income_amount') }}</th>
                            <th>{{ trans('proforma.labels.expense_amount') }}</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr>
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

        $('.select2').select2({});
        let yearSelected = $("#years").val();
        let url = "{!! route('data.budget_adjustment.reports', ['fiscalYearId' => '__ID__']) !!}";
        url = url.replace('__ID__', yearSelected);

        let $dataTable = build_datatable($('#budget_adjustment'), {
            dom: 't',
            ajax: url,
            paging: false,
            responsive: false,
            scrollX: true,
            scrollY: '400px',
            columns: [
                {data: 'year', width: '5%', sortable: false, searchable: false},
                {data: 'company_code', width: '5%', sortable: false, searchable: false},
                {data: 'type', width: '5%', sortable: false, searchable: false},
                {data: 'code', width: '30%', sortable: false, searchable: false},
                {data: 'description', width: '35%', sortable: false, searchable: false},
                {data: 'income_amount', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'expense_amount', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ],
            initComplete: (json) => {
                if (json.aoData.length) {
                    $('#export_pdf').show();
                }
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            drawCallback: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            footerCallback: function (row, data, start, end, display) {
                let api = this.api(), json = api.ajax.json();
                // Update footer
                $(api.column(5).footer()).html(
                    '{{ trans('reports/planning/ppi.labels.footer.total') }}'.replace(':totalBudget', json.totalIncome)
                );
                $(api.column(6).footer()).html(
                    '{{ trans('reports/planning/ppi.labels.footer.total') }}'.replace(':totalBudget', json.totalExpense)
                );
            }
        });

        $("#years").on('change', () => {

            yearSelected = parseInt($("#years").val());
            let newUrl = "{!! route('data.budget_adjustment.reports', ['fiscalYearId' => '__ID__']) !!}";
            newUrl = newUrl.replace('__ID__', yearSelected);
            $dataTable.ajax.url(newUrl);
            showLoading();
            $dataTable.ajax.reload((json) => {
                hideLoading();
                // Mostrar botón de descarga si existe data
                if (json.data.length) {
                    $('#export_pdf').show();
                } else {
                    $('#export_pdf').hide();
                }
            });

        });

        let logoBase64;

        imgToBase64('{{ mix('images/logo_login.png') }}', function (base64) {
            logoBase64 = base64;
        });

        $('#export_pdf').on('click', () => {
            let startYTable = 70, totalPagesExp = "{total_pages_count_string}";
            let doc = new jsPDF('l', 'mm', 'a3');

            doc.autoTable({
                html: '#budget_adjustment',
                theme: 'grid',
                tableWidth: 'auto',
                headStyles: {
                    halign: 'center'
                },
                styles: {
                    overflow: 'linebreak',
                    cellWidth: 'auto',
                    valign: 'middle',
                    minCellWidth: 20
                },
                columnStyles: {
                    1: {cellWidth: 20},
                    3: {cellWidth: 100},
                    4: {cellWidth: 50}
                },
                showFoot: 'lastPage',
                didDrawPage: (data) => {
                    doc = setDocHeaderAndFooter(data, doc, logoBase64, '{{ trans('reports.budget_adjustment.title') }}' + " " + $("#years option:selected").text(), '{{ $gad }}', `{{ trans('app.labels.date') }}: ${moment().format('DD/MM/YYYY')}`, totalPagesExp);
                },
                margin: {top: startYTable}
            });

            if (typeof doc.putTotalPages === 'function') {
                doc.putTotalPages(totalPagesExp);
            }

            doc.save('{{ trans('reports.budget_adjustment.title') }}' + " " + $("#years option:selected").text() + '.pdf')
        })

        /**
         * Ajusta tamaño de headers y footers de la tabla cuando se redimensiona la pantalla
         */
        $(window).resize(() => {
            $('#budget_adjustment').DataTable().columns.adjust()
            $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
            $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
        })

    });
</script>

@else
    @include('errors.403')
    @endpermission
