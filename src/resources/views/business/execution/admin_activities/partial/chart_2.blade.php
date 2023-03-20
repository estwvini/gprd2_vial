<div class="col-md-6 col-lg-6 col-ms-6 col-xs-12" id="donutChartPriority" style="min-height: 300px">

</div>

<script>
    $(() => {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        let chart_2 = am4core.create("donutChartPriority", am4charts.XYChart);

        // Add data
        chart_2.dataSource.url = "{{ $url }}";
        // chart_2.dataSource.reloadFrequency = 30000;

        // Add a title
        let title = chart_2.titles.create();
        title.text = "Prioridad";
        title.fontSize = 15;

        // Create axes
        let categoryAxis = chart_2.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "priority";
        categoryAxis.renderer.grid.template.disabled = true;

        let valueAxis = chart_2.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.inside = true;
        valueAxis.renderer.labels.template.disabled = true;
        valueAxis.renderer.grid.template.disabled = true;
        valueAxis.min = 0;

        // Create series
        function createSeries(field, name) {

            // Set up series
            let series = chart_2.series.push(new am4charts.ColumnSeries());
            series.name = name;
            series.dataFields.valueY = field;
            series.dataFields.categoryX = "priority";
            series.sequencedInterpolation = true;

            // Make it stacked
            // series.stacked = true;

            // Configure columns
            series.columns.template.width = am4core.percent(60);
            series.columns.template.tooltipText = "{categoryX}\n[font-size:14px]{name}: [bold]{valueY}[/bold]";

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
            }

            // Add label
            let labelBullet = series.bullets.push(new am4charts.LabelBullet());
            labelBullet.label.text = "{valueY}";
            labelBullet.locationY = 0.5;
            labelBullet.label.hideOversized = true;

            return series;
        }

        createSeries("completed", "Completada");
        createSeries("in_progress", "En curso");
        createSeries("delay", "Con retraso");
        createSeries("draft", "Pendiente");
        createSeries("canceled", "Cancelada");

        // Legend
        chart_2.legend = new am4charts.Legend();
    });
</script>