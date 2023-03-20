<div class="row">

    <div class="x_title">
        <h2>{{ trans('ditch.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="ditch_tb">
        <thead>
        <tr>
            <th>{{ trans('ditch.labels.lado') }}</th>
            <th>{{ trans('ditch.labels.estado') }}</th>
            <th>{{ trans('ditch.labels.tipo') }}</th>
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
                {data: 'lado', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'estado', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'tipo', width: '30%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>