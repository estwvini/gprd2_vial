@permission('index.executive_progress_project.reports')
<div>
    <div class="page-title">
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h3> {{ trans('reports.title') }}</h3>
            <h2>
                <i class="fa fa-tasks"></i> {{ trans('reports.executive_progress_project.title') }}
            </h2>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a class="btn pdf-export-button mt-4 pull-right" id="export_pdf">
                <i class="fa fa-file-pdf-o"></i>
                {{ trans('reports.export.pdf') }}
            </a>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="form-group has-feedback col-md-2 col-xs-12">
                            <label class="control-label" for="date">
                                {{ trans('reports.progress_investment_project.date') }}
                            </label>
                            <input name="date_init" id="date" value="{{ now()->format('d-m-Y') }}"
                                   class="form-control has-feedback-left readonly-white"
                                   placeholder=" DD-MM-YYYY" autocomplete="off" readonly/>
                            <span class="fa fa-calendar form-control-feedback left mt-2 color-blue" aria-hidden="true"></span>
                        </div>
                    </div>
                    <table class="table report-table" id="projects_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>{{ trans('reports.executive_progress_project.responsible_unit_projects') }}</th>
                            <th>{{ trans('reports.executive_progress_project.physical_progress') }}</th>
                            <th>{{ trans('reports.executive_progress_project.budget_progress') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {

        // Add datetimepicker
        $('#date').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: 'es-es',
            useCurrent: false,
            ignoreReadonly: true
        });

        $('#date').on('dp.change', (e) => {
            dataTable.draw();
        });

        let dataTable = build_datatable($('#projects_tb'), {
            dom: 'tr',
            ajax: {
                url: '{!! route('data.index.executive_progress_project.reports') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        date: $("#date").val(),
                    });
                },
            },
            paging: false,
            responsive: false,
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false},
                {data: 'executingUnit', visible: false, sortable: false, searchable: false, class: 'text-center'},
                {data: 'project_name', width: '60%', sortable: false, searchable: false},
                {data: 'physical_percent', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'budget_percent', width: '20%', sortable: false, searchable: false, class: 'text-center'}
            ],
            rowGroup: {
                startRender: (rows, group) => {
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

                    let tr = $('<tr/>').append('<td colspan="1">' + group + '</td>');

                    let totalRows = rows.data().count();
                    // calculate unit(group) subtotals for all numeric columns
                    let subTotalPhysical = rows
                        .data()
                        .pluck(dataTable.settings()[0].aoColumns[3].data)
                        .reduce((a, b) => {
                            return parseFloat(numericVal(a)) + parseFloat(numericVal(b));
                        }, 0);
                    tr.append('<td class="text-center text-success">' + $.number((subTotalPhysical / totalRows), 2) + '</td>');

                    let subTotalBudget = rows
                        .data()
                        .pluck(dataTable.settings()[0].aoColumns[4].data)
                        .reduce((a, b) => {
                            return parseFloat(numericVal(a)) + parseFloat(numericVal(b));
                        }, 0);
                    tr.append('<td class="text-center text-success">' + $.number((subTotalBudget / totalRows), 2) + '</td>');

                    return tr;
                },
                dataSrc: 'executingUnit'
            },
        });

        let logoBase64;

        imgToBase64('{{ mix('images/logo_login.png') }}', function (base64) {
            logoBase64 = base64;
        });
        $('#export_pdf').on('click', (e) => {
            let startYTable = 70, totalPagesExp = "{total_pages_count_string}";
            let doc = new jsPDF('l', 'mm', 'a4');
            doc.autoTable({
                html: '#projects_tb',
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
                    1: {halign: 'center'},
                    2: {halign: 'center'},
                    3: {halign: 'center'}
                },
                showFoot: 'lastPage',
                footStyles: {
                    halign: 'right'
                },
                didDrawPage: (data) => {
                    // Header
                    doc.setFontSize(15)
                    doc.setTextColor(40)
                    doc.setFontStyle('normal')

                    if (logoBase64) {
                        doc.addImage(logoBase64, 'PNG', data.settings.margin.left, 15, 50, 14)
                    }
                    doc.text('{{ trans('reports.executive_progress_project.title') }}', data.settings.margin.left, 38, {'maxWidth': 400})
                    doc.text($('#date').val(), data.settings.margin.left, 48)
                    // Footer
                    let str = 'Página ' + doc.internal.getNumberOfPages()

                    if (typeof doc.putTotalPages === 'function') {
                        str = str + ' de ' + totalPagesExp
                    }
                    doc.setFontSize(10)

                    let pageSize = doc.internal.pageSize
                    let pageHeight = pageSize.getHeight()
                    doc.text(str, data.settings.margin.left, pageHeight - 10)
                },
                margin: {top: startYTable},
                didParseCell: (data) => {
                    if (data.row.raw.className === 'dtrg-group dtrg-start dtrg-level-0') {
                        data.cell.styles.textColor = '#008000';
                        data.cell.styles.fillColor = '#e0e0e0';
                        data.cell.styles.fontStyle = 'bold';
                    }
                }
            });

            if (typeof doc.putTotalPages === 'function') {
                doc.putTotalPages(totalPagesExp);
            }

            doc.save('{{ trans('reports.executive_progress_project.export') }}' + '.pdf')
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
