<div class="row">

    <div class="x_title">
        <h2>{{ trans('traffic.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
            @permission('create.traffic.inventory_roads')
            <div class="col-md-12">
                <a href="{{ route('create.traffic.inventory_roads', ['code' => $code]) }}"
                   class="btn btn-success ajaxify pull-right">
                    <i class="fa fa-plus"></i> {{ trans('traffic.labels.create') }}
                </a>
            </div>
            @endpermission
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="traffic_tb">
        <thead>
        <tr>
            <th>{{ trans('traffic.labels.numlivianos') }}</th>
            <th>{{ trans('traffic.labels.numbuses') }}</th>
            <th>{{ trans('traffic.labels.num2ejes') }}</th>
            <th>{{ trans('traffic.labels.num3ejes') }}</th>
            <th>{{ trans('traffic.labels.num4ejes') }}</th>
            <th>{{ trans('traffic.labels.num5ejes') }}</th>
            <th>{{ trans('traffic.labels.total tráfico') }}</th>
            <th>{{ trans('app.labels.actions') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#traffic_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.traffic.inventory_roads', ['code' => $code]) !!}',
            columns: [
                {data: 'Numlivianos', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'Numbuses', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'Num2ejes', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'Num3ejes', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'Num4ejes', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'Num4ejes', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'Total tráfico', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>