@permission('index.admin_activities_budget.reports')
<div>
    <div class="page-title">
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h3> {{ trans('reports.title') }}</h3>
            <h2>
                <i class="fa fa-tasks"></i> {{ trans('reports.admin_activities_budget.title') }}
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
                    <table class="table report-table" id="activities_tb">
                        <thead>
                        <tr style="height: 50px !important;">
                            <th>{{ trans('reports.admin_activities_budget.responsible_unit') }}</th>
                            <th>{{ trans('reports.admin_activities_budget.total_act') }}</th>
                            <th>{{ trans('reports.admin_activities_budget.physical_percent') }}</th>
                            <th>{{ trans('reports.admin_activities_budget.encoded_budget') }}</th>
                            <th>{{ trans('reports.admin_activities_budget.budget_percent') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($responsibleUnits as $unit)
                            <tr>
                                <td>{{ $unit->responsibleUnit }}</td>
                                <td class="text-center">{{ $unit->draft + $unit->in_progress + $unit->completed  }}</td>
                                <td class="text-center">{{ number_format($unit->physical_percent, 2) }}</td>
                                <td class="text-center">{{ number_format($unit->encoded, 2) }}</td>
                                <td class="text-center">{{ number_format($unit->budget_percent, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center"> {{ trans('reports.admin_activities_budget.no_info') }}</td>
                            </tr>
                        @endforelse
                        </tbody>
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
            pushRequest('{{ route('index.admin_activities_budget.reports') }}', null, null, 'get', {
                date: $('#date').val()
            });
        });

        let logoBase64;

        imgToBase64('{{ mix('images/logo_login.png') }}', function (base64) {
            logoBase64 = base64;
        });
        $('#export_pdf').on('click', (e) => {
            let startYTable = 70, totalPagesExp = "{total_pages_count_string}";
            let doc = new jsPDF('l', 'mm', 'a4');
            doc.autoTable({
                html: '#activities_tb',
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
                    3: {halign: 'center'},
                    4: {halign: 'center'}
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
                    doc.text('{{ trans('reports.admin_activities_budget.gad') . ' ' . $gad }}', data.settings.margin.left, 38)
                    doc.text('{{ trans('reports.admin_activities_budget.report_title') }}', data.settings.margin.left, 48, {'maxWidth': 400})
                    doc.text('{{ $date }}', data.settings.margin.left, 58)

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
                margin: {top: startYTable}
            });

            if (typeof doc.putTotalPages === 'function') {
                doc.putTotalPages(totalPagesExp);
            }

            doc.save('{{ trans('reports.admin_activities_budget.export') }}' + '.pdf')
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
