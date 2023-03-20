@permission('index.planning')
Dashboard
@else
    @include('errors.403')
@endpermission