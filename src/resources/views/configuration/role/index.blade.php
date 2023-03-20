@role('developer')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>
                {{ trans('configuration.role.title') }}
                <small>{{ trans('configuration.title') }}</small>
            </h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-users"></i> {{ trans('configuration.role.title') }}</h2>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <table class="table table-striped" id="config_roles_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('app.headers.name') }}</th>
                            <th>{{ trans('configuration.role.headers.slug') }}</th>
                            <th>{{ trans('app.headers.description') }}</th>
                            <th>{{ trans('app.headers.updated_at') }}</th>
                            <th>{{ trans('configuration.role.headers.editable') }}</th>
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
        var $table = $('#config_roles_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.roles.configuration') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'name', width: '20%'},
                {data: 'slug', width: '20%'},
                {data: 'description', width: '25%'},
                {data: 'updated_at', width: '15%', class: 'text-center', sortable: false,} ,
                {data: 'editable', width: '10%', class: 'text-center'},
                {data: 'actions', sortable: false, searchable: false, width: '10%', class: 'text-center'}
            ]
        });

        // on editable switch change
        $table.on('change', '.js-switch-editable', function () {

            var id = $(this).closest('tr').attr('id');
            var url = "{!! route('editable.roles.configuration', ['id' => '__ID__']) !!}";
            url = url.replace('__ID__', id);
            pushRequest(url, null, null, 'put', {
                _token: '{{ csrf_token() }}'
            });
        });
    });
</script>

@else
    @include('errors.403')
@endrole