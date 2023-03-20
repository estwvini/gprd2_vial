<div class="row">

    <div class="x_title">
        <h2>{{ trans('sewer.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="sewer_tb">
        <thead>
        <tr>
            <th>{{ trans('sewer.labels.tipo') }}</th>
            <th>{{ trans('sewer.labels.longitud') }}</th>
            <th>{{ trans('sewer.labels.material') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#sewer_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.sewer.inventory_roads', ['code' => $code]) !!}',
            columns: [
                {data: 'tipo', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'longitud', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'material', width: '30%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>