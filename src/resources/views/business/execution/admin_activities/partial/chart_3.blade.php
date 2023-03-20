<div class="col-md-12 col-lg-12 col-ms-12 col-xs-12" id="donutChartUsers" style="min-height: 500px">

</div>

<script>
    $(() => {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        let chart_3 = am4core.create("donutChartUsers", am4charts.XYChart);

        // Add data
        chart_3.dataSource.url = "{{ route('chart_3.graphic.admin_activities.execution') }}";
        // chart_3.dataSource.reloadFrequency = 30000;

        // Add a title
        let title = chart_3.titles.create();
        title.text = "Responsables";
        title.fontSize = 15;

        // Create axes
        let categoryAxis = chart_3.yAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "user";
        categoryAxis.renderer.grid.template.disabled = true;
        categoryAxis.autoGridCount = false;
        categoryAxis.gridCount = 32;
        categoryAxis.renderer.minGridDistance = 10;


        let valueAxis = chart_3.xAxes.push(new am4charts.ValueAxis());
        valueAxis.min = 0;
        valueAxis.renderer.minGridDistance = 100;
        valueAxis.renderer.grid.template.opacity = 0;
        valueAxis.renderer.ticks.template.strokeOpacity = 0.5;
        valueAxis.renderer.ticks.template.stroke = am4core.color("#495C43");
        valueAxis.renderer.ticks.template.length = 10;
        valueAxis.renderer.line.strokeOpacity = 0.5;
        valueAxis.renderer.baseGrid.disabled = true;
        valueAxis.renderer.opposite = true;

        // Create series
        function createSeries(field, name) {

            // Set up series
            var series = chart_3.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueX = field;
            series.dataFields.categoryY = "user";
            series.stacked = true;
            series.name = name;

            // Configure columns
            series.columns.template.width = am4core.percent(40);
            series.columns.template.tooltipText = "[font-size:14px]{categoryY}: [bold]{valueX}[/bold]";

            switch (field) {
                case 'delay':
                    series.columns.template.fill = am4core.color("#d9534f");
                    series.columns.template.stroke = am4core.color("#d9534f");
                    break
                case 'draft':
                    series.columns.template.fill = am4core.color("#845EC2");
                    series.columns.template.stroke = am4core.color("#845EC2");
                    break
                case 'in_progress':
                    series.columns.template.fill = am4core.color("#3498DB");
                    series.columns.template.stroke = am4core.color("#3498DB");
                    break
                case 'completed':
                    series.columns.template.fill = am4core.color("#5cb85c");
                    series.columns.template.stroke = am4core.color("#5cb85c");
                    break
                case 'canceled':
                    series.columns.template.fill = am4core.color("#fcd727");
                    series.columns.template.stroke = am4core.color("#fcd727");
                    break
            }

            // Add label
            var labelBullet = series.bullets.push(new am4charts.LabelBullet());
            labelBullet.locationX = 0.5;
            labelBullet.label.text = "{valueX}";
            labelBullet.label.hideOversized = true;

            return series;
        }

        createSeries("completed", "Completada");
        createSeries("in_progress", "En curso");
        createSeries("delay", "Con retraso");
        createSeries("draft", "Pendiente");
        createSeries("canceled", "Cancelada");

        // Legend
        chart_3.legend = new am4charts.Legend();
        // chart_3.legend.position = "right";

        chart_3.dataSource.events.on("done", function (ev) {
            valueAxis.max = Math.max.apply(Math, ev.target.data.map(function (o) {
                return o.delay + o.draft + o.in_progress + o.completed;
            }));
        });

        // Set cell size in pixels
        var cellSize = 30;
        chart_3.events.on("datavalidated", function(ev) {

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