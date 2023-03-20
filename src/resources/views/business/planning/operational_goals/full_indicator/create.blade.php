@extends('business.planning.indicators.create')

@push('url')
    {{ route('store.create.indicator.operational_goals.plans_management', ['operational_goal_id' => $operationalGoalId]) }}
@endpush

@push('route')
    <div class="pb-4">{!! $route !!}</div>
@endpush
