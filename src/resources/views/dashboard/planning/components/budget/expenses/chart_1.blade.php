<div class="col-md-6 col-lg-6 col-ms-6 col-xs-12" id="pieChartCategorySourceExp" style="min-height: 300px">

</div>

<script>
    $(() => {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        let chart = am4core.create("pieChartCategorySourceExp", am4charts.PieChart);

        // Add data
        chart.dataSource.url = "{{ route('category.budget.dashboard.control_panel', ['type' => 1, 'category' => 'source']) }}";
        // chart.dataSource.reloadFrequency = 3000;

        // Set inner radius
        // chart.innerRadius = am4core.percent(70);

        // Add a legend
        chart.legend = new am4charts.Legend();

        // Add a title
        var title = chart.titles.create();
        title.text = "Gastos x Fuente de Financiamiento";
        title.fontSize = 18;

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
    });
</script>