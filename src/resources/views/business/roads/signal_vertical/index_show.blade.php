<div class="row">

    <div class="x_title">
        <h2>{{ trans('signal_vertical.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="signal_vertical_tb">
        <thead>
        <tr>
            <th>{{ trans('signal_vertical.labels.tipo') }}</th>
            <th>{{ trans('signal_vertical.labels.estado') }}</th>
            <th>{{ trans('signal_vertical.labels.lado') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#signal_vertical_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.signal_vertical.inventory_roads', ['code' => $code]) !!}',
            columns: [
                {data: 'tipo', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'estado', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'lado', width: '30%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>