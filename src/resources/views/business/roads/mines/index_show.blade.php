<div class="row">

    <div class="x_title">
        <h2>{{ trans('mines.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="mines_tb">
        <thead>
        <tr>
            <th>{{ trans('mines.labels.tipo') }}</th>
            <th>{{ trans('mines.labels.fuente') }}</th>
            <th>{{ trans('mines.labels.material') }}</th>
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
                {data: 'tipo', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'fuente', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'material', width: '30%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>