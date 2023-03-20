@permission('index.projects_review.plans_management')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('projects.title') }}
                <small>{{ trans('project_review.title') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-product-hunt"></i> {{ trans('projects.title') }}
                        <span>{{ $year }}</span>
                    </h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row" id="bulk-actions" style="display: none;">
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <button id="reverse_btn" class="btn btn-danger" data-confirm="true" data-toggle="tooltip" data-placement="top"
                                    data-title="{{ trans('project_review.labels.reverse') }}">
                                <i class="fa fa-times"></i> {{ trans('project_review.labels.reverse') }}
                            </button>
                            <script>
                                $(function () {
                                    $('#reverse_btn').on('click', (e) => {
                                        e.preventDefault();
                                        let $table = $('#projects_review_tb');
                                        let action = $(e.currentTarget);
                                        let confirm = action.attr('data-confirm');
                                        if (confirm) {
                                            let checked = $table.find("input[name='table_records']:checked");
                                            let ids = [];
                                            checked.each((index, element) => {
                                                var id = $(element).val();
                                                ids.push(id);
                                            });

                                            if (ids.length == 1) {
                                                $('#checkbox').prop("checked", false);

                                                pushRequest('{!! route('observations.reverse.projects_review.plans_management') !!}', null, null, 'get', {
                                                    info: '{{ trans('project_review.messages.confirm.reverse') }}',
                                                    route: '{!! route('bulk.reverse.projects_review.plans_management') !!}',
                                                    table_id: 'projects_review_tb',
                                                    id: ids[0]
                                                });
                                            } else {
                                                notify('{{ trans('project_review.messages.warning.only_one_rejected') }}', 'warning')
                                            }

                                        }
                                    });
                                });
                            </script>

                            <button id="approve_btn" class="btn btn-success" data-confirm="true" data-toggle="tooltip" data-placement="top"
                                    data-title="{{ trans('project_review.labels.approve') }}">
                                <i class="fa fa-check"></i> {{ trans('project_review.labels.approve') }}
                            </button>
                            <script>
                                $(() => {
                                    $('#approve_btn').on('click', (e) => {
                                        e.preventDefault();
                                        var $table = $('#projects_review_tb');
                                        let action = $(e.currentTarget);
                                        let confirm = action.attr('data-confirm');
                                        if (confirm) {
                                            confirmModal("{{ trans('project_review.messages.confirm.approve') }}", () => {
                                                pushRequest('{!! route('bulk.approve.projects_review.plans_management') !!}', null, function () {
                                                    $table.DataTable().draw();
                                                }, 'put', {
                                                    _token: '{{ csrf_token() }}',
                                                    ids: ids
                                                });
                                            });

                                            var checked = $table.find("input[name='table_records']:checked");
                                            var ids = [];
                                            checked.each(function () {
                                                var id = $(this).closest('tr').attr('id');
                                                ids.push(id);
                                            });
                                            $('#checkbox').prop("checked", false);
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    <table class="table table-striped" id="projects_review_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>
                                <i role="button" data-toggle="tooltip" data-placement="top"
                                   data-original-title="{{ trans('projects.labels.bulk_actions_tooltip') }}"
                                   class="fa fa-info-circle blue"></i>
                                <input type="checkbox" id="checkbox" class="bulk check-all"
                                       title="{{ trans('app.labels.select_all') }}"/>
                            </th>
                            <th>{{ trans('projects.labels.cup') }}
                                <i role="button" data-toggle="tooltip" data-placement="top"
                                   data-original-title="{{ trans('projects.labels.cup_tooltip') }}"
                                   class="fa fa-info-circle blue"></i>
                            </th>
                            <th>{{ trans('app.headers.name') }}</th>
                            <th>{{ trans('projects.labels.responsibleUnit') }}</th>
                            <th>{{ trans('app.headers.date_init') }}</th>
                            <th>{{ trans('app.headers.date_end') }}</th>
                            <th>{{ trans('projects.labels.annual_budget') }}</th>
                            <th>{{ trans('projects.labels.state') }}</th>
                            <th>{{ trans('projects.labels.actions') }}</th>
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

        var $table = $('#projects_review_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.projects_review.plans_management') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'bulk_action', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'full_cup', name: 'project.full_cup', width: '10%', searchable: true},
                {data: 'name', name: 'projects.name', width: '15%', searchable: true},
                {data: 'responsibleUnit', name: 'project.responsibleUnit.name', width: '15%', searchable: true},
                {data: 'date_init', name: 'projects.date_init', width: '10%', searchable: false},
                {data: 'date_end', name: 'projects.date_end', width: '10%', searchable: false},
                {data: 'referential_budget', name: 'project_fiscal_years.referential_budget', width: '10%', searchable: false},
                {data: 'status', width: '10%', searchable: false},
                {data: 'actions', width: '20%', sortable: false, searchable: false}
            ],
            fnRowCallback: (nRow, aData) => {
                $(nRow).find('input.bulk').on('ifChecked ifUnchecked', (e) => {
                    let count = $("input[name='table_records']:checked", $table).length
                    if (count == 1) {
                        $('#reverse_btn').show()
                    } else {
                        $('#reverse_btn').hide()
                    }
                })
            }
        });

    });
</script>

@else
    @include('errors.403')
    @endpermission
