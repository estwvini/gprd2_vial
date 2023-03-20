<div id="chart" style="min-height: 300px">
</div>

<script>
    $(() => {
        am4core.ready(function () {
            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end
            // Create chart instance
            let chart = am4core.create("chart", am4charts.XYChart);

            // Add data
            chart.dataSource.url = "{{ route('chart.staff', $departmentId) }}";

            // Create axes
            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "week";
            categoryAxis.title.text = "Semanas";

            chart.cursor = new am4charts.XYCursor();

            /* Configure axis tooltip */
            var axisTooltip = categoryAxis.tooltip;
            axisTooltip.background.strokeWidth = 0;
            axisTooltip.background.cornerRadius = 3;
            axisTooltip.background.pointerLength = 0;
            axisTooltip.dy = 5;

            var dropShadow = new am4core.DropShadowFilter();
            dropShadow.dy = 1;
            dropShadow.dx = 1;
            dropShadow.opacity = 0.5;
            axisTooltip.filters.push(dropShadow);

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.title.text = '%'
            valueAxis.min = 0;
            valueAxis.max = 100;
            valueAxis.renderer.grid.template.disabled = true;
            valueAxis.renderer.labels.template.disabled = true;

            function createGrid(value) {
                let range = valueAxis.axisRanges.create();
                range.value = value;
                range.label.text = "{value}";
            }

            createGrid(0);
            createGrid(20);
            createGrid(40);
            createGrid(60);
            createGrid(80);
            createGrid(100);

            // Create series Av Físico
            var series = chart.series.push(new am4charts.LineSeries());
            series.dataFields.valueY = "physical_progress";
            series.dataFields.categoryX = "week";
            series.strokeWidth =2;
            series.minBulletDistance = 15;
            series.name = 'Av. Físico';
            series.tooltipText = "{name}: [bold]{valueY}[/]";
            series.stroke = am4core.color("#a56dd9");

            // Make bullets grow on hover
            let circleBullet = series.bullets.push(new am4charts.CircleBullet());
            circleBullet.circle.fill = am4core.color("#fff");
            circleBullet.propertyFields.stroke = "color";
            circleBullet.circle.strokeWidth = 2;

            var bullethover = circleBullet.states.create("hover");
            bullethover.properties.scale = 1.3;

            // Create series Av Presupuestario
            var series_1 = chart.series.push(new am4charts.LineSeries());
            series_1.dataFields.valueY = "budget_progress";
            series_1.dataFields.categoryX = "week";
            series_1.strokeWidth =2;
            series_1.minBulletDistance = 15;
            series_1.name = 'Av. Presupuestario';
            series_1.tooltipText = "{name}: [bold]{valueY}[/]";
            series_1.stroke = am4core.color("#15b943");

            // Make bullets grow on hover
            let circleBullet_1 = series_1.bullets.push(new am4charts.CircleBullet());
            circleBullet_1.circle.fill = am4core.color("#fff");
            circleBullet_1.propertyFields.stroke = "color";
            circleBullet_1.circle.strokeWidth = 2;

            var bullethover_1 = circleBullet_1.states.create("hover");
            bullethover_1.properties.scale = 1.3;

            // Legend
            chart.legend = new am4charts.Legend();

        });
    });
</script>
