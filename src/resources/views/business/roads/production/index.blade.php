<div class="row">

    <div class="x_title">
        <h2>{{ trans('production.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
            @permission('create.production.inventory_roads')
            <div class="col-md-12">
                <a href="{{ route('create.production.inventory_roads', ['code' => $code]) }}"
                   class="btn btn-success ajaxify pull-right">
                    <i class="fa fa-plus"></i> {{ trans('production.labels.create') }}
                </a>
            </div>
            @endpermission
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="production_tb">
        <thead>
        <tr>
            <th>{{ trans('production.labels.sector') }}</th>
            <th>{{ trans('production.labels.prod1') }}</th>
            <th>{{ trans('production.labels.prod2') }}</th>
            <th>{{ trans('app.labels.actions') }}</th>
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
                {data: 'sector', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'prod1', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'prod2', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>