@permission('show.indicator_progress.execution')

@extends('business.planning.indicators.show', ['modal' => true])

@else
    @include('errors.403')
    @endpermission