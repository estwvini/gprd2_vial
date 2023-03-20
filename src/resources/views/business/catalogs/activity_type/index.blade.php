@permission('index.activity_type.module_configuration_catalogs')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('activity_type.title') }}
                <small>{{ trans('app.labels.catalogs') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa fa-tasks"></i> {{ trans('activity_type.title') }}
                    </h2>

                    @permission('create.activity_type.module_configuration_catalogs')
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.activity_type.module_configuration_catalogs') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('activity_type.labels.create') }}
                            </a>
                        </li>
                    </ul>
                    @endpermission

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped" id="activity_type_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('activity_type.labels.name') }}</th>
                            <th>{{ trans('app.labels.actions') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        let $table = $('#activity_type_tb');
        let datatable = build_datatable($table, {
            ajax: '{!! route('data.index.activity_type.module_configuration_catalogs') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'name', width: '90%', sortable: true, searchable: true},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission