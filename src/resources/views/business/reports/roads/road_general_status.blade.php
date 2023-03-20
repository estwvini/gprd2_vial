@permission('index.cantonal_road_general_status.inventory_roads_report')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('reports/roads/roads_reports.labels.cantonal_road_general_status') }}
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="form-group">
            <div class="x-panel">
                <div class="x-content">
                    <div id="roadTotalLengthByStatusChart" class="h-350"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-automobile"></i> {{ trans('reports/roads/roads_reports.labels.road_length_report') . $gad["province_short_name"] }}
                    </h2>

                    <div class="text-right">
                        <button id="export_excel" class="btn btn-primary dt-button"><i class="fa fa-upload"></i> {{ trans('reports/roads/roads_reports.labels.export') }}</button>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="row" id="result">
                        <table class="table table-striped" id="cantonal_road_length_report_tb">
                            <thead>
                            <tr id="thead-tr-1">
                                <th rowspan="2">{{ trans('reports/roads/roads_reports.labels.canton') }}</th>
                                <th rowspan="2" class="calculationEnabled">{{ trans('reports/roads/roads_reports.labels.length') }}</th>
                                <th colspan="{{ $status->count() }}">{{ trans('reports/roads/roads_reports.labels.road_status') }}</th>
                            </tr>
                            <tr id="thead-tr-2"></tr>
                            </thead>
                            <tfoot>
                            <tr id="tfoot-tr-1">
                                <th>{{ trans('reports/roads/roads_reports.labels.total') }}</th>
                                <th></th>
                            </tr>
                            <tr id="tfoot-tr-2">
                                <th>{{ trans('reports/roads/roads_reports.labels.percentage') }}</th>
                                <th></th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="navbar-default navbar-fixed-bottom text-center">
    <a id="cancelLinks" href="{{ route('index.inventory_roads_report') }}"
       class="btn btn-info ajaxify">{{ trans('app.labels.backward') }}
    </a>
</footer>
<script>

    $(() => {
        let roadTotalLengthByStatusChart = echarts.init(document.getElementById('roadTotalLengthByStatusChart'));

        let barOptions = {
            title: {
                text: '{{ trans('reports/roads/roads_reports.labels.total_length_per_status') }}',
                subtext: '{{ $gad['province'] }}'.toUpperCase(),
                subtextStyle: {fontSize: 14},
                x: 'center'
            },
            tooltip: {trigger: 'item'},
            legend: {
                x: 'center',
                padding: [65, 5, 5, 5],
                data: ['{{ trans('reports/roads/roads_reports.labels.total_length') }}', '']
            },
            toolbox: {
                show: true,
                feature: {
                    saveAsImage: {
                        show: true,
                        title: '{{ trans('reports/roads/roads_reports.labels.save_image') }}'
                    }
                }
            },
            color: ['#513B56', '#4281A4', '#FE938C', '#B8BEDD',
                '#F4A261', '#264653', '#BCE784', '#B2DBBF'],
            xAxis: [
                {
                    splitArea: {show: true},
                    axisLabel: {
                        interval: 0
                    },
                    data: []
                }
            ],
            yAxis: [
                {
                    nameTextStyle: {color: '#808285'},
                    name: ''
                }
            ],
            series: [],
            grid: {
                y: 105,
                y2: 40
            }
        };

        let columns = [
            {data: 'canton', name: 'canton', sortable: false, class: 'text-center'},
            {data: 'length', name: 'length', sortable: false, class: 'text-center'}
        ];

        // Añade las columnas del datatable dinámicamente según los tipos de estados de la vía.
        $.each({!! $status !!}, (id, value) => {
            let headerTitle = value.descrip.toLowerCase().replace(/\b[a-z]/g, (txtVal) => {
                return txtVal.toUpperCase();
            });

            $('#thead-tr-2').append($('<th />', {text: headerTitle, class: 'calculationEnabled'}));
            $('#tfoot-tr-1').append($('<th />'));
            $('#tfoot-tr-2').append($('<th />'));
            columns.push(
                {data: value.descrip, name: value.descrip, sortable: false, class: 'text-center'}
            );
        });

        let dataTable = build_datatable($('#cantonal_road_length_report_tb'), {
            ajax: '{!! route('data.index.cantonal_road_general_status.inventory_roads_report') !!}',
            columns: columns,
            searching: false,
            paging: false,
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: '{{ trans('reports/roads/roads_reports.labels.gad') . $gad['province'] }}',
                    filename: '{{ trans('reports/roads/roads_reports.labels.general_status_file_name') }}',
                    messageTop: '{{ trans('reports/roads/roads_reports.labels.report') . trans('reports/roads/roads_reports.labels.cantonal_road_general_status') }}',
                    header: false,
                    footer: true,
                    customize: function (xlsx) {

                        changeExcelStyle(xlsx);

                        let sheet = xlsx.xl.worksheets['sheet1.xml'];

                        let numRows = $('row', sheet).length;

                        let header2Length = $('#thead-tr-2 th').length;
                        let footerLength = $('#tfoot-tr-2 th').length;

                        let header1 = [
                            {key: 'A', value: '{{ trans('reports/roads/roads_reports.labels.canton') }}'},
                            {key: 'B', value: '{{ trans('reports/roads/roads_reports.labels.length') }}'},
                            {key: 'C', value: '{{ trans('reports/roads/roads_reports.labels.road_status') }}'}
                        ];
                        let header2 = [{key: 'A', value: ''}, {key: 'B', value: ''}];
                        let footer = [];
                        let date = [{key: 'A', value: '{{ trans('reports/roads/roads_reports.labels.date') . date('d/m/Y') }}'}];

                        for (let i = 0; i < header2Length; i++) {
                            let value = $('#thead-tr-2 th:eq(' + i + ')').text();

                            if (i !== 0) {
                                header1.push({key: String.fromCharCode('C'.charCodeAt(0) + i), value: ''});
                            }

                            header2.push(
                                {key: String.fromCharCode('C'.charCodeAt(0) + i), value: value}
                            );
                        }

                        for (let i = 0; i < footerLength; i++) {

                            let value = $('#tfoot-tr-2 th:eq(' + i + ')').text();

                            if (i !== 0) {
                                value = parseFloat(value) / 100;
                                date.push(
                                    {key: String.fromCharCode('A'.charCodeAt(0) + i), value: ''}
                                );
                            }

                            footer.push(
                                {key: String.fromCharCode('A'.charCodeAt(0) + i), value: value}
                            );
                        }

                        // First and Second row are added by title and messageTop options.
                        insertRow(sheet, 2, date);
                        insertRow(sheet, 3, header1);
                        insertRow(sheet, 4, header2);
                        insertRow(sheet, numRows + 1, footer, true);

                        updateRowsIndex(sheet);

                        mergeCells(sheet, 'A3:' + String.fromCharCode('A'.charCodeAt(0) + footerLength - 1) + '3');
                        mergeCells(sheet, 'A4:A5');
                        mergeCells(sheet, 'B4:B5');

                        mergeCells(sheet, 'C4:' + String.fromCharCode('C'.charCodeAt(0) + header2Length - 1) + '4');

                        /*
                        |-------------------------------
                        | Cell Styles for Excel
                        |-------------------------------
                        |
                        | s = 25 : Text, Normal 12, Thin Border, Left
                        | s = 67 : Text, Bold 20 White, Green Background, No Border, Center
                        | s = 68 : Text, Bold 18 White, Green Background, Thin Border, Center
                        | s = 69 : Number 2 Decimals, Normal 12, White Background, Thin Border, Center
                        | s = 70 : Number 2 Decimals, Bold 14 White, Green Background, Thin Border, Center
                        | s = 71 : Percentage 2 Decimals, Bold 14 White, Green Background, Thin Border, Center
                        | s = 72 : Text, Bold 18, Green Background, No Border, Left
                        | s = 73 : Text, Bold 14, Green Background, Thin Border, Center
                        |
                         */

                        let lastIndex = $('row:last-child', sheet).index();
                        $('row:first-child c', sheet).attr('s', '67');
                        $('row:nth-child(2) c', sheet).attr('s', '72');
                        $('row:nth-child(3) c', sheet).attr('s', '72');
                        $('row:nth-child(4) c', sheet).attr('s', '73');
                        $('row:nth-child(5) c', sheet).attr('s', '73');
                        $('row', sheet).slice(5, lastIndex - 1).find('c:not(:first-child)').attr('s', '69');
                        $('row', sheet).slice(5, lastIndex - 1).find('c:first-child').attr('s', '25');
                        $('row:last-child c:first-child', sheet).attr('s', '68');
                        $('row:nth-last-child(2) c', sheet).attr('s', '70');
                        $('row:last-child c', sheet).attr('s', '71');
                    }
                }
            ],
            footerCallback: function () {
                let api = this.api();

                // Remove the formatting to get integer data for summation
                let intVal = (i) => {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                            i : 0;
                };

                let lengthTotal = api
                    .column(1) // Last index
                    .data()
                    .reduce(function (a, b) {
                        return parseFloat(intVal(a)) + parseFloat(intVal(b));
                    }, 0);

                $('#tfoot-tr-1').find('th').eq(1).html(
                    lengthTotal.toFixed(2)
                );

                $('#tfoot-tr-2').find('th').eq(1).html('100.00%');

                api.columns('.calculationEnabled').every(function () {
                    let index = this.index();
                    // Total of all pages
                    let total = api
                        .column(index)
                        .data()
                        .reduce(function (a, b) {
                            return parseFloat(intVal(a)) + parseFloat(intVal(b));
                        }, 0);

                    // Calculate percentage of the total
                    let percentage = (Number(total.toFixed(2)) * 100) / Number(lengthTotal.toFixed(2));

                    // Update footer
                    $('#tfoot-tr-1').find('th').eq(index).html(
                        total.toFixed(2)
                    );

                    $('#tfoot-tr-2').find('th').eq(index).html(
                        percentage.toFixed(2) + '%'
                    );
                });

                setSurfaceTypeBarChart();
            },
            initComplete: function () {
                let api = this.api();
                $('#export_excel').on('click', () => {
                    api.buttons(0).trigger();
                });
            }
        });

        // Establece las opciones del echart para el gráfico de barras de tipos de capas de rodadura.
        let setSurfaceTypeBarChart = () => {
            let columns = dataTable
                .settings()
                .init()
                .columns;

            let cantons = dataTable
                .column(0)
                .data();

            barOptions.xAxis[0].data = cantons.toArray();

            dataTable.columns('.calculationEnabled').every(function () {
                let index = this.index();

                let data = dataTable
                    .column(index)
                    .data();

                let columnName = columns[index].name;

                if (columnName === 'length') {
                    columnName = '{{ trans('reports/roads/roads_reports.labels.total') }}';
                }

                columnName = columnName.toLowerCase().replace(/\b[a-z]/g, function (txtVal) {
                    return txtVal.toUpperCase();
                }) + ' {{ trans('reports/roads/roads_reports.labels.length_measure') }}';

                barOptions.series.push(
                    {
                        name: columnName,
                        type: 'bar',
                        data: data.toArray()
                    }
                );

                barOptions.legend.data.push(columnName);

            });

            roadTotalLengthByStatusChart.setOption(barOptions, true);

        };

        // Redimensiona los echarts al cambiar de tamaño la ventana
        $(window).resize(() => {
            roadTotalLengthByStatusChart.resize();
        });

    });

</script>

@else
    @include('errors.403')
    @endpermission
