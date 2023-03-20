<div class="row">

    <div class="x_title">
        <h2>{{ trans('critical_point.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
            @permission('create.critical_point.inventory_roads')
            <div class="col-md-12">
                <a href="{{ route('create.critical_point.inventory_roads', ['code' => $code]) }}"
                   class="btn btn-success ajaxify pull-right">
                    <i class="fa fa-plus"></i> {{ trans('critical_point.labels.create') }}
                </a>
            </div>
            @endpermission
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="critical_point_tb">
        <thead>
        <tr>
            <th>{{ trans('critical_point.labels.tipo') }}</th>
            <th>{{ trans('critical_point.labels.lat') }}</th>
            <th>{{ trans('critical_point.labels.critical_point_type') }}</th>
            <th>{{ trans('app.labels.actions') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#critical_point_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.critical_point.inventory_roads', ['code' => $code]) !!}',
            columns: [
                {data: 'tipo', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'lat', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'longi', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>