@permission('index.progress_investment_project.reports')
<div>
    <div class="page-title">
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h3> {{ trans('reports.title') }}</h3>
            <h2>
                <i class="fa fa-tasks"></i> {{ trans('reports.progress_investment_project.title') }}
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
                            <input name="date_init" id="date" value="{{ $date_filter ?? '' }}"
                                   class="form-control has-feedback-left readonly-white"
                                   placeholder=" DD-MM-YYYY" autocomplete="off" readonly/>
                            <span class="fa fa-calendar form-control-feedback left mt-2 color-blue" aria-hidden="true"></span>
                        </div>
                    </div>
                    <table class="table report-table" id="projects_tb" style="width: 100%">
                        <thead>
                        <tr style="height: 50px !important;">
                            <th>{{ trans('reports.progress_investment_project.responsible_unit') }}</th>
                            <th>{{ trans('reports.progress_investment_project.project') }}</th>
                            <th>{{ trans('reports.progress_investment_project.physical_percent') }}</th>
                            <th>{{ trans('reports.progress_investment_project.encoded_budget') }}</th>
                            <th>{{ trans('reports.progress_investment_project.budget_percent') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($projectFiscalYears as $project)
                            <tr>
                                <td>{{ $project->executingUnit }}</td>
                                <td>{{ $project->project_name }}</td>
                                <td class="text-center">{{ number_format($project->getProgress(), 2)  }}</td>
                                <td class="text-center">{{ number_format($project->encoded, 2) }}</td>
                                <td class="text-center">{{ number_format($project->budget_percent, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center"> {{ trans('reports.progress_investment_project.no_info') }}</td>
                            </tr>
                        @endforelse
                        @if(count($projectFiscalYears))
                            <tr class="fw-b" style="background-color: #1abb9c !important; color: #fff">
                                <td colspan="2" class="text-right">{{ trans('app.labels.footer_total') }}</td>
                                <td class="text-center">{{ number_format($physical_progress, 2)  }}</td>
                                <td class="text-center">{{ number_format($encoded_total, 2) }}</td>
                                <td class="text-center">{{ number_format($budget_progress, 2) }}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {

        let logoBase64;

        // Add datetimepicker
        $('#date').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: 'es-es',
            useCurrent: false,
            ignoreReadonly: true
        });

        $('#date').on('dp.change', (e) => {
            pushRequest('{{ route('index.progress_investment_project.reports') }}', null, null, 'get', {
                date: $('#date').val()
            });
        });

        imgToBase64('{{ mix('images/logo_login.png') }}', function (base64) {
            logoBase64 = base64;
        });
        $('#export_pdf').on('click', (e) => {
            let startYTable = 70, totalPagesExp = "{total_pages_count_string}";
            let doc = new jsPDF('l', 'mm', 'a3');
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
                    doc.text('{{ trans('reports.progress_investment_project.gad') . ' ' . $gad }}', data.settings.margin.left, 38)
                    doc.text('{{ trans('reports.progress_investment_project.report_title') }}', data.settings.margin.left, 48, {'maxWidth': 400})
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

            doc.save('{{ trans('reports.progress_investment_project.export') }}' + '.pdf')
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
