@permission('index.roles')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('roles.title') }}
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
                        <i class="fa fa-users"></i> {{ trans('roles.title') }}
                    </h2>

                    @permission('create.roles')
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.roles') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('roles.labels.create') }}
                            </a>
                        </li>
                    </ul>
                    @endpermission

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped" id="admin_roles_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('app.headers.name') }}</th>
                            <th>{{ trans('app.headers.description') }}</th>
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
    $(() => {
        let $table = $('#admin_roles_tb');
        let datatable = build_datatable($table, {
            ajax: '{!! route('data.index.roles') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'name', width: '35%'},
                {data: 'description', width: '35%'},
                {data: 'enabled', width: '15%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '15%', sortable: false, searchable: false, class: 'text-center'}
            ]
        }, (e) => { // on enabled switch change

            e.preventDefault();

            let confirmMessage = $(e.currentTarget).is(':checked') ? '{{ trans('roles.messages.confirm.status_on') }}' : '{{ trans('roles.messages.confirm.status_off') }}';
            let element = $(e.currentTarget);

            confirmModal(confirmMessage, () => {

                let id = element.closest('tr').attr('id');

                let url = "{!! route('status.roles', ['id' => '__ID__']) !!}";
                url = url.replace('__ID__', id);

                pushRequest(url, null, () => {
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
