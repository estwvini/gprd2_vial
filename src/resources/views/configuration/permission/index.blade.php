@role('developer')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('configuration.permission.title') }}
                <small>{{ trans('configuration.title') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                <li class="active"> {{ trans('configuration.permission.title') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-lock"></i> {{ trans('configuration.permission.title') }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.permissions.configuration') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('configuration.permission.labels.create') }}
                            </a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="row" id="bulk-actions" style="display: none;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="alert alert-warning alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <strong>{{ trans('app.labels.attention') }}</strong>
                                {{ trans('configuration.permission.messages.warning.delete') }}
                            </div>

                            <a id="config_permissions_delete_btn" class="btn btn-danger" data-toggle="tooltip" data-placement="right" data-original-title="">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                    </div>

                    <table class="table table-striped" id="config_permissions_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th><input type="checkbox" class="bulk check-all" /></th>
                            <th>{{ trans('app.headers.name') }}</th>
                            <th>{{ trans('configuration.permission.headers.label') }}</th>
                            <th>{{ trans('app.headers.description') }}</th>
                            <th>{{ trans('app.headers.updated_at') }}</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        var $table = $('#config_permissions_tb');

        var datatable = build_datatable($table, {
            ajax: '{!! route('data.index.permissions.configuration') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'bulk_action', sortable: false, searchable: false, width: '5%', class: 'text-center'},
                {data: 'name', width: '15%'},
                {data: 'label', width: '20%'},
                {data: 'description', width: '30%'},
                {data: 'updated_at', width: '15%', class: 'text-center', sortable: false,} ,
                {data: 'actions', sortable: false, searchable: false, width: '15%', class: 'text-center'}
            ]
        });

        init_tooltip();

        $('#config_permissions_delete_btn').on('click', function (e) {
            e.preventDefault();

            if (confirm('{{ html_entity_decode(trans('configuration.permission.messages.confirm.delete_bulk')) }}')) {
                var checked = $("input[name='table_records']:checked", $table);
                var ids = [];

                checked.each(function () {
                    var id = $(this).closest('tr').attr('id');
                    ids.push(id);
                });

                pushRequest('{!! route('bulk.destroy.permissions.configuration') !!}', null, function () {
                        datatable.draw();
                }, 'delete', {
                    _token: '{{ csrf_token() }}',
                    ids: ids
                });
            }
        });

    });
</script>

@else
    @include('errors.403')
@endrole