@permission('index.project_tracking.execution')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('projects.title') }}
                <small>{{ trans('app.labels.tracking') }}</small>
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
                    </h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped" id="projects_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('projects.labels.code') }} <i role="button" data-toggle="tooltip" data-placement="top"
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
        let $table = $('#projects_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.project_tracking.execution') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'full_cup', name: 'projects.full_cup', class: 'text-center', width: '10%', searchable: true},
                {data: 'name', name: 'projects.name', width: '15%', searchable: true},
                {data: 'responsibleUnit', name: 'departments.name', width: '15%', class: 'text-center', searchable: true},
                {data: 'date_init', name: 'projects.date_init', width: '10%', class: 'text-center', searchable: true},
                {data: 'date_end', name: 'projects.date_end', width: '10%', class: 'text-center', searchable: true},
                {data: 'referential_budget', width: '10%', class: 'text-center', searchable: false},
                {data: 'status', width: '10%', class: 'text-center', searchable: false},
                {data: 'actions', width: '15%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
