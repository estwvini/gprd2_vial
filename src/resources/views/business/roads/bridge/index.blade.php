<div class="row">

    <div class="x_title">
        <h2>{{ trans('bridge.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
            @permission('create.bridge.inventory_roads')
            <div class="col-md-12">
                <a href="{{ route('create.bridge.inventory_roads', ['code' => $code]) }}"
                   class="btn btn-success ajaxify pull-right">
                    <i class="fa fa-plus"></i> {{ trans('bridge.labels.create') }}
                </a>
            </div>
            @endpermission
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="bridge_tb">
        <thead>
        <tr>
            <th>{{ trans('bridge.labels.codp') }}</th>
            <th>{{ trans('bridge.labels.nombre') }}</th>
            <th>{{ trans('bridge.labels.rioqueb') }}</th>
            <th>{{ trans('app.labels.actions') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#bridge_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.bridge.inventory_roads', ['code' => $code]) !!}',
            columns: [
                {data: 'codp', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'nombre', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'rioqueb', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>