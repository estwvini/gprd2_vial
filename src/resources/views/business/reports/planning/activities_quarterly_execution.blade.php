@permission('activities_quarterly_execution.reports')
<div class="page-title">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('app.labels.reports') }}</h3>
            <h2>
                <i class="fa fa-list-alt"></i> {{ trans('reports.activities_quarterly_execution.title') }}
            </h2>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<div class="row mb-15">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="title_left">
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 mb-4">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h6>{{ trans('reports.labels.select_year') }}</h6>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                @if(count($years))
                                    <select class="form-control select2" id="years" name="years">
                                        @foreach($years as $year)
                                            <option value="{{ $year->id }}" @if($year->year == $currentYear) selected @endif >{{ $year->year }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>

                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 mb-4">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h6>{{ trans('reports.labels.executing_unit') }}</h6>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control select2 select2_type" id="executing_unit_id" name="executing_unit_id">
                                    <option value="">{{ trans('app.labels.select') }}</option>
                                    @foreach($executingUnits as $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 mb-4">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <h6>{{ trans('reports.labels.project') }}</h6>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="input-group">
                                    <select class="form-control select2 select2_type" id="project_id" name="project_id">
                                        <option value="">{{ trans('app.labels.select') }}</option>
                                    </select>
                                    <span class="input-group-addon clear-selection"
                                          data-toggle="tooltip"
                                          data-placement="right"
                                          data-original-title="{{ trans('app.labels.clear_selection') }}">
                                    <span class="glyphicon glyphicon-erase"></span>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table class="table report-table" id="activities_quarterly_execution_tb">
                    <thead>
                    <tr>
                        <th></th>
                        <th>{{ trans('reports/planning/ppi.labels.header.objective_description') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.program_name') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.project_name') }}</th>
                        <th>{{ trans('physical_progress.labels.currentProgress') }}</th>
                        <th>{{ trans('reports.labels.executing_unit') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.component') }}</th>
                        <th>{{ trans('reports/planning/ppi.labels.header.activity') }}</th>
                        <th>{{ trans('physical_progress.labels.quarter1') }}</th>
                        <th>{{ trans('physical_progress.labels.quarter2') }}</th>
                        <th>{{ trans('physical_progress.labels.quarter3') }}</th>
                        <th>{{ trans('physical_progress.labels.quarter4') }}</th>
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

        $('.select2').select2({});

        // Initialize clear selection buttons
        $('.input-group').each((index, element) => {
            let criterionSelect = $(element).find('select')
            let criterionClearButton = $(element).find('span.input-group-addon')

            criterionClearButton.on('click', () => {
                criterionSelect.val(null).trigger('change')
            })
        })

        $('#project_id').select2({
            ajax: {
                url: '{{ route('project_search.activities_quarterly_execution.reports') }}',
                dataType: 'json',
                delay: 100,
                cache: true,
                data: function (params) {
                    return {
                        q: params.term
                    };
                },
                processResults: (data) => {
                    return {
                        results: data
                    };
                }
            },
            placeholder: '{{ trans('app.labels.select') }}'
        });

        let dataTable = build_datatable($('#activities_quarterly_execution_tb'), {
            dom: 'tr',
            ajax: {
                url: '{!! route('data.activities_quarterly_execution.reports') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        "fiscalYearId": $('#years').val(),
                        "departmentId": $('#executing_unit_id').val(),
                        "projectId": $('#project_id').val()
                    });
                }
            },
            paging: false,
            responsive: false,
            scrollX: true,
            scrollY: '400px',
            columns: [
                {data: 'objective_id', visible: false, sortable: false, searchable: false},
                {data: 'objective_description', width: '20%', sortable: false, searchable: false},
                {data: 'program_name', width: '15%', sortable: false, searchable: false},
                {data: 'project_name', width: '15%', sortable: false, searchable: false},
                {data: 'progress', width: '1%', sortable: false, searchable: false, class: "text-center"},
                {data: 'executing_unit', width: '15%', sortable: false, searchable: false},
                {data: 'component', width: '15%', sortable: false, searchable: false},
                {data: 'activity', width: '15%', sortable: false, searchable: false},
                {data: 'first_quarter', width: '1%', sortable: false, searchable: false, class: "text-center"},
                {data: 'second_quarter', width: '1%', sortable: false, searchable: false, class: "text-center"},
                {data: 'third_quarter', width: '1%', sortable: false, searchable: false, class: "text-center"},
                {data: 'fourth_quarter', width: '1%', sortable: false, searchable: false, class: "text-center"},
            ],
            initComplete: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            drawCallback: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            rowsGroup: [1, 2, 3, 4, 5, 6]
        });

        $("#years, #executing_unit_id, #project_id").on('change', () => {
            dataTable.draw();
        });

        /**
         * Ajusta tamaño de headers y footers de la tabla cuando se redimensiona la pantalla
         */
        $(window).resize(() => {
            $('#activities_quarterly_execution_tb').DataTable().columns.adjust()
            $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
            $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
        })
    });
</script>

@else
    @include('errors.403')
    @endpermission
