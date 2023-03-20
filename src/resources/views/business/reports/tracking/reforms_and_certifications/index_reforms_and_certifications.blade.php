@permission('index.execution_projects.reports')
<div>
    <div class="page-title">
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h3> {{ trans('reports.title') }}</h3>
            <h2>
                <i class="fa fa-product-hunt"></i> {{ trans('reports.reforms_and_certifications.title_index') }}
            </h2>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="form-group col-md-4 col-xs-12">
            <label class="control-label" for="responsible_unit_id">
                {{ trans('reports.reforms_and_certifications.projects') }}
            </label>
            <select class="form-control select2" id="projectId" name="projectId">
                @foreach($projects as $project)
                    <option value="{{ $project->id }}">{{ $project->project->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2 col-sm-12 col-xs-12 mt-5">
            <button class="btn btn-success mb-0" id="search">{{ trans('app.labels.search') }}</button>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12 mt-5">
            <div class="text-right">
                @permission('report.reforms_and_certifications.reports')
                <a class="btn pull-right pdf-export-button" id="export_excel" href="">
                    <i class="fa fa-file-excel-o"></i>
                    {{ trans('reports.reforms_and_certifications.Budget_planning_schedule') }}
                </a>
                @endpermission
            </div>
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12 mt-5">
            <div class="text-right pull-left">
                @permission('report2.reforms_and_certifications.reports')
                <a class="btn pull-right pdf-export-button" id="export_excel2" href="">
                    <i class="fa fa-file-excel-o"></i>
                    {{ trans('reports.reforms_and_certifications.schedule_of_activities') }}
                </a>
                @endpermission
            </div>
        </div>
    </div>
    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a id="tab_Budget_planning_schedule" role="tab" data-toggle="tab" href="#Budget_planning_schedule" aria-controls="Budget_planning_schedule">
                {{ trans('reports.reforms_and_certifications.Budget_planning_schedule') }}
            </a>
        </li>
        <li class="nav-item">
            <a id="tab_Schedule_of_activities" role="tab" data-toggle="tab" href="#Schedule_of_activities" aria-controls="Schedule_of_activities">
                {{ trans('reports.reforms_and_certifications.Schedule_of_activities') }}
            </a>
        </li>

    </ul>
    <div class="tab-content">
        <div class="x_content tab-pane active" role="tabpanel" id="Budget_planning_schedule">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                <i class="fa fa-tasks"></i> {{ trans('reports.reforms_and_certifications.Budget_planning_schedule') }}
                            </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_content">
                                            <div class="row">
                                                <table class="table report-table" id="certifications_card">
                                                    <thead>
                                                    <tr>
                                                        <th colspan="8"
                                                            style="background-color: #FFFFFF; font-weight: bold; font-size: 18px; height: 30px; color: #ffffff">
                                                        </th>
                                                        <th colspan="13"
                                                            style="background-color: #1abb9c; font-weight: bold; font-size: 18px; height: 30px; color: #ffffff; text-align: center;">
                                                            {{ trans('reports.reforms_and_certifications.Budget_planning_schedule') }}
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                        <th>{{ trans('reports.reforms_and_certifications.name_project') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.description_of_the_beneficiaries') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.code_and_name_of_the_place_where_the_activity_takes_place') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.project_components') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.activities') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.budget_item') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.description_of_the_budget_line') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.total_amount') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.January') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.February') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.March') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.April') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.May') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.June') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.July') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.August') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.September') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.October') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.November') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.December') }}</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="x_content tab-pane" role="tabpanel" id="Schedule_of_activities">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                <i class="fa fa-tasks"></i>{{ trans('reports.reforms_and_certifications.Schedule_of_activities') }}
                            </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_content">
                                            <div class="row">
                                                <table class="table report-table" id="certifications_card2">
                                                    <thead>
                                                    <tr>
                                                        <th colspan="3"
                                                            style="background-color: #FFFFFF; font-weight: bold; font-size: 18px; height: 30px; color: #ffffff">
                                                        </th>
                                                        <th colspan="8"
                                                            style="background-color: #1abb9c; font-weight: bold; font-size: 18px; height: 30px; color: #ffffff; text-align: center;">
                                                            {{ trans('reports.reforms_and_certifications.Schedule_of_activities') }}
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th></th>
                                                        <th>{{ trans('reports.reforms_and_certifications.name_project') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.description_of_the_beneficiaries') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.activities')}}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.task') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.milestones') }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.start_date')  }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.end_date')  }}</th>
                                                        <th>{{trans('reports.reforms_and_certifications.duration_days')  }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.importance')  }}</th>
                                                        <th>{{ trans('reports.reforms_and_certifications.Weighing') }}</th>
                                                    </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {

        let datatable = build_datatable($('#certifications_card'), {
            dom: '<t>ir',
            ajax: {
                url: '{!! route('data.index.reforms_and_certifications.reports') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        projectId: $('#projectId').val(),
                    });
                },
                "dataSrc": function (response) {
                    if (response.exception !== '') {
                        notify(response.exception, 'warning')
                    }
                    return response.data;
                }
            },
            paging: false,
            responsive: false,
            scrollX: true,
            scrollY: '400px',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false},
                {data: 'name_project', width: '15%', sortable: false},
                {data: 'description_of_the_beneficiaries', width: '30%', sortable: false},
                {data: 'code_and_name_of_the_place_where_the_activity_takes_place', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'project_components', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'activities', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'budget_item', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'description_of_the_budget_line', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'total_amount', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'January', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'February', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'March', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'April', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'May', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'June', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'July', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'August', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'September', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'October', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'November', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'December', width: '5%', sortable: false, searchable: false, class: "text-center"},
            ],
            initComplete: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            drawCallback: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
        });


        let datatable2 = build_datatable($('#certifications_card2'), {
            dom: '<t>ir',
            ajax: {
                url: '{!! route('data2.index.reforms_and_certifications.reports') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        projectId: $('#projectId').val(),
                    });
                },
                "dataSrc": function (response) {
                    if (response.exception !== '') {
                        notify(response.exception, 'warning')
                    }
                    return response.data;
                }
            },
            paging: false,
            scrollY: '400px',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false},
                {data: 'name_project', width: '15%', sortable: false, searchable: false, class: "text-center"},
                {data: 'description_of_the_beneficiaries', width: '30%', sortable: false, searchable: false, class: "text-center"},
                {data: 'activities', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'task', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'milestones', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'start_date', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'end_date', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'duration_days', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'importance', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'Weighing', width: '5%', sortable: false, searchable: false, class: "text-center"},
            ],
            initComplete: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            drawCallback: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
        });

        $('#tab_Schedule_of_activities').on('click', () => {
            if (!$('#Schedule_of_activities').hasClass('active')) {
                datatable2.draw();
            }
        });

        $('#tab_Budget_planning_schedule').on('click', () => {
            if (!$('#Budget_planning_schedule').hasClass('active')) {
                datatable.draw();
            }
        });
        $('.select2').select2({});
        let idSelected = $("#projectId").val();
        let export_url = '{{ route('report.reforms_and_certifications.reports', ['projectId' => '__PROJECT_ID__']) }}';
        export_url = export_url.replace('__PROJECT_ID__', idSelected);
        $('#export_excel').attr('href', export_url);

        $("#projectId").on('change', () => {
            idSelected = parseInt($("#projectId").val());
            let export_url = '{{ route('report.reforms_and_certifications.reports', ['projectId' => '__PROJECT_ID__']) }}';
            export_url = export_url.replace('__PROJECT_ID__', idSelected);
            $('#export_excel').attr('href', export_url);
        });

        $('#search').on('click', () => {
            datatable.draw();
            datatable2.draw();
        });

        let export_url2 = '{{ route('report2.reforms_and_certifications.reports', ['projectId' => '__PROJECT_ID__']) }}';
        export_url2 = export_url2.replace('__PROJECT_ID__', idSelected);
        $('#export_excel2').attr('href', export_url2);

        $("#projectId").on('change', () => {
            idSelected = parseInt($("#projectId").val());
            let export_url2 = '{{ route('report2.reforms_and_certifications.reports', ['projectId' => '__PROJECT_ID__']) }}';
            export_url2 = export_url2.replace('__PROJECT_ID__', idSelected);
            $('#export_excel2').attr('href', export_url2);
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission