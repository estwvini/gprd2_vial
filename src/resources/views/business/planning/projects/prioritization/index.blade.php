@permission('index.prioritization.plans_management')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('prioritization.title') }}
                <small>{{ trans('app.labels.planning') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-folder-open"></i> {{ trans('prioritization.title') . ' - ' . trans('prioritization.labels.fiscal_year', ['fiscalYear' => $fiscalYear]) }}
                    </h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped" id="departments_tb">
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
                            <th>{{ trans('projects.labels.month_duration') }}</th>
                            <th>{{ trans('prioritization.labels.priority') }}</th>
                            <th>{{ trans('prioritization.labels.project_phase') }}</th>
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
        let $table = $('#departments_tb');
        build_datatable($table, {
            ajax: '{!! route('data.index.prioritization.plans_management') !!}',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'full_cup', name: 'project.full_cup', width: '10%', searchable: true},
                {data: 'name', name: 'project.name', width: '15%', sortable: true, searchable: true},
                {data: 'responsibleUnit', name: 'project.responsibleUnit.name', width: '15%', sortable: true, searchable: true},
                {data: 'date_init', width: '8%', sortable: false, searchable: false},
                {data: 'date_end', width: '8%', sortable: false, searchable: false},
                {data: 'referential_budget', width: '8%', sortable: false, searchable: false},
                {data: 'month_duration', width: '8%', sortable: false, searchable: false},
                {data: 'priority', name: 'prioritization.value', width: '8%', sortable: true, searchable: false},
                {data: 'phase', width: '8%', sortable: true, searchable: false},
                {data: 'actions', width: '12%', sortable: false, searchable: false, class: 'text-center'}
            ],
            aaSorting: [[8, 'desc']]
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
