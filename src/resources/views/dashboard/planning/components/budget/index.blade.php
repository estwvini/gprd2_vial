<div class="row mt-3">
    <div class="col-md-12 text-center" id="detailsBudget">
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
        <div class="col-md-2 br-1">
            <h4>Por Comprometer</h4>
            <span class="fs-m"><i class="fa fa-dollar text-success"></i> 0.00</span><br>
        </div>
        <div class="col-md-2 br-1">
            <h4>Por Devengar</h4>
            <span class="fs-m"><i class="fa fa-dollar text-success"></i> 0.00</span><br>
        </div>
        <div class="col-md-2">
            <h4>Devengado</h4>
            <span class="fs-m"><i class="fa fa-dollar text-success"></i> 0.00</span><br>
            <span class="text-danger">0.00%</span>
        </div>
    </div>
</div>

<div class="row mt-3">
    @include('dashboard.planning.components.budget.expenses.chart_3')
</div>

<div class="row mt-3">
    @include('dashboard.planning.components.budget.incomes.chart_1')
    @include('dashboard.planning.components.budget.incomes.chart_2')
</div>

<div class="row mt-3">
    @include('dashboard.planning.components.budget.expenses.chart_1')
    @include('dashboard.planning.components.budget.expenses.chart_2')
</div>

<div class="row mt-3">
    @include('dashboard.planning.components.budget.expenses.chart_4')
</div>

<script>

    $(() => {
        $.ajax({
            url: '{{ route('details.budget.dashboard.control_panel', ['type' => 1]) }}',
            method: 'GET'
        }).done(function (response) {
            processResponse(response, "#detailsBudget");
        })
    })
</script>