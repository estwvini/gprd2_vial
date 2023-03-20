@extends('business.planning.indicators.update')

@push('url')
    {{ route($url, ['indicatorId' => $indicatorId]) }}
@endpush

@push('route')
    <div class="pb-4">{!! $route !!}</div>
@endpush