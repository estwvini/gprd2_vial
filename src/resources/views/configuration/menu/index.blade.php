@role('developer')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('configuration.menu.title') }}
                <small>{{ trans('configuration.title') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">
                <li class="active"> {{ trans('configuration.menu.title') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-bars"></i> {{ trans('configuration.menu.title') }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.menus.configuration') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('configuration.menu.labels.create') }}
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row" id="bulk-actions" style="display: none;">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <a id="config_menus_delete_btn" class="btn btn-danger" data-toggle="tooltip" data-placement="right" data-original-title="">
                                <i class="fa fa-trash"></i>
                            </a>

                            <a id="config_menus_enabled_btn" class="btn btn-success" data-toggle="tooltip" data-placement="right" data-original-title="">
                                <i class="fa fa-check-square-o"></i>
                            </a>
                        </div>
                    </div>

                    <table class="table table-striped" id="config_menus_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th><input type="checkbox" class="bulk check-all"/></th>
                            <th>{{ trans('configuration.menu.headers.label') }}</th>
                            <th>{{ trans('configuration.menu.headers.slug') }}</th>
                            <th>{{ trans('configuration.menu.headers.icon') }}</th>
                            <th>{{ trans('configuration.menu.headers.weight') }}</th>
                            <th>{{ trans('app.headers.updated_at') }}</th>
                            <th>{{ trans('app.headers.enabled') }}</th>
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
        var $table = $('#config_menus_tb');

        var datatable = build_datatable($table, {
            ajax: '{!! route('data.index.menus.configuration') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'bulk_action', sortable: false, searchable: false, width: '5%', class: 'text-center'},
                {data: 'label', width: '15%'},
                {data: 'slug', width: '15%'},
                {data: 'icon', width: '10%', class: 'text-center'},
                {data: 'weight', width: '5%', class: 'text-center'},
                {data: 'updated_at', width: '15%', class: 'text-center', sortable: false} ,
                {data: 'enabled', width: '10%', class: 'text-center'},
                {data: 'actions', sortable: false, searchable: false, width: '10%', class: 'text-center'}
            ]
        }, function () { // on enabled switch change
            var id = $(this).closest('tr').attr('id');
            var url = "{!! route('status.menus.configuration', ['id' => '__ID__']) !!}";
            url = url.replace('__ID__', id);
            pushRequest(url, null, null, 'put', {
                _token: '{{ csrf_token() }}'
            });
        });

        init_tooltip();

        $('#config_menus_delete_btn').on('click', function (e) {
            e.preventDefault();

            if (confirm('{{ html_entity_decode(trans('configuration.menu.messages.confirm.delete_bulk')) }}')) {
                var checked = $("input[name='table_records']:checked", $table);
                var ids = [];

                checked.each(function () {
                    var id = $(this).closest('tr').attr('id');
                    ids.push(id);
                });

                pushRequest('{!! route('bulk.destroy.menus.configuration') !!}', null, function () {
                    datatable.draw();
                }, 'delete', {
                    _token: '{{ csrf_token() }}',
                    ids: ids
                });
            }
        });

        $('#config_menus_enabled_btn').on('click', function (e) {
            e.preventDefault();

            if (confirm('{{ html_entity_decode(trans('configuration.role.messages.confirm.status_bulk')) }}')) {
                var checked = $("input[name='table_records']:checked", $table);
                var ids = [];

                checked.each(function () {
                    var id = $(this).closest('tr').attr('id');
                    ids.push(id);
                });

                pushRequest('{!! route('bulk.status.menus.configuration') !!}', null, function () {
                    datatable.draw();
                }, 'put', {
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