<div class="row">

    <div class="x_title">
        <h2>{{ trans('sewer.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
            @permission('create.sewer.inventory_roads')
            <div class="col-md-12">
                <a href="{{ route('create.sewer.inventory_roads', ['code' => $code]) }}"
                   class="btn btn-success ajaxify pull-right">
                    <i class="fa fa-plus"></i> {{ trans('sewer.labels.create') }}
                </a>
            </div>
            @endpermission
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="sewer_tb">
        <thead>
        <tr>
            <th>{{ trans('sewer.labels.tipo') }}</th>
            <th>{{ trans('sewer.labels.longitud') }}</th>
            <th>{{ trans('sewer.labels.material') }}</th>
            <th>{{ trans('app.labels.actions') }}</th>
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
                {data: 'tipo', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'longitud', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'material', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>