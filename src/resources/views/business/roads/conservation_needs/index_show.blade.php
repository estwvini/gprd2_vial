<div class="row">

    <div class="x_title">
        <h2>{{ trans('conservation_needs.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="conservation_needs_tb">
        <thead>
        <tr>
            <th>{{ trans('conservation_needs.labels.tipo') }}</th>
            <th>{{ trans('conservation_needs.labels.lat') }}</th>
            <th>{{ trans('conservation_needs.labels.longi') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#conservation_needs_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.conservation_needs.inventory_roads', ['code' => $code]) !!}',
            columns: [
                {data: 'tipo', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'lat', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'longi', width: '30%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>