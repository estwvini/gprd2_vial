<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <link href="{{ mix('css/report_pdf.css') }}" rel="stylesheet"/>
</head>
<body>
<div class="align-center">
    <img src="{{ mix('images/congope_1.png') }}" width="400px">
</div>
<h3 class="align-center strong">{{ trans('app.labels.congope') }}</h3>
<h5 class="align-center strong">{{ trans('user_tasks.labels.report') }}</h5>

<p><b>{{ trans('user_tasks.labels.department') }}:</b> {{ $departmentName }}</p>
<p><b>{{ trans('user_tasks.labels.full_name') }}:</b> {{ $name }}</p>
<p><b>{{ trans('user_tasks.labels.job') }}:</b></p>
<p><b>{{ trans('user_tasks.labels.director') }}:</b> {{ $director }}</p>
<p><b>{{ trans('user_tasks.labels.from') }}:</b> {{ $from }} <b>{{ trans('user_tasks.labels.to') }}:</b> {{ $to }}</p>

<table class="table" style="width: 100%">
    <thead>
    <tr style="background-color: #1abb9c; color: #FFF">
        <th style="width: 5%"><b>{{ trans('user_tasks.labels.number') }}</b></th>
        <th style="width: 40%"><b>{{ trans('user_tasks.labels.activities') }}</b></th>
        <th style="width: 60%"><b>{{ trans('user_tasks.labels.observations') }}</b></th>
    </tr>
    </thead>
    <tbody>
    @forelse($tasks as $task)
        <tr>
            <td style="text-align: center">{{ $loop->iteration }}</td>
            <td style="padding-left: 4px; padding-right: 4px">{{ $task->name }}</td>
            <td style="padding-left: 4px; padding-right: 4px; word-wrap: break-word; text-align: justify">{!! $task->description !!}</td>
        </tr>
    @empty
        <tr>
            <td colspan="3" style="text-align: center">{{ trans('user_tasks.messages.info.empty') }}</td>
        </tr>
    @endforelse
    </tbody>
</table>


</body>
</html>
