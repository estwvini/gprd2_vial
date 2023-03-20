@permission('index.project_admin_activities.reports')

<div>
    <div class="page-title">
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h3> {{ trans('reports.title') }}</h3>
            <h2>
                <i class="fa fa-users"></i> {{ trans('reports.project_admin_activities.title') }}
            </h2>
        </div>
        @permission('export.index.project_admin_activities.reports')
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a class="btn pdf-export-button mt-4 pull-right" id="export_excel">
                <i class="fa fa-file-excel-o"></i>
                {{ trans('reports.export.excel') }}
            </a>
        </div>
        @endpermission
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="form-group col-md-2 col-xs-12">
                            <label class="control-label" for="responsible_unit_id">
                                {{ trans('admin_activities.labels.responsible_unit') }}
                            </label>
                            <select class="form-control select2" id="responsible_unit_id">
                                <option value="">{{ trans('app.labels.all') }}</option>
                                @foreach($responsibleUnits as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2 col-xs-12">
                            <label class="control-label" for="project_fiscal_year_id">
                                {{ trans('reports.project_admin_activities.projects') }}
                            </label>
                            <select class="form-control select2" id="project_fiscal_year_id">
                                <option value="">{{ trans('app.labels.all') }}</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->project->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2 col-xs-12">
                            <label class="control-label" for="assigned_user_id">
                                {{ trans('admin_activities.labels.assigned') }}
                            </label>
                            <select class="form-control select2" id="assigned_user_id">
                                <option value="">{{ trans('app.labels.all') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fullName() }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group has-feedback col-md-2 col-xs-12">
                            <label class="control-label" for="date_init">
                                {{ trans('admin_activities.labels.date_init') }}
                            </label>
                            <input name="date_init" id="date_init"
                                   class="form-control has-feedback-left readonly-white"
                                   placeholder=" DD-MM-YYYY" autocomplete="off" readonly/>
                            <span class="fa fa-calendar form-control-feedback left mt-2 color-blue" aria-hidden="true"></span>
                        </div>
                        <div class="form-group has-feedback col-md-2 col-xs-12">
                            <label class="control-label" for="date_end">
                                {{ trans('admin_activities.labels.date_end') }}
                            </label>
                            <input name="date_init" id="date_end"
                                   class="form-control has-feedback-left readonly-white"
                                   placeholder=" DD-MM-YYYY" autocomplete="off" readonly/>
                            <span class="fa fa-calendar form-control-feedback left mt-2 color-blue" aria-hidden="true"></span>
                        </div>
                    </div>

                    <!-- Nav tabs -->
                    <ul class="md nav nav-tabs" role="tablist" style="display: inline-block" id="my-tabs">
                        <li role="presentation" class="active">
                            <a href="#admin_activity_tb" aria-controls="table" role="tab"
                               data-toggle="tab">{{ trans('reports.project_admin_activities.admin.activity_table_title') }}</a>
                        </li>
                        <li role="presentation">
                            <a href="#project_activity_tb" aria-controls="calendar" role="tab" data-toggle="tab">
                                {{ trans('reports.project_admin_activities.project.activity_table_title') }}</a>
                        </li>
                    </ul>

                    <div class="x_content">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="admin_activity_tb">
                                @include('business.reports.tracking.admin_activities_and_projects.admin_activity_table')
                            </div>
                            <div role="tabpanel" class="tab-pane" id="project_activity_tb">
                                @include('business.reports.tracking.admin_activities_and_projects.project_activity_table')
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

        let $adminActivityTable = $('#admin_activities_tb').DataTable();
        let $projectActivityTable = $('#project_activities_tb').DataTable();

        $('.select2').select2({}).on('change', () => {
            $adminActivityTable.draw();
            $projectActivityTable.draw();
        });

        $('#export_excel').on('click', (e) => {
            e.preventDefault();
            $.ajax({
                url: '{{ route('export.index.project_admin_activities.reports') }}',
                method: 'GET',
                data: {
                    responsible_unit_id: $('#responsible_unit_id').val(),
                    assigned_user_id: $('#assigned_user_id').val(),
                    fiscal_year_id: '{{ $currentYearId }}',
                    project_fiscal_year_id: $('#project_fiscal_year_id').val(),
                    date_init: $('#date_init').val(),
                    date_end: $('#date_end').val()
                },
                xhrFields: {
                    responseType: 'blob'
                },
                beforeSend: () => {
                    showLoading();
                },
                success: (response) => {
                    let a = document.createElement('a');
                    let url = window.URL.createObjectURL(response);
                    a.href = url;
                    a.download = '{{ trans('reports.project_admin_activities.title') }}';
                    document.body.append(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                }
            }).always(() => {
                hideLoading();
            });
        });

        // Add datetimepicker
        $('#date_init, #date_end').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: 'es-es',
            useCurrent: false,
            ignoreReadonly: true
        });

        $('#date_init').on('dp.change', (e) => {
            $('#date_end').data('DateTimePicker').minDate(e.date)
            $adminActivityTable.draw();
            $projectActivityTable.draw();
        });

        $('#date_end').on('dp.change', (e) => {
            $('#date_init').data('DateTimePicker').maxDate(e.date)
            $adminActivityTable.draw();
            $projectActivityTable.draw();
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission