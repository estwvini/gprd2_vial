@permission('index.budget_classifiers.module_configuration_catalogs')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('budget_classifiers.title') }}
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
                        <i class="fa fa-inbox"></i> {{ trans('budget_classifiers.title') }}
                    </h2>

                    @permission('create.budget_classifiers.module_configuration_catalogs')
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.budget_classifiers.module_configuration_catalogs') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('budget_classifiers.labels.create', ['type' => trans('budget_classifiers.labels.level_1')]) }}
                            </a>
                        </li>
                    </ul>
                    @endpermission

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped" id="budget_classifiers_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('budget_classifiers.labels.code') }} <i role="button" data-toggle="tooltip" data-placement="top"
                                                                                 data-original-title="{{ trans('budget_classifiers.messages.info.codeInfo') }}"
                                                                                 class="fa fa-info-circle blue"></i>
                            </th>
                            <th>{{ trans('budget_classifiers.labels.title') }}</th>
                            <th>{{ trans('budget_classifiers.labels.level') }}</th>
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
        let $table = $('#budget_classifiers_tb');
        let datatable = build_datatable($table, {
            ajax: '{!! route('data.index.budget_classifiers.module_configuration_catalogs') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'full_code', width: '10%', sortable: true, searchable: true},
                {data: 'title', width: '35%', sortable: false, searchable: true},
                {data: 'level_description', width: '10%', sortable: false, searchable: true},
                {data: 'enabled', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '20%', sortable: false, searchable: false, class: 'text-center'}
            ]
        }, (e) => { // on enabled switch change

            e.preventDefault();

            let levelDescription = $(e.currentTarget).closest('tr').find('td:nth-child(7)').text();

            let statusOn = '{{ trans('budget_classifiers.messages.confirm.status_on') }}'.replace(':type', levelDescription);
            let statusOff = '{{ trans('budget_classifiers.messages.confirm.status_off') }}'.replace(':type', levelDescription);

            let confirmMessage = $(e.currentTarget).is(':checked') ? statusOn : statusOff;

            const id = $(e.currentTarget).closest('tr').attr('id');

            confirmModal(confirmMessage, () => {

                let url = "{!! route('status.budget_classifiers.module_configuration_catalogs', ['id' => '__ID__']) !!}";
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