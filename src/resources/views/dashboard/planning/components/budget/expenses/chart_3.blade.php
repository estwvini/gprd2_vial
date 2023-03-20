<div class="col-md-12" id="barChartCategoryTypeExp" style="min-height: 400px">
</div>

<script>
    $(() => {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        let barChartAccrued = am4core.create("barChartCategoryTypeExp", am4charts.XYChart);

        // Add data
        barChartAccrued.dataSource.url = "{{ route('execution.budget.dashboard.control_panel') }}";
        // chart.dataSource.reloadFrequency = 3000;

        // Add a legend
        barChartAccrued.legend = new am4charts.Legend();

        // Add a title
        let title = barChartAccrued.titles.create();
        title.text = "Ejecución Mensual del Presupuesto";
        title.fontSize = 18;

        let xAxis = barChartAccrued.xAxes.push(new am4charts.CategoryAxis())
        xAxis.dataFields.category = 'month'
        xAxis.renderer.cellStartLocation = 0.1
        xAxis.renderer.cellEndLocation = 0.9
        xAxis.renderer.grid.template.location = 0;
        // xAxis.renderer.grid.template.disabled = true;
        xAxis.renderer.grid.template.strokeDasharray = "3,3"

        let yAxis = barChartAccrued.yAxes.push(new am4charts.ValueAxis());
        yAxis.min = 0;
        // yAxis.renderer.grid.template.disabled = true;
        yAxis.renderer.grid.template.strokeDasharray = "3,3"

        // Create series
        let series1 = barChartAccrued.series.push(new am4charts.ColumnSeries());
        series1.dataFields.valueY = "comprometido";
        series1.dataFields.categoryX = "month";
        series1.name = "Comprometido";
        series1.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
        // series1.columns.template.fillOpacity = .8;
        series1.columns.template.fill = am4core.color("#f80");
        series1.columns.template.stroke = am4core.color("#f80");
        series1.events.on("hidden", arrangeColumns);
        series1.events.on("shown", arrangeColumns);

        // Create series
        let series2 = barChartAccrued.series.push(new am4charts.ColumnSeries());
        series2.dataFields.valueY = "devengado";
        series2.dataFields.categoryX = "month";
        series2.name = "Devengado";
        series2.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
        // series2.columns.template.fillOpacity = .8;
        series2.columns.template.fill = am4core.color("#7dc855");
        series2.columns.template.stroke = am4core.color("#7dc855");
        series2.events.on("hidden", arrangeColumns);
        series2.events.on("shown", arrangeColumns);

        // Create series
        let series3 = barChartAccrued.series.push(new am4charts.ColumnSeries());
        series3.dataFields.valueY = "certificado";
        series3.dataFields.categoryX = "month";
        series3.name = "Certificado";
        series3.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
        // series3.columns.template.fillOpacity = .8;
        series3.columns.template.fill = am4core.color("#ffeb3b");
        series3.columns.template.stroke = am4core.color("#ffeb3b");
        series3.events.on("hidden", arrangeColumns);
        series3.events.on("shown", arrangeColumns);

        function arrangeColumns() {

            var series = barChartAccrued.series.getIndex(0);

            var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
            if (series.dataItems.length > 1) {
                var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
                var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
                var delta = ((x1 - x0) / barChartAccrued.series.length) * w;
                if (am4core.isNumber(delta)) {
                    var middle = barChartAccrued.series.length / 2;

                    var newIndex = 0;
                    barChartAccrued.series.each(function (series) {
                        if (!series.isHidden && !series.isHiding) {
                            series.dummyData = newIndex;
                            newIndex++;
                        } else {
                            series.dummyData = barChartAccrued.series.indexOf(series);
                        }
                    })
                    var visibleCount = newIndex;
                    var newMiddle = visibleCount / 2;

                    barChartAccrued.series.each(function (series) {
                        var trueIndex = barChartAccrued.series.indexOf(series);
                        var newIndex = series.dummyData;

                        var dx = (newIndex - trueIndex + middle - newMiddle) * delta

                        series.animate({property: "dx", to: dx}, series.interpolationDuration, series.interpolationEasing);
                        series.bulletsContainer.animate({property: "dx", to: dx}, series.interpolationDuration, series.interpolationEasing);
                    })
                }
            }
        }
    });
</script>