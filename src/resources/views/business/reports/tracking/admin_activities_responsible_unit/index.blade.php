@permission('index.admin_activities_responsible_unit.reports')
<div>
    <div class="page-title">
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h3> {{ trans('reports.title') }}</h3>
            <h2>
                <i class="fa fa-tasks"></i> {{ trans('reports.admin_activities_responsible_unit.title') }}
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
                    <h3>{{ trans('reports.admin_activities_responsible_unit.total_percent') . ': ' . number_format($total_percent, 2) . '%' }}</h3>
                    <table class="table report-table" id="activities_tb">
                        <thead>
                        <tr>
                            <th rowspan="3">{{ trans('reports.admin_activities_responsible_unit.responsible_unit') }}</th>
                            <th rowspan="3">{{ trans('reports.admin_activities_responsible_unit.total_act') }}</th>
                            <th colspan="7">{{ trans('reports.admin_activities_responsible_unit.status_act') }}</th>
                        </tr>
                        <tr>
                            <th colspan="2">{{ trans('reports.admin_activities_responsible_unit.pending') }}</th>
                            <th colspan="2">{{ trans('reports.admin_activities_responsible_unit.in_progress') }}</th>
                            <th colspan="2">{{ trans('reports.admin_activities_responsible_unit.completed') }}</th>
                        </tr>
                        <tr>
                            <th>{{ trans('reports.admin_activities_responsible_unit.nro') }}</th>
                            <th>{{ trans('reports.admin_activities_responsible_unit.percent') }}</th>
                            <th>{{ trans('reports.admin_activities_responsible_unit.nro') }}</th>
                            <th>{{ trans('reports.admin_activities_responsible_unit.percent') }}</th>
                            <th>{{ trans('reports.admin_activities_responsible_unit.nro') }}</th>
                            <th>{{ trans('reports.admin_activities_responsible_unit.percent') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($responsibleUnits as $unit)
                            <tr>
                                <td>{{ $unit->responsibleUnit }}</td>
                                <td class="text-center">{{ $unit->draft + $unit->in_progress + $unit->completed  }}</td>
                                <td class="text-center">{{ $unit->draft }}</td>
                                <td class="text-center">{{ number_format(($unit->draft * 100) / (($unit->draft + $unit->in_progress + $unit->completed) == 0 ? 1:
                                                                        ($unit->draft + $unit->in_progress + $unit->completed)), 2) }}%
                                </td>
                                <td class="text-center">{{ $unit->in_progress }}</td>
                                <td class="text-center">{{ number_format(($unit->in_progress * 100) / (($unit->draft + $unit->in_progress + $unit->completed) == 0 ? 1:
                                                                        ($unit->draft + $unit->in_progress + $unit->completed)), 2) }}%
                                </td>
                                <td class="text-center">{{ $unit->completed }}</td>
                                <td class="text-center">{{ number_format(($unit->completed * 100) / (($unit->draft + $unit->in_progress + $unit->completed) == 0 ? 1:
                                                                        ($unit->draft + $unit->in_progress + $unit->completed)), 2) }}%
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center"> {{ trans('reports.admin_activities_responsible_unit.no_info') }}</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {

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
                    4: {halign: 'center'},
                    5: {halign: 'center'},
                    6: {halign: 'center'},
                    7: {halign: 'center'},
                    8: {halign: 'center'}
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
                    doc.text('{{ trans('reports.admin_activities_responsible_unit.gad') . ' ' . $gad }}', data.settings.margin.left, 38)
                    doc.text('{{ trans('reports.admin_activities_responsible_unit.title') }}', data.settings.margin.left, 48, {'maxWidth': 400})
                    doc.text('{{ $date }}', data.settings.margin.left, 58)
                    doc.text('{{ trans('reports.admin_activities_responsible_unit.total_percent') . ': ' . number_format($total_percent, 2) . '%' }}', data.settings.margin.left,
                        68)

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

            doc.save('{{ trans('reports.admin_activities_responsible_unit.export') }}' + '.pdf')
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
