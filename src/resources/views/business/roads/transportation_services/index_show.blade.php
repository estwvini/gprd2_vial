<div class="row">

    <div class="x_title">
        <h2>{{ trans('transportation_services.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="transportation_services_tb">
        <thead>
        <tr>
            <th>{{ trans('transportation_services.labels.tipo') }}</th>
            <th>{{ trans('transportation_services.labels.lat') }}</th>
            <th>{{ trans('transportation_services.labels.longi') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#transportation_services_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.transportation_services.inventory_roads', ['code' => $code]) !!}',
            columns: [
                {data: 'tipo', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'lat', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'longi', width: '30%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>