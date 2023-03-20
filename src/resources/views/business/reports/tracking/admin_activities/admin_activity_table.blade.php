<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title>{{ trans('reports.admin_activities.title') }}</title>
    <link href="{{ mix('css/report_pdf.css') }}" rel="stylesheet"/>
</head>
<body>
<h3 class="align-center strong">{{ trans('reports.labels.report_of') . ' ' . trans('reports.admin_activities.title') }}</h3>
<div>
    <img src="{{ mix('images/logo_login.png') }}" alt="{{ trans('configuration.ui.labels.login_logo') }}" width="400px" style="float: right; margin-right: 10%">
    <p style="margin-bottom: -5px;"><b>{{ trans('reports.labels.gad') }}:</b> {{ $gad }}</p>
    <p style="margin-bottom: -5px;"><b>{{ trans('reports.labels.fiscal_year') }}:</b> {{ $year }}</p>
    <p style="margin-bottom: -5px;"><b>{{ trans('reports.labels.executing_unit') }}:</b> {{ $responsibleUnit }}</p>
    <p style="margin-bottom: -5px;"><b>{{ trans('admin_activities.labels.assigned') }}:</b> {{ $assigned }}</p>
    <p style="margin-bottom: -5px;"><b>{{ trans('admin_activities.labels.activity_type') }}:</b> {{ $activityType }} <b>{{ trans('admin_activities.labels.status') }}
            :</b> {{ $status }}
        <b>{{ trans('admin_activities.labels.priority') }}:</b> {{ $priority }}</p>
    <p><b>{{ trans('reports.labels.date') }}:</b> {{ $date }}</p>
</div>

<table class="table" style="width: 90%">
    <thead>
    <tr style="background-color: #1abb9c; color: #FFF; width: 95%">
        <th style="width: 15%"><b>{{ trans('admin_activities.labels.assigned') }}</b></th>
        <th style="width: 20%"><b>{{ trans('admin_activities.labels.activity') }}</b></th>
        <th style="width: 5%"><b>{{ trans('admin_activities.labels.status') }}</b></th>
        <th style="width: 10%"><b>{{ trans('admin_activities.labels.check_list') }}</b></th>
        <th style="width: 10%"><b>{{ trans('admin_activities.labels.percentage_checkList') }}</b></th>
        <th style="width: 10%"><b>{{ trans('admin_activities.labels.qualification') }}</b></th>
        <th style="width: 10%"><b>{{ trans('admin_activities.labels.comments') }}</b></th>
        <th style="width: 10%"><b>{{ trans('admin_activities.labels.date_init') }}</b></th>
        <th style="width: 10%"><b>{{ trans('admin_activities.labels.date_end') }}</b></th>
    </tr>
    </thead>
    <tbody>
    @if(isset($rows))
        @foreach($rows as $row)
            <tr style="width: 95%">
                <td style="width: 15%">{{ $row->assigned_user_id }}</td>
                <td style="width: 20%">{!! $row->name !!}</td>
                <td style="text-align: center;width: 5%">{!! $row->status !!}</td>
                <td style="text-align: center;width: 10%">{!! $row->getCheckList !!}</td>
                <td style="text-align: center;width: 10%">{!! $row->getPercentageCheckList !!}%</td>
                <td style="text-align: center;width: 10%">{!! $row->qualification !!}</td>
                <td style="text-align: center;width: 10%">{!! $row->comments !!}</td>
                <td style="text-align: center;width: 10%">{!! $row->date_init !!}</td>
                <td style="text-align: center;width: 10%">{!! $row->date_end !!}</td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
</body>
</html>
