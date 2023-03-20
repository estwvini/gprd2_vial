@permission('index.audit.config_reports')

<div>
    <div class="page-title">
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h3> {{ trans('reports.config.audit.title') }}</h3>
        </div>
        @permission('export.index.audit.config_reports')
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
                <div class="x_title">
                    <h2>
                        <i class="fa fa-tasks"></i> {{ trans('reports.config.audit.activities') }}
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="form-group col-md-2 col-xs-12">
                            <label class="control-label" for="department_id">
                                {{ trans('reports.config.audit.department') }}
                            </label>
                            <select class="form-control select2" id="department_id">
                                <option value="">{{ trans('app.labels.all') }}</option>
                                @foreach($departments as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2 col-xs-12">
                            <label class="control-label" for="user_id">
                                {{ trans('reports.config.audit.user') }}
                            </label>
                            <select class="form-control select2" id="user_id">
                                <option value="">{{ trans('app.labels.all') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->fullName() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table class="table h30 table-striped" id="audits_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('reports.config.audit.date') }}</th>
                            <th>{{ trans('reports.config.audit.ip') }}</th>
                            <th>{{ trans('reports.config.audit.username') }}</th>
                            <th>{{ trans('reports.config.audit.full_name') }}</th>
                            <th>{{ trans('reports.config.audit.action') }}</th>
                            <th>{{ trans('reports.config.audit.table') }}</th>
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
    $(function () {

        let $table = build_datatable($('#audits_tb'), {
            ajax: {
                url: '{!! route('data.index.audit.config_reports') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        "filters": {
                            department_id: $('#department_id').val(),
                            user_id: $('#user_id').val(),
                        }
                    });
                }
            },
            columns: [
                {data: 'id', visible: false, width: '0', sortable: false, searchable: false},
                {data: 'created_at', width: '15%', searchable: true, class: 'text-center'},
                {data: 'ip_address', width: '5%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'username', width: '10%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'full_name', width: '20%', searchable: true, sortable: false},
                {data: 'event', width: '10%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'table', width: '15%', sortable: false, searchable: true},
                {data: 'actions', width: '5%', sortable: false, searchable: true}
            ]
        });

        $('.select2').select2({}).on('change', () => {
            $table.draw();
        });

        $('#export_pdf').on('click', (e) => {
            e.preventDefault();

            $.ajax({
                url: '{{ route('export.index.audit.config_reports') }}',
                method: 'GET',
                data: {
                    filters: {
                        department_id: $('#department_id').val(),
                        user_id: $('#user_id').val(),
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
                    a.download = '{{ trans('reports.config.audit.title') }}';
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