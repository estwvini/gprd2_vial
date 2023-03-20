<div class="col-md-6 col-lg-6 col-ms-6 col-xs-12" id="donutChart" style="min-height: 300px">

</div>

<script>
    $(() => {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        let chart = am4core.create("donutChart", am4charts.PieChart);

        // Add data
        chart.dataSource.url = "{{ $url }}";
        // chart.dataSource.reloadFrequency = 3000;

        // Set inner radius
        chart.innerRadius = am4core.percent(70);

        // Add a legend
        chart.legend = new am4charts.Legend();

        // Add a title
        var title = chart.titles.create();
        title.text = "Estado";
        title.fontSize = 15;

        // Add and configure Series
        let pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "count";
        pieSeries.dataFields.category = "status";
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeWidth = 2;
        pieSeries.slices.template.strokeOpacity = 1;
        pieSeries.ticks.template.disabled = true;
        pieSeries.alignLabels = false;
        pieSeries.labels.template.text = "";

        var label = pieSeries.createChild(am4core.Label);
        label.text = "8 \nActividades";
        label.horizontalCenter = "middle";
        label.verticalCenter = "middle";
        label.textAlign = "middle";
        label.fontSize = 16;

        // This creates initial animation
        pieSeries.hiddenState.properties.opacity = 1;
        pieSeries.hiddenState.properties.endAngle = -90;
        pieSeries.hiddenState.properties.startAngle = -90;

        pieSeries.slices.template.adapter.add("fill", function (fill, target) {
            if (target.dataItem) {
                switch (target.dataItem.category) {
                    case 'Con retraso':
                        return am4core.color("#d9534f");
                    case 'Pendiente':
                        return am4core.color("#845EC2");
                    case 'En curso':
                        return am4core.color("#3498DB");
                    case 'Completada':
                        return am4core.color("#5cb85c");
                    case 'Cancelada':
                        return am4core.color("#fcd727");
                }
            } else {
                return fill;
            }
        });

        chart.dataSource.events.on("done", function (ev) {
            let sum = ev.target.data.reduce((index, value) => {
                return index + (value.status !== 'Completada' && value.status !== 'Con retraso' ? (parseFloat(value.count) || 0) : 0);
            }, 0);
            label.text = sum + "\nRestantes";
        });
    });
</script>