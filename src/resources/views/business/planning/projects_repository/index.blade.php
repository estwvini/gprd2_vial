@permission('index.projects_repository.plans_management')
<div class="page-title">
    <div class="col-md-11 col-sm-11 col-xs-11">
        <h3>{{ trans('projects_repository.title') }}
            <small>{{ trans('app.labels.planning') }}</small>
        </h3>
    </div>
</div>
<div class="clearfix"></div>

<div class="row mb-15">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>
                    <i class="fa fa-folder-open"></i> {{ trans('projects_repository.title') }}
                    <span>{{ $year }}</span>
                </h2>

                <div class="clearfix"></div>

                <div class="col-md-4 col-sm-4 col-xs-4 mt-5">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <h6>{{ trans('projects_repository.labels.select_phase') }}</h6>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        @if(count($phases))
                            <select class="form-control select2" id="phase_filter" name="phase_filter">
                                <option value="">{{ trans('app.labels.select') }}</option>
                                @foreach($phases as $key => $phase)
                                    <option value="{{ $key }}">{{ $phase }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>

                <div class="col-md-4 col-sm-4 col-xs-4 mt-5">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <h6>{{ trans('projects_repository.labels.select_status') }}</h6>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        @if(count($statuses))
                            <select class="form-control select2" id="status_filter" name="status_filter">
                                <option value="">{{ trans('app.labels.select') }}</option>
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}">{{ trans('projects.status.' . strtolower($status)) }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>
            </div>
            <div class="x_content">

                <table class="table table-striped" id="projects_repository_tb">
                    <thead>
                    <tr>
                        <th></th>
                        <th>{{ trans('projects.labels.code') }} <i role="button" data-toggle="tooltip" data-placement="top"
                                                                   data-original-title="{{ trans('projects.labels.cup_tooltip') }}"
                                                                   class="fa fa-info-circle blue"></i>
                        </th>
                        <th>{{ trans('app.headers.name') }}</th>
                        <th>{{ trans('projects.labels.executingUnit') }}</th>
                        <th>{{ trans('app.headers.date_init') }}</th>
                        <th>{{ trans('app.headers.date_end') }}</th>
                        <th>{{ trans('projects.labels.initial_budget') }}</th>
                        <th>{{ trans('projects.labels.month_duration') }}</th>
                        <th>{{ trans('prioritization.labels.project_phase') }}</th>
                        <th>{{ trans('projects.labels.general_status') }}</th>
                        <th>{{ trans('projects.labels.road_project') }}</th>
                        <th>{{ trans('projects.labels.ongoing_project') }}</th>
                        <th>{{ trans('app.labels.actions') }}</th>
                    </tr>
                    </thead>
                </table>

            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        $('#phase_filter, #status_filter').select2({
            minimumResultsForSearch: Infinity
        })

        let datatable = build_datatable($('#projects_repository_tb'), {
            ajax: {
                url: '{!! route('data.index.projects_repository.plans_management') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        "phase": $('#phase_filter').val(),
                        "status": $('#status_filter').val()
                    });
                }
            },
            responsive: false,
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'full_cup', name: 'projects.full_cup', width: '1%', sortable: false, searchable: true},
                {data: 'name', name: 'projects.name', width: '15%', sortable: true, searchable: true},
                {data: 'executing_unit', name: 'executingUnit.name', width: '10%', sortable: true, searchable: true},
                {data: 'date_init', width: '8%', sortable: false, searchable: false},
                {data: 'date_end', width: '8%', sortable: false, searchable: false},
                {data: 'referential_budget', width: '8%', sortable: false, searchable: false},
                {data: 'month_duration', width: '5%', sortable: false, searchable: false},
                {data: 'phase', width: '8%', sortable: false, searchable: true},
                {data: 'status', name: 'projects.status', width: '5%', sortable: false, searchable: false},
                {data: 'is_road', width: '1%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'ongoing_project', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '1%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

        $('#phase_filter, #status_filter').on('change', () => {
            datatable.draw()
        })
    });
</script>

@else
    @include('errors.403')
    @endpermission
