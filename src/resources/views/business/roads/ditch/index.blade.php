<div class="row">

    <div class="x_title">
        <h2>{{ trans('ditch.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
            @permission('create.ditch.inventory_roads')
            <div class="col-md-12">
                <a href="{{ route('create.ditch.inventory_roads', ['code' => $code]) }}"
                   class="btn btn-success ajaxify pull-right">
                    <i class="fa fa-plus"></i> {{ trans('ditch.labels.create') }}
                </a>
            </div>
            @endpermission
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="ditch_tb">
        <thead>
        <tr>
            <th>{{ trans('ditch.labels.lado') }}</th>
            <th>{{ trans('ditch.labels.estado') }}</th>
            <th>{{ trans('ditch.labels.tipo') }}</th>
            <th>{{ trans('app.labels.actions') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#ditch_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.ditch.inventory_roads', ['code' => $code]) !!}',
            columns: [
                {data: 'lado', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'estado', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'tipo', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>