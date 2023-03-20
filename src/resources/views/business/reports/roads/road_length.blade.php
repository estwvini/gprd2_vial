@permission('index.cantonal_road_length.inventory_roads_report')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('reports/roads/roads_reports.labels.cantonal_road_length') }}
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="form-group col-md-6 col-sm-6 col-xs-12">
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
                    <div id="bySurfaceTypeBarChart" class="h-350"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
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
                        <button id="export_excel" class="btn btn-primary dt-button"><i
                                class="fa fa-upload"></i> {{ trans('reports/roads/roads_reports.labels.export') }}
                        </button>
                    </div>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="row" id="result">
                        <table class="table table-striped" id="cantonal_road_length_report_tb">
                            <thead>
                            <tr id="myHeader">
                                <th>{{ trans('reports/roads/roads_reports.labels.canton') }}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr id="tfoot-tr-1">
                                <th>{{ trans('reports/roads/roads_reports.labels.total') }}</th>
                            </tr>
                            <tr id="tfoot-tr-2">
                                <th>{{ trans('reports/roads/roads_reports.labels.percentage') }}</th>
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

        let surfaceTypesSelect = $('#surface_types_id');
        let cantonsSelect = $('#cantons_id');

        surfaceTypesSelect.select2();
        cantonsSelect.select2();

        let cantonPieChart = echarts.init(document.getElementById('byCantonPieChart'));
        let surfaceTypeBarChart = echarts.init(document.getElementById('bySurfaceTypeBarChart'));

        let barOptions = {
            title: {
                text: '{{ trans('reports/roads/roads_reports.labels.representative_surface') }}',
                subtext: '',
                subtextStyle: {fontSize: 14},
                x: 'center'
            },
            tooltip: {trigger: 'item'},
            legend: {
                x: 'center',
                padding: [55, 5, 5, 5],
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
            color: ['#DB9469', '#2F4554'],
            xAxis: [
                {
                    splitArea: {show: true},
                    axisLabel: {
                        interval: 0,
                        rotate: 30
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
                    name: '{{ trans('reports/roads/roads_reports.labels.total_length') }}',
                    type: 'bar',
                    data: []
                }
            ],
            grid: {
                y: 85,
                y2: 80
            }
        };

        let pieOptions = {
            title: {
                text: '{{ trans('reports/roads/roads_reports.labels.length_percentage') }}',
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
                '#2A9D8F', '#264653', '#BCE784', '#B2DBBF',
                '#EFC3E6', '#513B56', '#5DD39E', '#BFC0C0',
                '#E9C46A'],
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

            $('#myHeader').append($('<th />', {text: headerTitle, class: 'calculationEnabled'}));
            $('#tfoot-tr-1').append($('<th />'));
            $('#tfoot-tr-2').append($('<th />'));
            columns.push(
                {data: value.descrip, name: value.descrip, sortable: false, class: 'text-center'}
            );
        });

        $('#myHeader').append($('<th />', {text: 'Total'}));
        columns.push(
            {data: 'total', name: 'total', sortable: false, class: 'text-center'}
        );
        $('#tfoot-tr-1').append($('<th />'));
        $('#tfoot-tr-2').append($('<th />'));

        let dataTable = build_datatable($('#cantonal_road_length_report_tb'), {
            ajax: '{!! route('data.index.cantonal_road_length.inventory_roads_report') !!}',
            columns: columns,
            searching: false,
            paging: false,
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: '{{ trans('reports/roads/roads_reports.labels.gad') . $gad['province'] }}',
                    filename: '{{ trans('reports/roads/roads_reports.labels.length_surface_file_name') }}',
                    messageTop: '{{ trans('reports/roads/roads_reports.labels.report') . trans('reports/roads/roads_reports.labels.cantonal_road_length') }}',
                    footer: true,
                    customize: function (xlsx) {

                        changeExcelStyle(xlsx);

                        let sheet = xlsx.xl.worksheets['sheet1.xml'];

                        let numRows = $('row', sheet).length;

                        let footerLength = $('#tfoot-tr-2 th').length;

                        let footer = [];
                        let date = [{
                            key: 'A',
                            value: '{{ trans('reports/roads/roads_reports.labels.date') . date('d/m/Y') }}'
                        }];

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
                        insertRow(sheet, numRows + 1, footer, true);

                        updateRowsIndex(sheet);

                        mergeCells(sheet, 'A3:' + String.fromCharCode('A'.charCodeAt(0) + footerLength - 1) + '3');

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
                        $('row', sheet).slice(4, lastIndex - 1).find('c:not(:first-child)').attr('s', '69');
                        $('row', sheet).slice(4, lastIndex - 1).find('c:first-child').attr('s', '25');
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

                let fullTotal = api
                    .column(-1) // Last index
                    .data()
                    .reduce(function (a, b) {
                        return parseFloat(intVal(a)) + parseFloat(intVal(b));
                    }, 0);

                $('#tfoot-tr-1').find('th').eq(-1).html(
                    fullTotal.toFixed(2)
                );

                $('#tfoot-tr-2').find('th').eq(-1).html('100.00%');

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
                    let percentage = (Number(total.toFixed(2)) * 100) / Number(fullTotal.toFixed(2));

                    // Update footer
                    $('#tfoot-tr-1').find('th').eq(index).html(
                        total.toFixed(2)
                    );

                    $('#tfoot-tr-2').find('th').eq(index).html(
                        percentage.toFixed(2) + '%'
                    );
                });

                setCantonPieChartOptions();
                setSurfaceTypeBarChart();
            },
            initComplete: function () {
                let api = this.api();
                $('#export_excel').on('click', () => {
                    api.buttons(0).trigger();
                });
            }
        });

        // Establece las opciones del echart para el gráfico de pastel por cantón.
        let setCantonPieChartOptions = () => {

            let selectedCanton = cantonsSelect.find('option:selected').val();
            let index = dataTable.column(0).data().indexOf(selectedCanton);

            let data = dataTable
                .row(index)
                .data();

            if (data) {

                pieOptions.title.subtext = data.canton;
                pieOptions.series[0].data = [];

                $.each(data, (type, value) => {
                    if (Number(value) > 0 && type !== 'canton' && type !== 'total') {
                        pieOptions.series[0].data.push(
                            {value: value, name: type}
                        );
                    }
                });
                cantonPieChart.setOption(pieOptions, true);
            }
        };

        // Establece las opciones del echart para el gráfico de barras de tipos de capas de rodadura.
        let setSurfaceTypeBarChart = () => {
            let selectedSurfaceType = surfaceTypesSelect.find('option:selected').val();
            let columnName = null;
            let index = null;

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
            barOptions.legend.data[1] = '{{ trans('reports/roads/roads_reports.labels.element_total') }}' + columnName;
            barOptions.series[0].name = '{{ trans('reports/roads/roads_reports.labels.element_total') }}' + columnName;

            let cantons = dataTable
                .column(0)
                .data();

            barOptions.xAxis[0].data = cantons.toArray();

            let data = dataTable
                .column(index)
                .data();

            let total = dataTable
                .column(-1)
                .data();

            for (let i = 0; i < data.length; i++) {
                barOptions.series[0].data.push({value: data[i]});
                barOptions.series[1].data.push({value: total[i]});
            }

            surfaceTypeBarChart.setOption(barOptions, true);

        };

        cantonsSelect.on('change', () => {
            setCantonPieChartOptions();
        });

        surfaceTypesSelect.on('change', () => {
            setSurfaceTypeBarChart();
        });

        // Redimensiona los echarts al cambiar de tamaño la ventana
        $(window).resize(() => {
            surfaceTypeBarChart.resize();
            cantonPieChart.resize();
        });

    });

</script>

@else
    @include('errors.403')
    @endpermission
