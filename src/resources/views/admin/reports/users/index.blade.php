@permission('index.users.config_reports')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3> {{ trans('reports.config.users.title') }}</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-users"></i> {{ trans('reports.config.users.user_list') }}
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped" id="users_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('reports.config.users.username') }}</th>
                            <th>{{ trans('reports.config.users.full_name') }}</th>
                            <th>{{ trans('reports.config.users.role') }}</th>
                            <th>{{ trans('reports.config.users.department_name') }}</th>
                            <th>{{ trans('reports.config.users.email') }}</th>
                            <th>{{ trans('reports.config.users.hiring_modality') }}</th>
                            <th>{{ trans('app.headers.enabled') }}</th>
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
            ajax: '{!! route('data.index.users.config_reports') !!}',
            columns: [
                {data: 'id', visible: false, width: '0', sortable: false, searchable: false},
                {data: 'username', width: '10%', searchable: true},
                {data: 'name_surname', width: '20%', searchable: true},
                {data: 'role', width: '10%', searchable: true, sortable: false},
                {data: 'department_name', width: '20%', sortable: false, searchable: true},
                {data: 'email', width: '10%', sortable: false, searchable: true},
                {data: 'hiringModality', width: '15%', sortable: false, searchable: true},
                {data: 'enabled', width: '5%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission