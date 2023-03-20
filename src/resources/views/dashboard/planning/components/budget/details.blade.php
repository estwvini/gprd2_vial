<div class="col-md-2 br-1">
    <h4>Asignado Inicial</h4>
    <span class="fs-m"><i class="fa fa-dollar text-success"></i> {{ number_format($assigned, 2) }}</span>
</div>
<div class="col-md-2 br-1">
    <h4>Reformas</h4>
    <span class="fs-m"><i class="fa fa-dollar text-success"></i> {{ number_format($reform, 2) }}</span>
</div>
<div class="col-md-2 br-1">
    <h4>Codificado</h4>
    <span class="fs-m"><i class="fa fa-dollar text-success"></i> {{ number_format($encoded, 2) }}</span>
</div>
<div class="col-md-2 br-1">
    <h4>Por Comprometer</h4>
    <span class="fs-m"><i class="fa fa-dollar text-success"></i> {{ number_format($porComprometer, 2) }}</span><br>
</div>
<div class="col-md-2 br-1">
    <h4>Por Devengar</h4>
    <span class="fs-m"><i class="fa fa-dollar text-success"></i> {{ number_format($porDevengar, 2) }}</span><br>
</div>
<div class="col-md-2">
    <h4>Devengado</h4>
    <span class="fs-m"><i class="fa fa-dollar text-success"></i> {{ number_format($accrued, 2) }}</span><br>
    <span class="text-danger">{{ number_format($percent, 2) }}%</span>
</div>
