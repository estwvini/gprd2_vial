<div class="row">

    <div class="x_title">
        <h2>{{ trans('critical_point.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="critical_point_tb">
        <thead>
        <tr>
            <th>{{ trans('critical_point.labels.tipo') }}</th>
            <th>{{ trans('critical_point.labels.lat') }}</th>
            <th>{{ trans('critical_point.labels.longi') }}</th>
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
                {data: 'tipo', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'lat', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'longi', width: '30%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>