<div class="row">

    <div class="x_title">
        <h2>{{ trans('production.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="production_tb">
        <thead>
        <tr>
            <th>{{ trans('production.labels.sector') }}</th>
            <th>{{ trans('production.labels.prod1') }}</th>
            <th>{{ trans('production.labels.prod2') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#production_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.production.inventory_roads', ['code' => $code]) !!}',
            columns: [
                {data: 'sector', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'prod1', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'prod2', width: '30%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>