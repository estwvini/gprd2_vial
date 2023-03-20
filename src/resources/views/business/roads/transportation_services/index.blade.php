<div class="row">

    <div class="x_title">
        <h2>{{ trans('transportation_services.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
            @permission('create.transportation_services.inventory_roads')
            <div class="col-md-12">
                <a href="{{ route('create.transportation_services.inventory_roads', ['code' => $code]) }}"
                   class="btn btn-success ajaxify pull-right">
                    <i class="fa fa-plus"></i> {{ trans('transportation_services.labels.create') }}
                </a>
            </div>
            @endpermission
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="transportation_services_tb">
        <thead>
        <tr>
            <th>{{ trans('transportation_services.labels.tipo') }}</th>
            <th>{{ trans('transportation_services.labels.lat') }}</th>
            <th>{{ trans('transportation_services.labels.longi') }}</th>
            <th>{{ trans('app.labels.actions') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#transportation_services_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.transportation_services.inventory_roads', ['code' => $code]) !!}',
            columns: [
                {data: 'tipo', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'lat', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'longi', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>