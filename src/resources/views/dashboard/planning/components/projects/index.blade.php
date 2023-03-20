<div class="row mt-3">
    <div class="col-md-12 text-center" id="detailsProject">
        <div class="col-md-2 br-1">
            <h4>Asignado Inicial</h4>
            <span class="fs-m"><i class="fa fa-dollar text-success"></i> 0.00</span>
        </div>
        <div class="col-md-2 br-1">
            <h4>Reformas</h4>
            <span class="fs-m"><i class="fa fa-dollar text-success"></i> 0.00</span>
        </div>
        <div class="col-md-2 br-1">
            <h4>Codificado</h4>
            <span class="fs-m"><i class="fa fa-dollar text-success"></i> 0.00</span>
        </div>
    </div>
</div>

<div class="row mt-3">
    @include('dashboard.planning.components.projects.expenses.chart_3')
</div>

<div class="row mt-3">
    @include('dashboard.planning.components.projects.expenses.chart_4')
</div>

<script>

    $(() => {
        $.ajax({
            url: '{{ route('details.projects.dashboard.control_panel') }}',
            method: 'GET'
        }).done(function (response) {
            processResponse(response, "#detailsProject");
        })
    })
</script>