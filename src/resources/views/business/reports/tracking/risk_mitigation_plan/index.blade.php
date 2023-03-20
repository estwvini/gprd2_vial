@permission('index.risk_mitigation_plan.reports')
<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3> {{ trans('reports.title') }}</h3>
            <h2>
                <i class="fa fa-users"></i> {{ trans('reports.risk_mitigation_plan.title') }}
            </h2>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">

                    @permission('export.index.risk_mitigation_plan.reports')
                    <a class="btn pull-right pdf-export-button" id="export_excel">
                        <i class="fa fa-file-excel-o"></i>
                        {{ trans('reports.export.excel') }}
                    </a>
                    @endpermission
                    <div class="clearfix"></div>

                </div>
                <div class="x_content">
                    <table class="table table-striped" id="users_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('reports.risk_mitigation_plan.full_cup') }}</th>
                            <th>{{ trans('reports.risk_mitigation_plan.project_name') }}</th>
                            <th>{{ trans('reports.risk_mitigation_plan.responsibleUnit') }}</th>
                            <th>{{ trans('reports.risk_mitigation_plan.general_risk') }}</th>
                            <th>{{ trans('reports.risk_mitigation_plan.project_purpose') }}</th>
                            <th>{{ trans('reports.risk_mitigation_plan.project_assumption') }}</th>
                            <th>{{ trans('reports.risk_mitigation_plan.component') }}</th>
                            <th>{{ trans('reports.risk_mitigation_plan.component_assumption') }}</th>
                            <th>{{ trans('reports.risk_mitigation_plan.indicators') }}</th>
                            <th>{{ trans('reports.risk_mitigation_plan.goals') }}</th>
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
                url: '{!! route('data.index.risk_mitigation_plan.reports') !!}'
            },
            scrollX: true,
            responsive: false,
            columns: [
                {data: 'id', visible: false, width: '0', sortable: false, searchable: false},
                {data: 'project.full_cup', width: '5%', searchable: true},
                {data: 'project.name', width: '10%', searchable: true},
                {data: 'responsibleUnit', width: '10%', searchable: true, sortable: false},
                {data: 'project.general_risks', width: '10%', searchable: true, sortable: false},
                {data: 'project.purpose', width: '10%', sortable: false, searchable: true},
                {data: 'project.assumptions', width: '10%', sortable: false, searchable: true},
                {data: 'name', width: '10%', sortable: false, searchable: true},
                {data: 'assumptions', width: '10%', sortable: false, searchable: true},
                {data: 'indicator_name', width: '10%', sortable: false, searchable: true},
                {data: 'goal_description', width: '10%', sortable: false, searchable: true}
            ],
            rowsGroup: [1, 2, 3, 4, 5, 6, 7, 8]
        });

        $('#export_excel').on('click', (e) => {
            e.preventDefault();

            $.ajax({
                url: '{{ route('export.index.risk_mitigation_plan.reports') }}',
                method: 'GET',
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
                    a.download = '{{ trans('reports.risk_mitigation_plan.file_name_excel_report') }}';
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