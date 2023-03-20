<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title>{{ trans('reports.agreement_for_results.title') }}</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet"/>
</head>
<body>
<div>
    <img src="{{ mix('images/logo_login.png') }}" alt="{{ trans('configuration.ui.labels.login_logo') }}"
         width="400px">
</div>
<h3 class="align-center strong">{{ trans('reports.labels.report_of') . ' ' . trans('reports.agreement_for_results.title') }}</h3>
<p><b>{{ trans('reports.labels.gad') }}:</b> {{ $gad }}</p>
<p><b>{{ trans('reports.labels.servant') }}:</b> {{ $servant->fullName() }}</p>
<p><b>{{ trans('reports.labels.executing_unit') }}:</b> {{ $executingUnit->name }}</p>
<p><b>{{ trans('reports.labels.fiscal_year') }}:</b> {{ $fiscalYear->year }}</p>
<p><b>{{ trans('reports.agreement_for_results.total_advance') }}:</b> {{ $totalAdvance }}</p>
<p><b>{{ trans('reports.labels.date') }}:</b> {{ $date }}</p>
<table class="report-table pdf-table">
    <thead>
    <tr>
        <th><b>{{ trans('reports.agreement_for_results.activity_task') }}</b></th>
        <th><b>{{ trans('reports.agreement_for_results.due_date') }}</b></th>
        <th><b>{{ trans('reports.agreement_for_results.advance_log_date') }}</b></th>
        <th><b>{{ trans('reports.agreement_for_results.completion') }}</b></th>
        <th><b>{{ trans('reports.agreement_for_results.status') }}</b></th>
        <th><b>{{ trans('reports.agreement_for_results.semaphore') }}</b></th>
    </tr>
    </thead>
    <tbody>
    @if(isset($rows))
        @foreach($rows as $row)
            <tr>
                <td>{{ $row->activity_task }}</td>
                <td>{{ $row->due_date }}</td>
                <td>{{ $row->advance_log_date }}</td>
                <td>{{ $row->completion }}</td>
                <td>{{ $row->status }}</td>
                <td>{!! $row->semaphore !!}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>

<div class="pdf-signature-field-50">
    <div class="pdf-signature-150"></div>
    <div align="center">{{ trans('reports.labels.servant') }}</div>
</div>

<div class="pdf-signature-field-50">
    <div class="pdf-signature-150"></div>
    <div align="center">{{ trans('reports.labels.departmental_director') }}</div>
</div>

</body>
</html>
