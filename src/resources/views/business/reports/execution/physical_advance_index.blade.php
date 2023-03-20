@permission('physical_advance.reports')
<div class="page-title">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('app.labels.reports') }}</h3>
            <h2>
                <i class="fa fa-list-alt"></i> {{ trans('reports.physical_advance.title') }}
            </h2>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<div class="row mb-15">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <h6>
                            {{ trans('reports.labels.select_year').':' }}
                        </h6>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                        <select class="form-control select2" name="fiscal_year" id="fiscal_year_id">
                            @foreach($fiscalYears as $fiscalYear)
                                <option value="{{ $fiscalYear->id }}" @if($fiscalYear->year ===  $currentFiscalYear) selected @endif>{{ $fiscalYear->year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-8 col-sm-8 col-xs-12">
                    <button id="export_excel" class="btn pull-right pdf-export-button mt-3">
                        <i class="fa fa-file-excel-o"></i>
                        {{ trans('reports.export.excel') }}
                    </button>
                </div>

                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table report-table" id="physical_advance_tb">
                    <thead>
                    <tr id="thead-tr-1">
                        <th><b>{{ trans('app.headers.type') }}</b></th>
                        <th><b>{{ trans('app.headers.code') }}</b></th>
                        <th><b>{{ trans('app.headers.description') }}</b></th>
                        <th><b>{{ trans('reports.physical_advance.completion') }}</b></th>
                    </tr>
                    </thead>
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
        let fiscalYearSelect = $('#fiscal_year_id');
        fiscalYearSelect.select2();

        let datatable = build_datatable($('#physical_advance_tb'), {
            paginate: false,
            responsive: false,
            scrollX: true,
            ajax: {
                url: '{{ route('data.physical_advance.reports') }}',
                data: (d) => {
                    return $.extend({}, d, {
                        fiscalYearId: parseInt(fiscalYearSelect.val())
                    });
                },
                dataSrc: function (response) {
                    if (response.exception !== '') {
                        notify(response.exception, 'warning')
                    }
                    return response.data;
                }
            },
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: '{{ trans('reports.labels.gad') . ' ' . $gad['province'] }}',
                    filename: '{{ trans('reports.physical_advance.file_name') }}',
                    messageTop: '{{ trans('reports.title_dashboard') . ' ' . trans('reports.physical_advance.title') }} ' + fiscalYearSelect.find('option:selected').text(),
                    customize: function (xlsx) {

                        changeExcelStyle(xlsx);

                        let sheet = xlsx.xl.worksheets['sheet1.xml'];

                        let headerLength = $('#thead-tr-1 th').length;

                        let date = [{key: 'A', value: '{{ trans('reports/roads/roads_reports.labels.date') . date('d/m/Y') }}'}];

                        // First and Second row are added by title and messageTop options.
                        insertRow(sheet, 2, date);

                        updateRowsIndex(sheet);

                        mergeCells(sheet, 'A3:' + String.fromCharCode('A'.charCodeAt(0) + headerLength - 1) + '3');

                        /*
                        |-------------------------------
                        | Cell Styles for Excel
                        |-------------------------------
                        |
                        | s = 25 : Text, Normal 12, Thin Border, Left
                        | s = 67 : Text, Bold 20 White, Green Background, No Border, Center
                        | s = 72 : Text, Bold 18, Green Background, No Border, Left
                        | s = 73 : Text, Bold 14, Green Background, Thin Border, Center
                        | s = 76 : Percentage 2 Decimals, Normal 12, White Background, Thin Border, Center
                        |
                         */

                        let lastIndex = $('row:last-child', sheet).index();
                        $('row:first-child c', sheet).attr('s', '67');
                        $('row:nth-child(2) c', sheet).attr('s', '72');
                        $('row:nth-child(3) c', sheet).attr('s', '72');
                        $('row:nth-child(4) c', sheet).attr('s', '73');
                        $('row', sheet).slice(4, lastIndex + 1).find('c:not(:last-child)').attr('s', '25');
                        $('row', sheet).slice(4, lastIndex + 1).find('c:last-child').attr('s', '76');
                    }
                }
            ],
            columns: [
                {data: 'type', width: '20%', sortable: false, searchable: true},
                {data: 'code', width: '30%', sortable: false, searchable: true},
                {data: 'description', width: '30%', sortable: false, searchable: false},
                {data: 'completion', width: '20%', sortable: false, searchable: false, class: 'text-center'}
            ],
            initComplete: function () {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
                $('.dataTables_filter').addClass('pull-left');
                $('.dataTables_filter > label').addClass('pull-left');

                let api = this.api();
                $('#export_excel').on('click', () => {
                    api.buttons(0).trigger();
                });
            },
            drawCallback: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
                $('.dataTables_filter').addClass('pull-left');
                $('.dataTables_filter > label').addClass('pull-left');
            }
        });

        fiscalYearSelect.on('change', () => {
            datatable.draw();
        });

        /**
         * Ajusta tamaño de headers y footers de la tabla cuando se redimensiona la pantalla
         */
        $(window).resize(() => {
            $('#physical_advance_tb').DataTable().columns.adjust()
            $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
            $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
        })
    });
</script>

@else
    @include('errors.403')
    @endpermission
