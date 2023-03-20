@permission('index.measure_units.module_configuration_catalogs')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('measure_units.title') }}
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
                        <i class="fa fa-balance-scale"></i> {{ trans('measure_units.title') }}
                    </h2>

                    @permission('create.measure_units.module_configuration_catalogs')
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.measure_units.module_configuration_catalogs') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('measure_units.labels.create') }}
                            </a>
                        </li>
                    </ul>
                    @endpermission

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped" id="measure_units_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('measure_units.labels.name') }}</th>
                            <th>{{ trans('measure_units.labels.abbreviation') }}</th>
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
        let $table = $('#measure_units_tb');
        let datatable = build_datatable($table, {
            ajax: '{!! route('data.index.measure_units.module_configuration_catalogs') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'name', width: '30%', sortable: true, searchable: true},
                {data: 'abbreviation', width: '30%', sortable: true, searchable: true},
                {data: 'enabled', width: '20%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '20%', sortable: false, searchable: false, class: 'text-center'}
            ]
        }, (e) => { // on enabled switch change

            e.preventDefault();

            let confirmMessage = $(e.currentTarget).is(':checked') ? '{{ trans('measure_units.messages.confirm.status_on') }}' : '{{ trans('measure_units.messages.confirm.status_off') }}';
            const id = $(e.currentTarget).closest('tr').attr('id');

            confirmModal(confirmMessage, () => {

                let url = "{!! route('status.index.measure_units.module_configuration_catalogs', ['id' => '__ID__']) !!}";
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