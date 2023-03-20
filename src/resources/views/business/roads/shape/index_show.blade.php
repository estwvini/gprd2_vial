<div class="row">

    <div class="x_title">
        <h2>{{ trans('shape.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="shape_tb">
        <thead>
        <tr>
            <th>{{ trans('shape.labels.shape') }}</th>
            <th>{{ trans('shape.labels.is_primary') }}</th>
        </tr>
        </thead>
    </table>

</div>

<script>
    $(() => {

        let $table = $('#shape_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.shape.inventory_roads', ['code' => $code, 'show' => 1]) !!}',
            columns: [
                {data: 'name', width: '80%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'is_primary', width: '20%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>