@permission('index.participatory_budget.reports')
<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3> {{ trans('reports.title') }}</h3>
            <h2>
                <i class="fa fa-users"></i> {{ trans('reports.participatory_budget.title') }}
            </h2>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">

                    @permission('export.index.participatory_budget.reports')
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
                            <th>{{ trans('reports.participatory_budget.location') }}</th>
                            <th>{{ trans('reports.participatory_budget.code') }}</th>
                            <th>{{ trans('reports.participatory_budget.name') }}</th>
                            <th>{{ trans('reports.participatory_budget.initial_assigned') }}</th>
                            <th>{{ trans('reports.participatory_budget.encoded') }}</th>
                            <th>{{ trans('reports.participatory_budget.accrued') }}</th>
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
                url: '{!! route('data.index.participatory_budget.reports') !!}'
            },
            columns: [
                {data: 'id', visible: false, width: '0', sortable: false, searchable: false},
                {data: 'geographic_location.description', width: '5%', searchable: true},
                {data: 'budget_classifier.full_code', width: '10%', searchable: true},
                {data: 'description', width: '10%', searchable: true, sortable: false},
                {data: 'assigned', width: '10%', searchable: true, sortable: false},
                {data: 'encoded', width: '15%', sortable: false, searchable: true},
                {data: 'total_accrued', width: '15%', sortable: false, searchable: true}
            ],
            rowsGroup: [1, 2, 3, 4, 5, 6]
        });

        $('#export_excel').on('click', (e) => {
            e.preventDefault();

            $.ajax({
                url: '{{ route('export.index.participatory_budget.reports') }}',
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
                    a.download = '{{ trans('reports.participatory_budget.file_name_excel_report') }}';
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