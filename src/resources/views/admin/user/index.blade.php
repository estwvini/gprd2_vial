@permission('index.users')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('users.user.title') }}
                <small>{{ trans('app.labels.administration') }}</small>
            </h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">

                    <ul class="nav navbar-right panel_toolbox">
                        @permission('create.users')
                        <li class="pull-right">
                            <a href="{{ route('create.users') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('users.user.labels.create') }}
                            </a>
                        </li>
                        @endpermission
                    </ul>

                    <div class="clearfix"></div>

                </div>

                <div class="x_content">

                    <table class="table table-striped" id="users_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('users.user.labels.username') }}</th>
                            <th>{{ trans('users.user.labels.last_name') }}</th>
                            <th>{{ trans('users.user.labels.first_name') }}</th>
                            <th>{{ trans('users.user.labels.role') }}</th>
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

        var $dataTable = build_datatable($('#users_tb'), {
            ajax: '{!! route('data.index.users') !!}',
            columns: [
                {data: 'id', visible: false, width: '0', sortable: false, searchable: false},
                {data: 'username', width: '20%', searchable: true},
                {data: 'last_name', width: '20%', searchable: true},
                {data: 'first_name', width: '20%', searchable: true},
                {data: 'role', width: '20%', searchable: true, sortable: false},
                {data: 'enabled', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        }, function (e) { // on enabled switch change

            e.preventDefault();

            var confirmMessage = $(this).is(':checked') ? '{{ trans('users.user.messages.confirm.status_on') }}' : '{{ trans('users.user.messages.confirm.status_off') }}';

            var element = $(this);

            confirmModal(confirmMessage, function () {

                var id = element.closest('tr').attr('id');

                var url = "{!! route('status.users', ['id' => '__ID__']) !!}";
                url = url.replace('__ID__', id);

                pushRequest(url, null, function () {

                    $dataTable.draw();
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
