@permission('index.executive_summary.reports')
<div class="page-title">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h3>{{ trans('app.labels.reports') }}</h3>
        <h2>
            <i class="fa fa-list-alt"></i> {{ trans('reports.labels.reports_executive_summary') }}
        </h2>
        <div class="clearfix"></div>
    </div>
</div>
<div class="clearfix"></div>

<div class="row mb-15">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <h6>{{ trans('reports.executive_summary.select_year') }}</h6>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        @if(count($years))
                            <select class="form-control select2" id="years" name="years">
                                @foreach($years as $year)
                                    @if($loop->first)
                                        <option value="{{ $year->id }}" selected>{{ $year->year }}</option>
                                    @else
                                        <option value="{{ $year->id }}">{{ $year->year }}</option>
                                    @endif
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>
                @permission('data_export.index.executive_summary.reports')
                <ul class="nav navbar-right panel_toolbox mt-3">
                    <li class="pull-right">
                        <a class="btn pdf-export-button" id="data_export" style="display: none">
                            <i class="fa fa-file-pdf-o"></i>{{ trans('reports.export.pdf') }}
                        </a>
                    </li>
                </ul>
                @endpermission

                <div class="clearfix"></div>

            </div>

            <div class="x_content overflow-scroll">
                <table class="table report-table" id="executive_summary_tb">
                    <thead>
                    <tr>
                        <th>{{ trans('projects.labels.code') }}
                            <i role="button" data-toggle="tooltip"
                               data-placement="top"
                               data-original-title="{{ trans('projects.labels.cup_tooltip') }}"
                               class="fa fa-info-circle"></i>
                        </th>
                        <th>{{ trans('app.headers.name') }}</th>
                        <th>{{ trans('projects.labels.responsibleUnit') }}</th>
                        <th>{{ trans('app.headers.date_init') }}</th>
                        <th>{{ trans('app.headers.date_end') }}</th>
                        <th>{{ trans('projects.labels.annual_budget') }}</th>
                        <th>{{ trans('projects.labels.state') }}</th>
                    </tr>
                    </thead>
                </table>

                <div class="row" id="executive_summary_data"></div>

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

        $('.select2').select2({});
        let yearSelected = $("#years").val();
        let url = "{!! route('data.index.executive_summary.reports', ['fiscalYearId' => '__ID__']) !!}";
        url = url.replace('__ID__', yearSelected);
        let $dataTable = build_datatable($('#executive_summary_tb'), {
            ajax: url,
            responsive: false,
            scrollX: true,
            columns: [
                {data: 'full_cup', width: '10%', sortable: false, searchable: false},
                {
                    data: 'name', width: '15%', name: 'projects.name', sortable: true, searchable: true,
                    "render": (data, type, row) => {
                        if (row.name) {
                            $('#data_export').show();
                            return row.name;
                        } else {
                            return '';
                        }
                    }
                },
                {data: 'responsibleUnit', name: 'project.responsibleUnit.name', width: '15%', sortable: true, searchable: true},
                {data: 'date_init', width: '10%', sortable: false, searchable: false},
                {data: 'date_end', width: '10%', sortable: false, searchable: false},
                {data: 'referential_budget', width: '10%', sortable: true, searchable: false},
                {data: 'status', width: '10%', sortable: false, searchable: false}
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
            }
        });

        $("#years").on('change', () => {

            yearSelected = parseInt($("#years").val());
            let newUrl = "{!! route('data.index.executive_summary.reports', ['fiscalYearId' => '__ID__']) !!}";
            newUrl = newUrl.replace('__ID__', yearSelected);
            $dataTable.ajax.url(newUrl);
            showLoading();
            $dataTable.ajax.reload((json) => {
                hideLoading();
                // Mostrar botón de descarga si existe data
                if (json.data.length) {
                    $('#data_export').show();
                } else {
                    $('#data_export').hide();
                }
            });
        });

        $('#data_export').on('click', () => {

            let downloadUrl = "{!! route('data_export.index.executive_summary.reports',['fiscalYearId'=>'__ID__']) !!}";
            downloadUrl = downloadUrl.replace('__ID__', parseInt($("#years").val()));

            location.href = downloadUrl;

        });

        /**
         * Ajusta tamaño de headers y footers de la tabla cuando se redimensiona la pantalla
         */
        $(window).resize(() => {
            $('#executive_summary_tb').DataTable().columns.adjust()
            $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
            $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
        })
    });
</script>

@else
    @include('errors.403')
    @endpermission