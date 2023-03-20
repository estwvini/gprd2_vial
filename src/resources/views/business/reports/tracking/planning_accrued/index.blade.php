@permission('index.planning_accrued.reports')
<div>
    <div class="page-title">
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h3>{{ trans('app.labels.reports') }}</h3>
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
                <div class="x_title">
                    <h2>
                        <i class="fa fa-list-alt"></i> {{ trans('reports.planning_accrued.title') }}
                    </h2>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <h6>{{ trans('reports.project_activities_poa.executing_unit') }}</h6>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <select class="form-control select2 mb-1" id="executing_unit">
                                    <option value="0">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>
                                    @foreach($executingUnits as $unit)
                                        <option value="{{ $unit->id }}">
                                            {{ $unit->code }} - {{ $unit->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="result" class="table-responsive">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <a id="cancelLinks" href="{{ route('index.reports') }}"
               class="btn btn-info ajaxify">{{ trans('app.labels.backward') }}
            </a>
        </div>
    </div>
</div>

<script>
    $('#executing_unit').on('change', () => {

        let url = '{{ route('data.index.planning_accrued.reports', ['executingUnitId' => '__ID__']) }}';
        url = url.replace('__ID__', $('#executing_unit').val());
        pushRequest(url, '#result', null, 'get', null, false);

        let logoBase64;

        imgToBase64('{{ mix('images/logo_login.png') }}', function (base64) {
            logoBase64 = base64;
        });
        $('#export_pdf').on('click', (e) => {
            let startYTable = 70, totalPagesExp = "{total_pages_count_string}";
            let doc = new jsPDF('l', 'mm', 'a1');
            doc.autoTable({
                html: '#report_tb',
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
                    // 4: {halign: 'center'}
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
                    doc.text('{{ trans('reports.planning_accrued.gad') . ' ' . $gad }}', data.settings.margin.left, 38)
                    doc.text('{{ trans('reports.planning_accrued.title') }}', data.settings.margin.left, 48, {'maxWidth': 400})
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
