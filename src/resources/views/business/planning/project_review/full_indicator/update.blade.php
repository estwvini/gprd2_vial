@extends('business.planning.indicators.update')

@push('url')
    {{ route('update.edit.full_indicator.logic_frame.projects.plans_management', ['indicatorId' => $indicatorId]) }}
@endpush

@push('route')
    <div class="pb-4">{!! $route !!}</div>
@endpush
