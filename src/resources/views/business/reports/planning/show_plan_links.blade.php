@inject('Plan', '\App\Models\Business\Plan')

<div class="page-title">
    <div class="title_left">
        <h3>{{ trans('reports.labels.report') }}
            <small>{{ trans('app.labels.reports') }}</small>
        </h3>
    </div>

    <div class="title_right hidden-xs">
        <ol class="breadcrumb pull-right">

            @permission('index.pdotandpei.reports')
            <ul class="nav navbar-right panel_toolbox">
                <li class="pull-right">
                    <a id="export_pdf" class="btn ajaxify pdf-export-button">
                        <i class="fa fa-file-pdf-o"></i>{{ trans('reports/planning/ppi.labels.export.pdf') }}
                    </a>
                </li>
            </ul>
            @endpermission
            @if (currentUser()->can($urlExport))
                <ul class="nav navbar-right panel_toolbox">
                    <li class="pull-right">
                        <a id="export_excel" class="btn ajaxify pdf-export-button">
                            <i class="fa fa-file-excel-o"></i>{{ trans('reports.export.excel') }}
                        </a>
                    </li>
                </ul>
            @endif

        </ol>
    </div>
</div>

<div class="clearfix"></div>

<ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
    @foreach($tabs as $index => $tab)
        <li class="nav-item">
            <a id="tab_{{ $index }}" class="nav-link" role="tab" data-toggle="tab" href="#panel_{{ $index }}" aria-controls="panel_{{ $index }}">
                {{ \Illuminate\Support\Str::limit($plans[$index]->name, 15, '...') }}
                <i class="fa fa-arrow-right"></i>
                {{ \Illuminate\Support\Str::limit($tab['linkedPlan']->name, 15, '...') }}
            </a>
        </li>
    @endforeach
</ul>
<div class="tab-content">
    @foreach($tabs as $index => $tab)
        <div class="x_content tab-pane mb-15 overflow-scroll" role="tabpanel" id="panel_{{ $index }}">
            <table class="table report-table" id="links_tb_{{ $index }}">
                <thead>
                <tr>
                    <th class="planLinkColor" align="center" colspan="@if(!in_array($plans[$index]->type, [$Plan::TYPE_PEI, $Plan::TYPE_SECTORAL])) 4 @else 3 @endif">
                        <b>{{ $plans[$index]->name }}</b>
                    </th>
                    <th class="linkedPlanColor" align="center" colspan="4"><b>{{ $tab['linkedPlan']->name }}</b></th>
                </tr>
                <tr>
                    <th class="planLinkColor" align="center"><b>{{ trans('links.labels.vision') }}</b></th>
                    @if(!in_array($plans[$index]->type, [$Plan::TYPE_PEI, $Plan::TYPE_SECTORAL]))
                        <th class="planLinkColor" align="center"><b>{{ trans('links.labels.thrust') }}</b></th>
                    @endif
                    <th class="planLinkColor" align="center"><b>{{ trans('links.labels.objective') }}</b></th>
                    <th class="planLinkColor" align="center"><b>{{ trans('links.labels.goal') }}</b></th>

                    <th class="linkedPlanColor" align="center"><b>{{ trans('links.labels.goal') }}</b></th>
                    <th class="linkedPlanColor" align="center"><b>{{ trans('links.labels.objective') }}</b></th>
                    <th class="linkedPlanColor" align="center"><b>{{ trans('links.labels.thrust') }}</b></th>
                    <th class="linkedPlanColor" align="center"><b>{{ trans('links.labels.vision') }}</b></th>
                </tr>
                </thead>
                <tbody>
                @if($tab['rows']->count())
                    @foreach($tab['rows'] as $row)
                        <tr>
                            @foreach($row as $column)
                                <td width="12.5%" rowspan="{{ $column['rowspan'] }}">{!! $column['text'] !!}</td>
                            @endforeach
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td width="100%" align="center" colspan="8"> {{ trans('links.messages.info.noLinks') }} </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    @endforeach
</div>

<footer class="navbar-default navbar-fixed-bottom text-center">
    <a id="cancelLinks" href="{{ route('index.reports') }}"
       class="btn btn-info ajaxify">{{ trans('app.labels.backward') }}
    </a>
</footer>

<script>
    $(() => {
        $('#tab_0').tab('show');

        let logoBase64;
        let tab = '#links_tb_0';
        let title = '{{ $pdfTitle }}';

        imgToBase64('{{ mix('images/logo_login.png') }}', function (base64) {
            logoBase64 = base64;
        });

        $('#export_pdf').on('click', () => {
            let startYTable = 70, totalPagesExp = "{total_pages_count_string}";
            let doc = new jsPDF('l', 'mm', 'a3');

            doc.autoTable({
                html: tab,
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
                    0: {cellWidth: 40},
                    1: {cellWidth: 40},
                    2: {cellWidth: 40},
                    3: {cellWidth: 40},
                    4: {cellWidth: 40},
                    5: {cellWidth: 40},
                    6: {cellWidth: 40},
                    7: {cellWidth: 40},
                },
                showFoot: 'lastPage',
                didDrawPage: (data) => {
                    doc = setDocHeaderAndFooter(data, doc, logoBase64, title, '{{ $gad }}', `{{ trans('app.labels.date') }}: ${moment().format('DD/MM/YYYY')}`, totalPagesExp);
                },
                margin: {top: startYTable},
                willDrawCell: function (data) {
                    if (data.row.index <= 1 && data.row.section === 'head') {
                        @if(in_array($plans[$index]->type, [$Plan::TYPE_PEI, $Plan::TYPE_SECTORAL]))
                        if (data.column.index <= 2) {
                            doc.setFillColor(26, 187, 156);
                        } else {
                            doc.setFillColor(0, 82, 127);
                        }
                        @else
                        if (data.column.index <= 3) {
                            doc.setFillColor(26, 187, 156);
                        } else {
                            doc.setFillColor(0, 82, 127);
                        }
                        @endif
                    }
                }
            });

            if (typeof doc.putTotalPages === 'function') {
                doc.putTotalPages(totalPagesExp);
            }

            doc.save(title + '.pdf')
        });

        $('#export_excel').on('click', (e) => {
            e.preventDefault();

            $.ajax({
                url: '{{ route($urlExport) }}',
                method: 'GET',
                beforeSend: () => {
                    showLoading();
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: (response) => {
                    let a = document.createElement('a');
                    let url = window.URL.createObjectURL(response);
                    a.href = url;

                    a.download = '{{ $nameReport }}' + '.xlsx';
                    document.body.append(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                }
            }).always(() => {
                hideLoading();
            });
        });

        @foreach($tabs as $index => $tab)
        $("#tab_{{ $index }}").on("click", function (event, ui) {
            tab = '#links_tb_{{ $index }}';
        });
        @endforeach
    })
</script>

