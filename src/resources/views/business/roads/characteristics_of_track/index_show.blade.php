<div class="row">

    <div class="x_title">
        <h2>{{ trans('characteristics_of_track.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="characteristics_of_track_tb">
        <thead>
        <tr>
            <th>{{ trans('characteristics_of_track.labels.origen') }}</th>
            <th>{{ trans('characteristics_of_track.labels.destino') }}</th>
            <th>{{ trans('characteristics_of_track.labels.tipoterreno') }}</th>
        </tr>
        </thead>
    </table>

</div>

<script>
    $(() => {

        let $table = $('#characteristics_of_track_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.characteristics_of_track.inventory_roads', ['codigo' => $entity->codigo]) !!}',
            columns: [
                {data: 'origen', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'destino', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'tipoterreno', width: '30%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>