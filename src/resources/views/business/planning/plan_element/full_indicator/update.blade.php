@extends('business.planning.indicators.update')

@push('url')
    {{ route($url, ['id' => $entity->id]) }}
@endpush

@push('route')
    <div class="pb-4">{!! $route !!}</div>
@endpush

@push('postAction')
    $('#load-area').empty();
    $('#load-tree').empty();

    const url = '{!! route('loadstructure.edit.plans.plans_management', ['id' => $planId , 'url' => $url]) !!}'
    pushRequest(url, '#load-tree', () => {

    }, 'GET', {'_token': '{!! csrf_token() !!}'}, false);
@endpush