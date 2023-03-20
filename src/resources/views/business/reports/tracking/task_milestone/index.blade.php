@permission('index.task_milestone.reports')
@inject('Task', '\App\Models\Business\Task')
<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3> {{ trans('reports.title') }}</h3>
            <h2>
                <i class="fa fa-users"></i> {{ trans('reports.task_milestone.title') }}
            </h2>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">

                    @permission('export.index.task_milestone.reports')
                    <a class="btn pull-right pdf-export-button" id="export_excel">
                        <i class="fa fa-file-excel-o"></i>
                        {{ trans('reports.export.excel') }}
                    </a>
                    @endpermission
                    <div class="clearfix"></div>

                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="form-group col-md-2 col-xs-12">
                            <label class="control-label" for="status">
                                {{ trans('reports.task_milestone.status') }}
                            </label>
                            <select class="form-control select2" id="status">
                                <option value="{{ $Task::ALL }}">{{ trans('reports.task_milestone.all') }}</option>
                                @foreach($Task::STATUS as $status)
                                    <option value="{{ $status }}"> {{ trans('reports.task_milestone.' . strtolower($status)) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table class="table table-striped" id="users_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('reports.task_milestone.days') }}</th>
                            <th>{{ trans('reports.task_milestone.task') }}</th>
                            <th>{{ trans('reports.task_milestone.responsible') }}</th>
                            <th>{{ trans('reports.task_milestone.init_date') }}</th>
                            <th>{{ trans('reports.task_milestone.date_end') }}</th>
                            <th>{{ trans('reports.task_milestone.status') }}</th>
                            <th>{{ trans('reports.task_milestone.activity') }}</th>
                            <th>{{ trans('reports.task_milestone.project_name') }}</th>
                            <th>{{ trans('reports.task_milestone.responsibleUnit') }}</th>
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

        let $dataTable = build_datatable($('#users_tb'), {
            ajax: {
                url: '{!! route('data.index.task_milestone.reports') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        filter: {
                            status: $('#status').val()
                        }
                    });
                }
            },
            columns: [
                {data: 'id', visible: false, width: '0', sortable: false, searchable: false},
                {data: 'days_overdue', width: '5%', searchable: true, class: 'text-center'},
                {data: 'name', width: '15%', searchable: true},
                {data: 'responsible', width: '10%', searchable: true, sortable: false},
                {data: 'date_init', width: '10%', searchable: true, sortable: false, class: 'text-center'},
                {data: 'date_end', width: '10%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'status', width: '10%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'activity', width: '20%', sortable: false, searchable: true},
                {data: 'project_name', width: '15%', sortable: false, searchable: true},
                {data: 'responsibleUnit', width: '15%', sortable: false, searchable: true}
            ]
        });

        $('#status').on('change', () => {
            $dataTable.draw();
        });

        $('#export_excel').on('click', (e) => {
            e.preventDefault();

            $.ajax({
                url: '{{ route('export.index.task_milestone.reports') }}',
                method: 'GET',
                data: {
                    filter: {
                        status: $('#status').val()
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
                    a.download = '{{ trans('reports.task_milestone.file_name_excel_report') }}';
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