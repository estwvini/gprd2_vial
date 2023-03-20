<div class="x_panel tile  overflow_hidden">
    <div class="dashboard-title">
        <h3>{{ trans('plans.description.PDOT') }} ({{ trans('plans.labels.PDOT') }})</h3>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row top_tiles">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="x_content">
                        <h4>PDOT</h4>
                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            <canvas id="canvasDoughnut" height="140" width="140" style="width: 140px; height: 140px;"></canvas>
                        </div>

                        <div class="animated flipInY col-lg-7 col-md-6 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-check"></i></div>
                                <div class="count">24</div>
                                <h3>Proyectos</h3>
                                <p>Texto de Prueba</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="tile-stats">
                    <div class="x_content">
                        <h4>Plan Sectorial</h4>
                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">
                            <canvas id="line_chart2" height="140" width="140" style="width: 140px; height: 140px;"></canvas>
                        </div>

                        <div class="animated flipInY col-lg-7 col-md-6 col-sm-6 col-xs-12">
                            <div class="tile-stats">
                                <div class="icon"><i class="fa fa-check"></i></div>
                                <div class="count">47</div>
                                <h3>Proyectos</h3>
                                <p>Texto de Prueba</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        // doughnut chart
        let config = {
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

        let ctx = document.getElementById('canvasDoughnut').getContext('2d');
        new Chart(ctx, config);

        // bar chart
        let randomScalingFactor = () => {
            return Math.round(Math.random() * 100);
        };

        let MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        let config2 = {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [{
                    fill: true,
                    backgroundColor: 'rgb(83, 185, 154)',
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
                    display: true,
                    position: 'bottom',
                    text: 'Line Chart'
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

        let ctx2 = document.getElementById('line_chart2').getContext('2d');
        new Chart(ctx2, config2);
    });
</script>

