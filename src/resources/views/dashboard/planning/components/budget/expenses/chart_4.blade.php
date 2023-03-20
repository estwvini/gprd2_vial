<div class="col-md-12 col-lg-12 col-ms-12 col-xs-12" id="barChartResponsibleUnits" style="min-height: 700px">

</div>

<script>
    $(() => {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        let chart_4 = am4core.create("barChartResponsibleUnits", am4charts.XYChart);

        // Add data
        chart_4.dataSource.url = "{{ route('category.budget.dashboard.control_panel', ['type' => 1, 'category' => 'unit']) }}";
        // chart_4.dataSource.reloadFrequency = 30000;

        // Add a title
        let title = chart_4.titles.create();
        title.text = "Presupuesto por Unidades Responsables";
        title.fontSize = 18;

        // Create axes
        let categoryAxis = chart_4.yAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "category";
        categoryAxis.renderer.grid.template.strokeDasharray = "3,3"
        categoryAxis.autoGridCount = false;
        categoryAxis.gridCount = 50;
        categoryAxis.renderer.minGridDistance = 10;
        categoryAxis.renderer.cellStartLocation = 0.1
        categoryAxis.renderer.cellEndLocation = 0.9
        categoryAxis.renderer.grid.template.location = 0;

        let valueAxis = chart_4.xAxes.push(new am4charts.ValueAxis());
        valueAxis.min = 0;
        valueAxis.renderer.baseGrid.disabled = true;
        valueAxis.renderer.opposite = true;
        valueAxis.renderer.grid.template.strokeDasharray = "3,3"

        // Create series
        function createSeries(field, name) {

            // Set up series
            var series = chart_4.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueX = field;
            series.dataFields.categoryY = "category";
            series.name = name;

            // Configure columns
            series.columns.template.width = am4core.percent(100);
            series.columns.template.tooltipText = "[font-size:14px]{categoryY}: [bold]{valueX}[/bold]";

            return series;
        }

        chart_4.colors.list = [
            am4core.color("#03a9f4"),
            am4core.color("#FFC75F"),
            am4core.color("#7dc855"),
            am4core.color("#D65DB1"),
            am4core.color("#FF6F91")
        ];

        createSeries("asignado", "Asignado Inicial");
        createSeries("codificado", "Codificado");
        createSeries("devengado", "Devengado");
        createSeries("por_devengar", "Por Devengar");

        // Legend
        chart_4.legend = new am4charts.Legend();


        // Set cell size in pixels
        var cellSize = 30;
        chart_4.events.on("datavalidated", function(ev) {

            // Get objects of interest
            var chart = ev.target;
            var categoryAxis = chart.yAxes.getIndex(0);

            // Calculate how we need to adjust chart height
            var adjustHeight = chart.data.length * cellSize - categoryAxis.pixelHeight;

            // get current chart height
            var targetHeight = chart.pixelHeight + adjustHeight;

            // Set it on chart's container
            chart.svgContainer.htmlElement.style.height = targetHeight + "px";
        });
    });
</script>