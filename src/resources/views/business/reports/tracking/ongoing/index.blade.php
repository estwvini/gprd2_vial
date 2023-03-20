@permission('ongoing_projects.reports')
<div class="page-title">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('app.labels.reports') }}</h3>
            <h2>
                <i class="fa fa-list-alt"></i> {{ trans('reports.ongoing_projects.title') }}
            </h2>
        </div>
    </div>
</div>
</div>
<div class="clearfix"></div>

<div class="row  mb-15">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                @permission('export.ongoing_projects.reports')
                <a class="btn pull-right pdf-export-button" href="{{ route('export.ongoing_projects.reports') }}">
                    <i class="fa fa-file-excel-o"></i>
                    {{ trans('reports.export.excel') }}
                </a>
                @endpermission
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table class="table report-table nowrap" id="poa_tb">
                    <thead>
                    <tr>
                        <th></th>
                        <th>{{ trans('reports.ongoing_projects.project_name') }}</th>
                        <th>{{ trans('reports.ongoing_projects.years') }}</th>
                        <th>{{ trans('reports.ongoing_projects.amount_executed') }}</th>
                        <th>{{ trans('reports.ongoing_projects.amount_not_executed') }}</th>
                        <th>{{ trans('reports.ongoing_projects.percent') }}</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<footer class="navbar-default navbar-fixed-bottom text-center">
    <a id="cancelLinks" href="{{ route('index.reports') }}"
       class="btn btn-info ajaxify">{{ trans('app.labels.backward') }}
    </a>
</footer>

<script>
    $(() => {
        build_datatable($('#poa_tb'), {
            ajax: '{{ route('data.ongoing_projects.reports') }}',
            responsive: false,
            scrollX: true,
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false},
                {data: 'name', width: '60%', sortable: false, searchable: false},
                {data: 'year', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'executed', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'not_executed', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'percent', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ],
            initComplete: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
                $('.dataTables_filter').addClass('pull-left');
            },
            drawCallback: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
                $('.dataTables_filter').addClass('pull-left');
            },
            rowsGroup: [1]
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
