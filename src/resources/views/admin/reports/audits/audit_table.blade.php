<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title>{{ trans('reports.config.audit.title') }}</title>
    <link href="{{ mix('css/report_pdf.css') }}" rel="stylesheet"/>
</head>
<body>
<div>
    <img src="{{ mix('images/logo_login.png') }}" alt="{{ trans('configuration.ui.labels.login_logo') }}"
         width="400px">
</div>
<h3 class="align-center strong">{{ trans('reports.config.audit.title') }}</h3>
<p><b>{{ trans('reports.labels.gad') }}:</b> {{ $gad }}</p>
<p><b>{{ trans('reports.config.audit.department') }}:</b> {{ $department }}</p>
<p><b>{{ trans('reports.config.audit.user') }}:</b> {{ $user }}</p>
<p><b>{{ trans('reports.labels.date') }}:</b> {{ $date }}</p>

<table class="table">
    <thead>
    <tr style="background-color: #1abb9c; color: #FFF">
        <th style="width: 15%"><b>{{ trans('reports.config.audit.date') }}</b></th>
        <th style="width: 5%"><b>{{ trans('reports.config.audit.ip') }}</b></th>
        <th style="width: 10%"><b>{{ trans('reports.config.audit.username') }}</b></th>
        <th style="width: 20%"><b>{{ trans('reports.config.audit.full_name') }}</b></th>
        <th style="width: 10%"><b>{{ trans('reports.config.audit.action') }}</b></th>
        <th style="width: 15%"><b>{{ trans('reports.config.audit.table') }}</b></th>
    </tr>
    </thead>
    <tbody>
    @if(isset($rows))
        @foreach($rows as $row)
            <tr>
                <td style="text-align: center">{{ $row->created_at }}</td>
                <td style="text-align: center">{{ $row->ip_address }}</td>
                <td style="text-align: center">{{ $row->username }}</td>
                <td>{{ $row->full_name }}</td>
                <td style="text-align: center">{{ $row->event }}</td>
                <td>{{ $row->table }}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>


</body>
</html>
