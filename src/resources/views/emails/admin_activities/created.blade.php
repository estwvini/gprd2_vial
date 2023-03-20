<style>
    .dl-horizontal {
        margin-top: 0;
        margin-bottom: 20px;
    }

    .dl-horizontal dt {
        float: left;
        overflow: hidden;
        clear: left;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-weight: 700;
    }

    .dl-horizontal dd {
        line-height: 1.42857143;
        margin-left: 180px;
    }
</style>
Estimado(a):<br>

Sr.Ing {{ $activity->assigned->fullName() }} <br>

<p>Se le asignó una actividad administrativa mediante el sistema GpRD, por favor revise su actividad ingresando a <strong>
        <a href="{{ route('index_modules.app') }}">{{ route('index_modules.app') }} </a></strong></p> <br>

Información del Documento:

<dl class="dl-horizontal">
    <dt>Fecha:</dt>
    <dd>{{ \Carbon\Carbon::parse($activity->created_at)->toDateTimeString() }}</dd>
    <dt>Nombre de la actividad:</dt>
    <dd>{{ $activity->name }}</dd>
    <dt>Asignado por:</dt>
    <dd>{{ $activity->author->fullName() }}</dd>
</dl>
Saludos cordiales,<br>
Soporte GpRD.
<p>Nota: Este mensaje fue enviado automáticamente por el sistema, por favor no lo responda.</p>
<p>Si tiene alguna inquietud respecto a este mensaje, comuníquese con "correo electrónico de GpRD"</p>