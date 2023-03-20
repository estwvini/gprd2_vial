@extends('business.planning.indicators.create')

@push('url')
    {{ route($url, ['projectId' => $projectId]) }}
@endpush

@push('route')
    <div class="pb-4">{!! $route !!}</div>
@endpush
