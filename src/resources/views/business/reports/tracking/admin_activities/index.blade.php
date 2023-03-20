@permission('index.admin_activities.reports')
@inject('AdminActivity', 'App\Models\Business\AdminActivity' )
@inject('ActivityType', 'App\Models\Business\Catalogs\ActivityType' )

<div>
    <div class="page-title">
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h3> {{ trans('reports.title') }}</h3>
            <h2>
                <i class="fa fa-users"></i> {{ trans('reports.admin_activities.title') }}
            </h2>
        </div>
        @permission('export.index.admin_activities.reports')
        <div class="col-md-2 col-sm-2 col-xs-2">
            <a class="btn pdf-export-button mt-4 pull-right" id="export_pdf">
                <i class="fa fa-file-pdf-o"></i>
                {{ trans('reports.export.pdf') }}
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
                            <label class="control-label" for="fiscal_year_id">
                                {{ trans('reports.admin_activities.year') }}
                            </label>
                            <select class="form-control select2" id="fiscal_year_id">
                                @foreach($years as $year)
                                    <option value="{{ $year->id }}"
                                            @if($year->id == $currentYearId) selected @endif >{{ $year->year }}</option>
                                @endforeach
                            </select>
                        </div>
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

                        <div class="form-group col-md-2 col-xs-12">
                            <label class="control-label" for="activity_type_id">
                                {{ trans('admin_activities.labels.activity_type') }}
                            </label>
                            <select class="form-control select2" id="activity_type_id">
                                <option value="">{{ trans('app.labels.all') }}</option>
                                @foreach($ActivityType::all() as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2 col-xs-12">
                            <label class="control-label" for="status">
                                {{ trans('admin_activities.labels.status') }}
                            </label>
                            <select class="form-control select2" id="status">
                                <option value="">{{ trans('app.labels.all') }}</option>
                                @foreach($AdminActivity::STATUS as $status)
                                    <option value="{{ $status }}">{{ trans('admin_activities.labels.status_' . $status) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2 col-xs-12">
                            <label class="control-label" for="priority">
                                {{ trans('admin_activities.labels.priority') }}
                            </label>
                            <select class="form-control select2" id="priority">
                                <option value="">{{ trans('app.labels.all') }}</option>
                                @foreach($AdminActivity::PRIORITIES as $priority)
                                    <option value="{{ $priority }}">{{ trans('admin_activities.labels.priority_' . $priority) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <table class="table table-striped" id="activities_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('admin_activities.labels.responsibleUnit') }}</th>
                            <th>{{ trans('admin_activities.labels.assigned') }}</th>
                            <th>{{ trans('admin_activities.labels.activity') }}</th>
                            <th>{{ trans('admin_activities.labels.activity_type') }}</th>
                            <th>{{ trans('admin_activities.labels.status') }}</th>
                            <th>{{ trans('admin_activities.labels.priority') }}</th>
                            <th>{{ trans('admin_activities.labels.date_init') }}</th>
                            <th>{{ trans('admin_activities.labels.date_end') }}</th>
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

        let $table = build_datatable($('#activities_tb'), {
            dom: '<l<t>ipr>',
            lengthMenu: [50, 75, 100],
            ajax: {
                url: '{!! route('data.index.admin_activities.reports') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        "filters": {
                            fiscal_year_id: $('#fiscal_year_id').val(),
                            responsible_unit_id: $('#responsible_unit_id').val(),
                            assigned_user_id: $('#assigned_user_id').val(),
                            activity_type_id: $('#activity_type_id').val(),
                            status: $('#status').val(),
                            priority: $('#priority').val()
                        }
                    });
                }
            },
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'responsible_unit_id', width: '15%'},
                {data: 'assigned_user_id', width: '15%'},
                {data: 'name', width: '30%'},
                {data: 'activity_type_id', width: '20%'},
                {data: 'status', width: '10%'},
                {data: 'priority', width: '10%'},
                {data: 'date_init', width: '10%', class: 'text-center'},
                {data: 'date_end', width: '5%', class: 'text-center'}
            ]
        });

        $('.select2').select2({}).on('change', () => {
            $table.draw();
        });

        $('#export_pdf').on('click', (e) => {
            e.preventDefault();

            $.ajax({
                url: '{{ route('export.index.admin_activities.reports') }}',
                method: 'GET',
                data: {
                    filters: {
                        fiscal_year_id: $('#fiscal_year_id').val(),
                        responsible_unit_id: $('#responsible_unit_id').val(),
                        assigned_user_id: $('#assigned_user_id').val(),
                        activity_type_id: $('#activity_type_id').val(),
                        status: $('#status').val(),
                        priority: $('#priority').val()
                    }
                },
                beforeSend: () => {
                    showLoading();
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: (response) => {
                    let a = document.createElement('a');
                    let url = window.URL.createObjectURL(response);
                    a.href = url;
                    a.download = '{{ trans('reports.admin_activities.export') }}';
                    document.body.append(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                }
            }).always(() => {
                hideLoading();
            });
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission