<div class="row">

    <div class="x_title">
        <h2>{{ trans('intersection.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
            @permission('create.intersection.inventory_roads')
            <div class="col-md-12">
                <a href="{{ route('create.intersection.inventory_roads', ['code' => $code]) }}"
                   class="btn btn-success ajaxify pull-right">
                    <i class="fa fa-plus"></i> {{ trans('intersection.labels.create') }}
                </a>
            </div>
            @endpermission
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="intersection_tb">
        <thead>
        <tr>
            <th>{{ trans('intersection.labels.lat') }}</th>
            <th>{{ trans('intersection.labels.longi') }}</th>
            <th>{{ trans('intersection.labels.descrip') }}</th>
            <th>{{ trans('app.labels.actions') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#intersection_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.intersection.inventory_roads', ['code' => $code]) !!}',
            columns: [
                {data: 'lat', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'longi', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'descrip', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>