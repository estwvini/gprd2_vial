<div class="col-md-6 col-lg-6 col-ms-6 col-xs-12" id="pieChartCategorySourceInc" style="min-height: 300px">

</div>

<script>
    $(() => {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        let chart = am4core.create("pieChartCategorySourceInc", am4charts.PieChart);

        // Add data
        chart.dataSource.url = "{{ route('category.budget.dashboard.control_panel', ['type' => 2, 'category' => 'source']) }}";
        // chart.dataSource.reloadFrequency = 3000;

        // Set inner radius
        // chart.innerRadius = am4core.percent(70);

        // Add a legend
        chart.legend = new am4charts.Legend();

        // Add a title
        var title = chart.titles.create();
        title.text = "Ingresos x Fuente de Financiamiento";
        title.fontSize = 15;

        // Add and configure Series
        let pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "codificado";
        pieSeries.dataFields.category = "category";
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeWidth = 2;
        pieSeries.slices.template.strokeOpacity = 1;
        pieSeries.ticks.template.disabled = true;
        pieSeries.alignLabels = false;
        pieSeries.labels.template.text = "";

        // This creates initial animation
        pieSeries.hiddenState.properties.opacity = 1;
        pieSeries.hiddenState.properties.endAngle = -90;
        pieSeries.hiddenState.properties.startAngle = -90;

        // Set colors list
        pieSeries.colors.list = [
            am4core.color("#845EC2"),
            am4core.color("#D65DB1"),
            am4core.color("#FF6F91"),
            am4core.color("#FF9671"),
            am4core.color("#FFC75F"),
            am4core.color("#F9F871"),
        ];
    });
</script>