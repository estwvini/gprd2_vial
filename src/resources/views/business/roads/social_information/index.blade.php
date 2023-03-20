<div class="row">

    <div class="x_title">
        <h2>{{ trans('social_information.title') }}</h2>
        <ul class="nav navbar-right panel_toolbox">
            @permission('create.social_information.inventory_roads')
            <div class="col-md-12">
                <a href="{{ route('create.social_information.inventory_roads', ['code' => $code]) }}"
                   class="btn btn-success ajaxify pull-right">
                    <i class="fa fa-plus"></i> {{ trans('social_information.labels.create') }}
                </a>
            </div>
            @endpermission
        </ul>
        <div class="clearfix"></div>
    </div>

    <table class="table" id="social_information_tb">
        <thead>
        <tr>
            <th>{{ trans('social_information.labels.asent') }}</th>
            <th>{{ trans('social_information.labels.organ1') }}</th>
            <th>{{ trans('social_information.labels.organ2') }}</th>
            <th>{{ trans('app.labels.actions') }}</th>
        </tr>
        </thead>
    </table>
</div>

<script>
    $(() => {

        let $table = $('#social_information_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.social_information.inventory_roads', ['code' => $code]) !!}',
            columns: [
                {data: 'asent', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'organ1', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'organ2', width: '30%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

    });
</script>