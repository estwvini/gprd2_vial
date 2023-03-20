@permission('index.departments')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('departments.title') }}
                <small>{{ trans('app.labels.administration') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-sitemap"></i> {{ trans('departments.title') }}
                    </h2>

                    @permission('create.departments')
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.departments') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('departments.labels.create') }}
                            </a>
                        </li>
                    </ul>
                    @endpermission

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped" id="departments_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('app.headers.name') }}</th>
                            <th>{{ trans('departments.labels.parent_department') }}</th>
                            <th>{{ trans('departments.labels.manager') }}</th>
                            <th>{{ trans('app.headers.enabled') }}</th>
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
    $(function () {
        var $table = $('#departments_tb');
        var datatable = build_datatable($table, {
            ajax: '{!! route('data.index.departments') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'name', width: '20%'},
                {data: 'parent_id', width: '20%'},
                {data: 'manager_id', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'enabled', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '20%', sortable: false, searchable: false, class: 'text-center'}
            ]
        }, function (e) { // on enabled switch change

            e.preventDefault();

            var confirmMessage = $(this).is(':checked') ? '{{ trans('departments.messages.confirm.status_on') }}' : '{{ trans('departments.messages.confirm.status_off') }}';
            var element = $(this);

            confirmModal(confirmMessage, function () {

                var id = element.closest('tr').attr('id');

                var url = "{!! route('status.departments', ['id' => '__ID__']) !!}";
                url = url.replace('__ID__', id);

                pushRequest(url, null, function () {
                    datatable.draw();
                }, 'put', {
                    _token: '{{ csrf_token() }}'
                });
            });
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
