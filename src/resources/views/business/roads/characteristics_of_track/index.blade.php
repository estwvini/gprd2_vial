<div class="row">

    <div class="x_title">
        <h2>{{ trans('characteristics_of_track.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
            @permission('create.characteristics_of_track.inventory_roads')
            <div class="col-md-12">
                <a href="{{ route('create.characteristics_of_track.inventory_roads', ['code' => $entity->codigo]) }}"
                   class="btn btn-success ajaxify pull-right">
                    <i class="fa fa-plus"></i> {{ trans('characteristics_of_track.labels.create') }}
                </a>
            </div>
            @endpermission
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="characteristics_of_track_tb">
        <thead>
        <tr>
            <th>{{ trans('characteristics_of_track.labels.origen') }}</th>
            <th>{{ trans('characteristics_of_track.labels.destino') }}</th>
            <th>{{ trans('characteristics_of_track.labels.tipoterreno') }}</th>
            <th>{{ trans('characteristics_of_track.labels.Numerocamino') }}</th>
            <th>{{ trans('characteristics_of_track.labels.esuperf') }}</th>
            <th>{{ trans('app.labels.actions') }}</th>
        </tr>
        </thead>
    </table>

</div>

<script>
    $(() => {

        let $table_characteristics_of_track = $('#characteristics_of_track_tb');
        build_datatable($table_characteristics_of_track, {
            ajax: '{!! route('data.index.characteristics_of_track.inventory_roads', ['code' => $entity->codigo]) !!}',
            columns: [
                {data: 'origen', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'destino', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'tipoterreno', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'Numerocamino', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'esuperf', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>