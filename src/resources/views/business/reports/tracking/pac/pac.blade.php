@permission('index.pac_tracking.reports')
@inject('Plan', '\App\Models\Business\Plan')
<div class="page-title">
    <div class="col-md-11 col-sm-11 col-xs-11">
        <h3>{{ trans('app.labels.reports') }}</h3>
        <h2>
            <i class="fa fa-list-alt"></i> {{ trans('reports.pac.title') }}
        </h2>
    </div>
</div>
<div class="clearfix"></div>

<div class="row mb-15">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="title_left">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <h6>{{ trans('reports.labels.select_year') }}</h6>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            @if(count($years))
                                <select class="form-control select2" id="years" name="years">
                                    @foreach($years as $year)
                                        <option value="{{ $year->id }}" @if($year->year == $currentYear) selected @endif >{{ $year->year }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12 mt-3">
                        <div class="text-right pull-right">
                            @permission('export.index.pac_tracking.reports')
                            <a id="export_excel" class="btn pdf-export-button" href=""><i
                                        class="fa fa-file-excel-o"></i> {{ trans('reports.export.excel') }}
                            </a>
                            @endpermission
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">

                <table class="table report-table" id="pac_tb">
                    <thead>
                    <tr>
                        <th colspan="13">{{ trans('reports.pac.budget_item_information') }}</th>
                        <th colspan="13">{{ trans('reports.pac.detailed_product_information') }}</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th>{{ trans('reports.pac.year') }}</th>
                        <th>{{ trans('reports.pac.responsible_unit') }}</th>
                        <th>{{ trans('reports.pac.executing_unit') }}</th>
                        <th>{{ trans('reports.pac.program') }}</th>
                        <th>{{ trans('reports.pac.subprogram') }}</th>
                        <th>{{ trans('reports.pac.project') }}</th>
                        <th>{{ trans('reports.pac.activity') }}</th>
                        <th>{{ trans('reports.pac.geographic') }}</th>
                        <th>{{ trans('reports.pac.budget_item') }}</th>
                        <th>{{ trans('reports.pac.source') }}</th>
                        <th>{{ trans('reports.pac.project_name') }}</th>
                        <th>{{ trans('reports.pac.cpc') }}</th>
                        <th>{{ trans('reports.pac.international_funds') }}</th>
                        <th>{{ trans('reports.pac.regime_type') }}</th>
                        <th>{{ trans('reports.pac.budget_type') }}</th>
                        <th>{{ trans('reports.pac.hiring_type') }}</th>
                        <th>{{ trans('reports.pac.cpc_description') }}</th>
                        <th>{{ trans('reports.pac.measure_unit') }}</th>
                        <th>{{ trans('reports.pac.description') }}</th>
                        <th>{{ trans('reports.pac.amount_no_vat') }}</th>
                        <th>{{ trans('reports.pac.c1') }}</th>
                        <th>{{ trans('reports.pac.c2') }}</th>
                        <th>{{ trans('reports.pac.c3') }}</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr id="tfoot-tr-4">
                        <th class="text-right" colspan="20">{{ trans('app.labels.footer_total') }}</th>
                        <th class="text-center" id="tfoot-th-total"></th>
                        <th colspan="3"></th>
                    </tr>
                    </tfoot>
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

        let yearSelected = $("#years").val();

        let export_url = '{{ route('export.index.pac_tracking.reports', ['fiscalYearId' => '__FISCAL_YEAR__']) }}';
        export_url = export_url.replace('__FISCAL_YEAR__', yearSelected);
        $('#export_excel').attr('href', export_url);

        $("#years").on('change', () => {

            yearSelected = parseInt($("#years").val());

            let export_url = '{{ route('export.index.pac_tracking.reports', ['fiscalYearId' => '__FISCAL_YEAR__']) }}';
            export_url = export_url.replace('__FISCAL_YEAR__', yearSelected);
            $('#export_excel').attr('href', export_url);

            dataTable.draw();
        });

        let dataTable = build_datatable($('#pac_tb'), {
            dom: 'tr',
            ajax: {
                url: '{!! route('data.index.pac_tracking.reports') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        "fiscalYearId": $('#years').val()
                    });
                }
            },
            paging: false,
            responsive: false,
            scrollX: true,
            scrollY: '900px',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false},
                {data: 'fiscalYear', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'responsibleUnit', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'executingUnit', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'program', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'subprogram', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'project', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'activity', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'geographic', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'item', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'source', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'projectName', width: '10%', sortable: false, searchable: false},
                {data: 'cpc', width: '5%', sortable: false, searchable: false},
                {data: 'international_funds', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'regime_type', width: '5%', sortable: false, searchable: false},
                {data: 'budget_type', width: '5%', sortable: false, searchable: false},
                {data: 'hiring_type', width: '5%', sortable: false, searchable: false},
                {data: 'cpcDescription', width: '10%', sortable: false, searchable: false},
                {data: 'measure_unit', width: '1%', sortable: false, searchable: false},
                {data: 'description', width: '10%', sortable: false, searchable: false},
                {data: 'amount_no_vat', width: '1%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'c1', width: '1%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'c2', width: '1%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'c3', width: '1%', sortable: false, searchable: false, class: 'text-center'}
            ],
            initComplete: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            drawCallback: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            footerCallback: function (row, data, start, end, display) {
                let api = this.api(), json = api.ajax.json();

                // Update footer
                $('#tfoot-tr-4 #tfoot-th-total').html(
                    '$' + (json.totalAmount !== undefined ? json.totalAmount : 0.00)
                );
            }
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission