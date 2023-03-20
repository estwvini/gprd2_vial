<div class="col-md-12 col-lg-12 col-ms-12 col-xs-12" id="barChartResponsibleUnitsProject" style="min-height: 700px">

</div>

<script>
    $(() => {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        let chart_5 = am4core.create("barChartResponsibleUnitsProject", am4charts.XYChart);

        // Add data

        chart_5.dataSource.url = "{{ route('category.projects.dashboard.control_panel') }}";
        // chart_5.dataSource.reloadFrequency = 30000;

        // Add a title
        let title = chart_5.titles.create();
        title.text = "Avance ejecucción física y presupuestaria";
        title.fontSize = 18;

        // Create axes
        let categoryAxis = chart_5.yAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "category";
        categoryAxis.renderer.grid.template.strokeDasharray = "3,3"
        categoryAxis.autoGridCount = false;
        categoryAxis.gridCount = 50;
        categoryAxis.renderer.minGridDistance = 10;
        categoryAxis.renderer.cellStartLocation = 0.1
        categoryAxis.renderer.cellEndLocation = 0.9
        categoryAxis.renderer.grid.template.location = 0;

        let valueAxis = chart_5.xAxes.push(new am4charts.ValueAxis());
        valueAxis.min = 0;
        valueAxis.renderer.baseGrid.disabled = true;
        valueAxis.renderer.opposite = true;
        valueAxis.renderer.grid.template.strokeDasharray = "3,3"

        // Create series
        function createSeries(field, name) {

            // Set up series
            var series = chart_5.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueX = field;
            series.dataFields.categoryY = "category";
            series.name = name;

            // Configure columns
            series.columns.template.width = am4core.percent(100);
            series.columns.template.tooltipText = "[font-size:14px]{categoryY}: [bold]{valueX}[/bold]";

            return series;
        }

        chart_5.colors.list = [
            am4core.color("#03a9f4"),
            am4core.color("#FFC75F"),
            am4core.color("#7dc855"),
            am4core.color("#D65DB1"),
            am4core.color("#FF6F91")
        ];

        createSeries("progress", "Avance Físico");
        createSeries("budget_percent", "Avance Presupuestario");

        // Legend
        chart_5.legend = new am4charts.Legend();


        // Set cell size in pixels
        var cellSize = 30;
        chart_5.events.on("datavalidated", function(ev) {

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