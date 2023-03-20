<div class="row">

    <div class="x_title">
        <h2>{{ trans('bridge.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="bridge_tb">
        <thead>
        <tr>
            <th>{{ trans('bridge.labels.codp') }}</th>
            <th>{{ trans('bridge.labels.nombre') }}</th>
            <th>{{ trans('bridge.labels.rioqueb') }}</th>
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
                {data: 'codp', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'nombre', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'rioqueb', width: '30%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>