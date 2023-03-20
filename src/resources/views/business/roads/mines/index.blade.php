<div class="row">

    <div class="x_title">
        <h2>{{ trans('mines.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
            @permission('create.mines.inventory_roads')
            <div class="col-md-12">
                <a href="{{ route('create.mines.inventory_roads', ['code' => $code]) }}"
                   class="btn btn-success ajaxify pull-right">
                    <i class="fa fa-plus"></i> {{ trans('mines.labels.create') }}
                </a>
            </div>
            @endpermission
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="mines_tb">
        <thead>
        <tr>
            <th>{{ trans('mines.labels.tipo') }}</th>
            <th>{{ trans('mines.labels.fuente') }}</th>
            <th>{{ trans('mines.labels.material') }}</th>
            <th>{{ trans('app.labels.actions') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#mines_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.mines.inventory_roads', ['code' => $code]) !!}',
            columns: [
                {data: 'tipo', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'fuente', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'material', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>