<div class="row mt-3">
    @include('dashboard.planning.components.administrative.chart_1', ['url' => route('chart_1.administrative.dashboard.control_panel')])
    @include('dashboard.planning.components.administrative.chart_2', ['url' => route('chart_2.administrative.dashboard.control_panel')])
</div>

<div class="row mt-3">
    @include('dashboard.planning.components.administrative.chart_3')
</div>


