<div class="row">

    <div class="x_title">
        <h2>{{ trans('slope.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
            @permission('create.slope.inventory_roads')
            <div class="col-md-12">
                <a href="{{ route('create.slope.inventory_roads', ['code' => $code]) }}"
                   class="btn btn-success ajaxify pull-right">
                    <i class="fa fa-plus"></i> {{ trans('slope.labels.create') }}
                </a>
            </div>
            @endpermission
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="slope_tb">
        <thead>
        <tr>
            <th>{{ trans('slope.labels.tipo') }}</th>
            <th>{{ trans('slope.labels.estado') }}</th>
            <th>{{ trans('slope.labels.lat') }}</th>
            <th>{{ trans('app.labels.actions') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#slope_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.slope.inventory_roads', ['code' => $code]) !!}',
            columns: [
                {data: 'tipo', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'estado', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'lat', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>