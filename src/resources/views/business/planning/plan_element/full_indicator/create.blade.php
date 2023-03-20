@extends('business.planning.indicators.create')

@push('url')
    {{route('store.create.full.indicator.plan_elements.plans.plans_management', ['planElementId' => $planElementId])}}
@endpush

@push('route')
    <div class="pb-4">{!! $route !!}</div>
@endpush

@push('postAction')
    $('#load-area').empty();
    $('#load-tree').empty();

    const url = '{!! route('loadstructure.edit.plans.plans_management', ['id' => $planId]) !!}'
    pushRequest(url, '#load-tree', () => {

    }, 'GET', {'_token': '{!! csrf_token() !!}'}, false);
@endpush