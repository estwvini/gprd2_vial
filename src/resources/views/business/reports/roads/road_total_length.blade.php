@permission('index.cantonal_road_total.inventory_roads_report')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('reports/roads/roads_reports.labels.cantonal_road_total_length') }}
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="form-group">
            <div class="x-panel">
                <div class="x-content">
                    <div id="byCantonRoadPieChart" class="h-350"></div>
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
                        <table class="table table-striped" id="cantonal_road_total_length_report_tb">
                            <thead>
                            <tr id="myHeader">
                                <th>{{ trans('reports/roads/roads_reports.labels.number') }}</th>
                                <th>{{ trans('reports/roads/roads_reports.labels.canton') }}</th>
                                <th>{{ trans('reports/roads/roads_reports.labels.length') }}</th>
                                <th>{{ trans('reports/roads/roads_reports.labels.road_percentage') }}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr id="tfoot-tr-1">
                                <th></th>
                                <th>{{ trans('reports/roads/roads_reports.labels.total') }}</th>
                                <th></th>
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
        let cantonRoadPieChart = echarts.init(document.getElementById('byCantonRoadPieChart'));

        let pieOptions = {
            title: {
                text: '{{ trans('reports/roads/roads_reports.labels.total_length_percentage') }}',
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
                '#EFC3E6', '#513B56'],
            series: [
                {
                    name: '{{ trans('reports/roads/roads_reports.labels.road_percentage') }}',
                    type: 'pie',
                    radius: '60%',
                    center: ['50%', '60%'],
                    data: []
                }
            ]
        };

        let dataTable = build_datatable($('#cantonal_road_total_length_report_tb'), {
            ajax: '{!! route('data.index.cantonal_road_total.inventory_roads_report') !!}',
            columns: [
                {data: 'number', name: 'number', sortable: false, class: 'text-center'},
                {data: 'canton', name: 'canton', sortable: true, class: 'text-center'},
                {data: 'length', name: 'length', sortable: false, class: 'text-center'},
                {data: 'percentage', name: 'percentage', sortable: false, class: 'text-center'}
            ],
            searching: false,
            paging: false,
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: '{{ trans('reports/roads/roads_reports.labels.gad') . $gad['province'] }}',
                    filename: '{{ trans('reports/roads/roads_reports.labels.total_length_file_name') }}',
                    messageTop: '{{ trans('reports/roads/roads_reports.labels.report') . trans('reports/roads/roads_reports.labels.cantonal_road_total_length') }}',
                    footer: true,
                    customize: function (xlsx) {

                        changeExcelStyle(xlsx);

                        let sheet = xlsx.xl.worksheets['sheet1.xml'];

                        let rowLength = $('row:nth-child(3) c', sheet).length;

                        let date = [{key: 'A', value: '{{ trans('reports/roads/roads_reports.labels.date') . date('d/m/Y') }}'}];

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
                        | s = 69 : Number 2 Decimals, Normal 12, White Background, Thin Border, Center
                        | s = 71 : Percentage, Bold 14 White, Green Background, Thin Border, Center
                        | s = 72 : Text, Bold 18, Green Background, No Border, Left
                        | s = 73 : Text, Bold 14, Green Background, Thin Border, Center
                        | s = 76 : Percentage, Normal 12, White Background, Thin Border, Center
                        | s = 78 : Number, Normal 12, White Background, Thin Border, Center
                        |
                         */

                        let lastIndex = $('row:last-child', sheet).index();
                        $('row:first-child c', sheet).attr('s', '67');
                        $('row:nth-child(2) c', sheet).attr('s', '72');
                        $('row:nth-child(3) c', sheet).attr('s', '72');
                        $('row:nth-child(4) c', sheet).attr('s', '73');
                        $('row', sheet).slice(4, lastIndex).find('c:first-child').attr('s', '78');
                        $('row', sheet).slice(4, lastIndex).find('c:nth-child(2)').attr('s', '25');
                        $('row', sheet).slice(4, lastIndex).find('c:nth-child(3)').attr('s', '69');
                        $('row', sheet).slice(4, lastIndex).find('c:nth-child(4)').attr('s', '76');
                        $('row:last-child c:first-child', sheet).attr('s', '73');
                        $('row:last-child c:nth-child(2)', sheet).attr('s', '70');
                        $('row:last-child c:nth-child(3)', sheet).attr('s', '71');
                    }
                }
            ],
            footerCallback: function () {
                let api = this.api();
                let total = api.ajax.json().total;
                let footer = $('#tfoot-tr-1');

                footer.find('th').eq(2).html(total);
                footer.find('th').eq(-1).html('100.00%');

                setCantonRoadPieChartOptions();
            },
            initComplete: function () {
                let api = this.api();
                $('#export_excel').on('click', () => {
                    api.buttons(0).trigger();
                });
            }
        });

        // Establece las opciones del echart para el gráfico de pastel por cantón.
        let setCantonRoadPieChartOptions = () => {
            let data = dataTable.data();

            pieOptions.title.subtext = '{{ $gad['province'] }}'.toUpperCase();
            pieOptions.series[0].data = [];

            $.each(data, (index, row) => {
                pieOptions.series[0].data.push(
                    {value: row.length, name: row.canton}
                );
            });

            cantonRoadPieChart.setOption(pieOptions, true);
        };

        // Redimensiona los echarts al cambiar de tamaño la ventana
        $(window).resize(() => {
            cantonRoadPieChart.resize();
        });

    });

</script>

@else
    @include('errors.403')
    @endpermission
