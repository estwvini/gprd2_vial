<div class="x_panel tile  overflow_hidden">
    <div class="dashboard-title">
        <h3>{{ trans('plans.description.PEI') }} ({{ trans('plans.labels.PEI') }})</h3>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row top_tiles">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="x_content">
                        <h4>PEI</h4>
                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            <canvas id="canvasDoughnut2" height="140" width="140" style="width: 140px; height: 140px;"></canvas>
                        </div>

                        <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-check"></i></div>
                                <div class="count">13</div>
                                <h3>Proyectos</h3>
                                <p>Texto de Prueba</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats tile">
                    <div class="x_content">
                        <span>Articulaciones</span>
                        <h2>231,809</h2>
                        <canvas id="line_chart" width="200" height="40" style="display: inline-block; width: 200px; height: 40px; vertical-align: top;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        // doughnut chart
        let config3 = {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        30,
                        20,
                        50,
                    ],
                    backgroundColor: [
                        'rgba(3, 88, 106, 0.8)',
                        'rgba(182, 135, 20, 0.8)',
                        'rgba(207, 212, 216, 1)'
                    ],
                    hoverBackgroundColor: [
                        'rgba(3, 88, 106, 0.5)',
                        'rgba(182, 135, 20, 0.5)',
                        'rgba(207, 212, 216, 0.7)'
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'Red',
                    'Orange',
                    'Yellow',
                ]
            },
            options: {
                responsive: true,
                legend: {
                    display: false,
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Doughnut Chart',
                    position: 'bottom'
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        };

        let ctx3 = document.getElementById('canvasDoughnut2').getContext('2d');
        new Chart(ctx3, config3);

        // line chart
        var randomScalingFactor = () => {
            return Math.round(Math.random() * 100);
        };
        var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        var config = {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    fill: true,
                    backgroundColor: 'rgb(234, 234, 234)',
                    borderColor: 'rgb(83, 185, 154)',
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor()
                    ],
                }]
            },
            options: {
                responsive: true,
                legend: {
                    display: false,
                    position: 'bottom',
                },
                title: {
                    display: false,
                    text: 'Chart.js Line Chart'
                },
                scales: {
                    xAxes: [{
                        display: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        display: false,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                }
            }
        };

        var ctx = document.getElementById('line_chart').getContext('2d');
        new Chart(ctx, config);
    });
</script>

