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

Director (a) {{ $director->fullNameWithLastNameFirst() }} <br>

<p>El funcionario {{ auth()->user()->fullNameWithLastNameFirst() }} marcó como completada una actividad administrativa mediante el sistema GpRD, por favor revise dicha actividad y
    proceda a calificar en el enlace
    <strong>
        <a href="{{ route('index_modules.app') }}">{{ route('index_modules.app') }} </a></strong></p> <br>

Información del Documento:

<dl class="dl-horizontal">
    <dt>Fecha:</dt>
    <dd>{{ \Carbon\Carbon::now() }}</dd>
    <dt>Nombre de la actividad:</dt>
    <dd>{{ $entity->name }}</dd>
    <dt>Creada por:</dt>
    <dd>{{ $createdBy }}</dd>
</dl>
Saludos cordiales,<br>
Soporte GpRD.
<p>Nota: Este mensaje fue enviado automáticamente por el sistema, por favor no lo responda.</p>
<p>Si tiene alguna inquietud respecto a este mensaje, comuníquese con "correo electrónico de GpRD"</p>