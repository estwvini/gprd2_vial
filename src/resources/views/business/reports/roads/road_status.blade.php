@permission('index.cantonal_road_status.inventory_roads_report')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('reports/roads/roads_reports.labels.cantonal_road_status') }}
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="form-group col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="cantons_id" class="control-label">
                {{ trans('reports/roads/roads_reports.labels.canton') }}
            </label>
            <select name="cantons_id" id="cantons_id"
                    class="form-control select2">
                @foreach($cantons as $canton)
                    <option value="{{ $canton->canton }}">
                        {{ $canton->canton }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <div class="x-panel">
                <div class="x-content">
                    <div id="bySurfaceTypeBarChart" class="h-350"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <label for="surface_types_id" class="control-label">
                {{ trans('reports/roads/roads_reports.labels.surface_type') }}
            </label>
            <select name="surface_types_id" id="surface_types_id"
                    class="form-control select2">
                @foreach($rollingSurfaces as $surfaceType)
                    <option value="{{ $surfaceType->descrip }}">
                        {{ $surfaceType->descrip }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <div class="x-panel">
                <div class="x-content">
                    <div id="byCantonPieChart" class="h-350"></div>
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
                        <button id="export_excel" type="submit" class="btn btn-primary"><i
                                class="fa fa-upload"></i> {{ trans('reports/roads/roads_reports.labels.export') }}
                        </button>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="row" id="result">
                        <table class="table table-striped" id="road_status_report_tb">
                            <thead>
                            <tr id="myHeader">
                                <th>{{ trans('reports/roads/roads_reports.labels.road_status') }}</th>
                                <th>{{ trans('reports/roads/roads_reports.labels.canton') }}</th>
                            </tr>
                            </thead>
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

        let surfaceTypesSelect = $('#surface_types_id');
        let cantonsSelect = $('#cantons_id');
        let header = $('#myHeader');

        surfaceTypesSelect.select2();
        cantonsSelect.select2();

        let cantonPieChart = echarts.init(document.getElementById('byCantonPieChart'));
        let statusPerSurfaceBarChart = echarts.init(document.getElementById('bySurfaceTypeBarChart'));

        let barOptions = {
            title: {
                text: '{{ trans('reports/roads/roads_reports.labels.status_per_surface') }}',
                subtext: '',
                subtextStyle: {fontSize: 14},
                x: 'center'
            },
            tooltip: {trigger: 'item'},
            legend: {
                x: 'center',
                padding: [70, 5, 5, 5],
                data: ['{{ trans('reports/roads/roads_reports.labels.total_per_status') }}', '']
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
            color: ['#DB9469', '#2F4554'],
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
            series: [
                {
                    name: '',
                    type: 'bar',
                    data: []
                },
                {
                    name: '{{ trans('reports/roads/roads_reports.labels.total_per_status') }}',
                    type: 'bar',
                    data: []
                }
            ],
            grid: {
                y: 105
            }
        };

        let pieOptions = {
            title: {
                text: '{{ trans('reports/roads/roads_reports.labels.status_percentage') }}',
                subtext: '',
                subtextStyle: {fontSize: 14},
                x: 'center'
            },
            tooltip: {
                trigger: 'item',
                formatter: "{a}<br/>{b} : {d}%"
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
            color: ['#F4A261', '#4281A4', '#B8BEDD', '#FE938C',
                '#2A9D8F', '#264653'],
            series: [
                {
                    name: '{{ trans('reports/roads/roads_reports.labels.surface_type') }}',
                    type: 'pie',
                    radius: '60%',
                    center: ['55%', '60%'],
                    data: []
                }
            ]
        };

        let columns = [
            {data: 'status', name: 'status', sortable: false, class: 'text-center'},
            {data: 'canton', name: 'canton', sortable: false, class: 'text-center'}
        ];

        // Añade las columnas del datatable dinámicamente según los tipos de capa de rodadura.
        $.each({!! $rollingSurfaces !!}, (id, value) => {
            let headerTitle = value.descrip.toLowerCase().replace(/\b[a-z]/g, (txtVal) => {
                return txtVal.toUpperCase();
            });

            if (headerTitle === "Adoquin") {
                headerTitle = '{{ trans('reports/roads/roads_reports.labels.paved') }}';
            } else if (headerTitle === 'Pavimento Rigido') {
                headerTitle = '{{ trans('reports/roads/roads_reports.labels.rigid_pavement') }}';
            }

            $('#myHeader').append($('<th />', {text: headerTitle}));
            columns.push(
                {data: value.descrip, name: value.descrip, sortable: false, class: 'text-center'}
            );
        });

        header.append($('<th />', {text: '{{ trans('reports/roads/roads_reports.labels.total') }}'}));
        header.append($('<th />', {text: '{{ trans('reports/roads/roads_reports.labels.percentage') }}'}));
        columns.push(
            {data: 'total', name: 'total', sortable: false, class: 'text-center'},
            {data: 'percentage', name: 'percentage', sortable: false, class: 'text-center'}
        );

        let dataTable = build_datatable($('#road_status_report_tb'), {
            ajax: '{!! route('data.index.cantonal_road_status.inventory_roads_report') !!}',
            columns: columns,
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: '{{ trans('reports/roads/roads_reports.labels.gad') . $gad['province'] }}',
                    filename: '{{ trans('reports/roads/roads_reports.labels.road_status_file_name') }}',
                    messageTop: '{{ trans('reports/roads/roads_reports.labels.report') . trans('reports/roads/roads_reports.labels.cantonal_road_status') }}',
                    customize: function (xlsx) {

                        changeExcelStyle(xlsx);

                        let sheet = xlsx.xl.worksheets['sheet1.xml'];

                        let rowLength = $('#myHeader th').length + 1; // Because one column is hide.

                        let date = [{
                            key: 'A',
                            value: '{{ trans('reports/roads/roads_reports.labels.date') . date('d/m/Y') }}'
                        }];

                        for (let i = 0; i < rowLength; i++) {

                            if (i !== 0) {
                                date.push(
                                    {key: String.fromCharCode('A'.charCodeAt(0) + i), value: ''}
                                );
                            }
                        }

                        // First and Second row are added by title and messageTop options.
                        insertRow(sheet, 2, date);

                        updateRowsIndex(sheet);

                        mergeCells(sheet, 'A3:' + String.fromCharCode('A'.charCodeAt(0) + rowLength - 1) + '3');

                        /*
                        |-------------------------------
                        | Cell Styles for Excel
                        |-------------------------------
                        |
                        | s = 25 : Text, Normal 12, Thin Border, Left
                        | s = 67 : Text, Bold 20 White, Green Background, No Border, Center
                        | s = 68 : Text, Bold 18 White, Green Background, Thin Border, Center
                        | s = 69 : Number 2 Decimals, Normal 12, White Background, Thin Border, Center
                        | s = 72 : Text, Bold 18, Green Background, No Border, Left
                        | s = 73 : Text, Bold 14, Green Background, Thin Border, Center
                        | s = 74 : Text, Normal 12, White Background, Thin Border and Thick Bottom Border, Center
                        | s = 75 : Number 2 Decimals, Normal 12, White Background, Thin Border and Thick Bottom Border, Center
                        | s = 76 : Percentage 2 Decimals, Normal 12, White Background, Thin Border, Center
                        | s = 77 : Percentage 2 Decimals, Normal 12, White Background, Thin Border and Thick Bottom Border, Center
                        |
                         */

                        $('row:first-child c', sheet).attr('s', '67');
                        $('row:nth-child(2) c', sheet).attr('s', '72');
                        $('row:nth-child(3) c', sheet).attr('s', '72');
                        $('row:nth-child(4) c', sheet).attr('s', '73');
                        $('row:gt(3)', sheet).find('c:lt(2)').attr('s', '25');
                        $('row:gt(3)', sheet).find('c:lt(-1):gt(1)').attr('s', '69');
                        $('row:gt(3) c:last-child', sheet).attr('s', '76');

                        // Add a thick bottom border to separate rows by groups
                        $('row', sheet).each((index) => {
                            index = index + 1;
                            if (index % 4 === 0) {
                                let offset = index + 3;
                                let row = $('row:eq(' + offset + ')', sheet);
                                row.find('c:lt(2)').attr('s', '74');
                                row.find('c:lt(-1):gt(1)').attr('s', '75');
                                row.find('c:last-child').attr('s', '77');
                            }
                        });

                    }
                }
            ],
            columnDefs: [
                {visible: false, targets: 1}
            ],
            rowGroup: {
                dataSrc: 'canton'
            },
            searching: false,
            paging: false,
            initComplete: function () {
                let api = this.api();
                setStatusPerSurfacePieChartOptions();
                setStatusPerSurfaceBarChartOptions();

                $('#export_excel').on('click', () => {
                    api.buttons(0).trigger();
                });
            }
        });

        // Establece las opciones del echart para el gráfico de pastel por cantón.
        let setStatusPerSurfacePieChartOptions = () => {

            let selectedCanton = cantonsSelect.find('option:selected').val();
            let selectedSurfaceType = surfaceTypesSelect.find('option:selected').val();
            let columnName = null;
            let index = null;

            let columns = dataTable
                .settings()
                .init()
                .columns;

            if (columns) {

                dataTable.columns().every(function () {

                    let name = columns[this.index()].name;

                    if (selectedSurfaceType === name) {
                        index = this.index();
                        columnName = name;
                    }
                });

                let status = dataTable
                    .column(0)
                    .data();

                let canton = dataTable
                    .column(1)
                    .data();

                let data = dataTable
                    .column(index)
                    .data();

                pieOptions.title.subtext = columnName;
                pieOptions.series[0].data = [];

                for (let i = 0; i < data.length; i++) {
                    if (canton[i] === selectedCanton && Number(data[i]) !== 0 && status[i] !== '{{ trans('reports/roads/roads_reports.labels.actual_total') }}') {
                        pieOptions.series[0].data.push(
                            {value: data[i], name: status[i]}
                        );
                    }
                }

                cantonPieChart.setOption(pieOptions, true);

                // Hide Pie Chart if there is not data
                if (pieOptions.series[0].data.length === 0) {
                    $('#byCantonPieChart').hide();
                } else {
                    $('#byCantonPieChart').show();
                }
            }
        };

        // Establece las opciones del echart para el gráfico de barras de tipos de capas de rodadura.
        let setStatusPerSurfaceBarChartOptions = () => {
            let selectedCanton = cantonsSelect.find('option:selected').val();
            let selectedSurfaceType = surfaceTypesSelect.find('option:selected').val();
            let columnName = null;
            let index = null;
            let lastIndex = dataTable.columns().count() - 1;

            let columns = dataTable
                .settings()
                .init()
                .columns;

            dataTable.columns().every(function () {

                let name = columns[this.index()].name;

                if (selectedSurfaceType === name) {
                    index = this.index();
                    columnName = name;
                }
            });

            barOptions.series[0].data = [];
            barOptions.series[1].data = [];
            barOptions.title.subtext = columnName;
            barOptions.legend.data[1] = '{{ trans('reports/roads/roads_reports.labels.status_of') }}' + columnName;
            barOptions.series[0].name = '{{ trans('reports/roads/roads_reports.labels.status_of') }}' + columnName;

            let status = dataTable
                .column(0)
                .data();

            if (status) {

                barOptions.xAxis[0].data = status.toArray();

                let data = dataTable
                    .column(index)
                    .data();

                let canton = dataTable
                    .column(1)
                    .data();

                let total = dataTable
                    .column(lastIndex - 1)
                    .data();

                for (let i = 0; i < data.length; i++) {
                    if (canton[i] === selectedCanton) {
                        barOptions.series[0].data.push({value: data[i]});
                        barOptions.series[1].data.push({value: total[i]});
                    }
                }

                statusPerSurfaceBarChart.setOption(barOptions, true);

            }
        };

        cantonsSelect.on('change', () => {
            setStatusPerSurfacePieChartOptions();
            setStatusPerSurfaceBarChartOptions();
        });

        surfaceTypesSelect.on('change', () => {
            setStatusPerSurfacePieChartOptions();
            setStatusPerSurfaceBarChartOptions();
        });

        // Redimensiona los echarts al cambiar de tamaño la ventana
        $(window).resize(() => {
            statusPerSurfaceBarChart.resize();
            cantonPieChart.resize();
        });

    });

</script>

@else
    @include('errors.403')
    @endpermission
