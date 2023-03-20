@permission('pei_structure_report.reports')
<div class="page-title">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <h3>{{ trans('app.labels.reports') }}</h3>
        <h2>
            <i class="fa fa-list-alt"></i> {{ trans('reports.pei_structure.title') }}
        </h2>
    </div>
</div>
<div class="clearfix"></div>

@permission('data.pei_structure_report.reports')
<div class="row mb-15">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="title_left">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <h6>
                                {{ trans('reports.labels.select_year').':' }}
                            </h6>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <select class="form-control select2" name="fiscal_year" id="fiscal_year_id">
                                @foreach($fiscalYears as $fiscalYear)
                                    <option value="{{ $fiscalYear->id }}" @if($fiscalYear->year ===  date('Y')) selected @endif>{{ $fiscalYear->year }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                @permission('export.pei_structure_report.reports')
                <form role="form" id="export_excel" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-8 col-sm-8 col-xs-12 mt-3">
                        <div class="input-group">
                        <span class="input-group-btn">
                            <button type="submit" class="btn pull-right pdf-export-button">
                                <i class="fa fa-file-excel-o"></i>
                                {{ trans('reports.export.excel') }}
                            </button>
                        </span>
                        </div>
                    </div>
                </form>
                @endpermission

                <div class="clearfix"></div>
            </div>
            <div id="report" class="x_content overflow-scroll">
                @include('business.reports.planning.pei_structure.table')
            </div>
        </div>
    </div>
</div>

@endpermission

<footer class="navbar-default navbar-fixed-bottom text-center">
    <a id="cancelLinks" href="{{ route('index.reports') }}"
       class="btn btn-info ajaxify">{{ trans('app.labels.backward') }}
    </a>
</footer>

<script>
    $(() => {
        let fiscalYearSelect = $('#fiscal_year_id');
        fiscalYearSelect.select2();
        let dataUrl;

        let exportUrl = '{{ route('export.pei_structure_report.reports', ['fiscalYearId' => '__YEAR_ID__']) }}';
        exportUrl = exportUrl.replace('__YEAR_ID__', fiscalYearSelect.find('option:selected').val());
        $('#export_excel').attr('action', exportUrl);

        // Modifica la URL para enviar el año fiscal seleccionado al controlador para exportar.
        fiscalYearSelect.on('change', () => {
            let year = fiscalYearSelect.find('option:selected').val();

            dataUrl = '{{ route('data.pei_structure_report.reports', ['fiscalYearId' => '__YEAR_ID__']) }}';
            dataUrl = dataUrl.replace('__YEAR_ID__', year);
            pushRequest(dataUrl, '#report');

            exportUrl = '{{ route('export.pei_structure_report.reports', ['fiscalYearId' => '__YEAR_ID__']) }}';
            exportUrl = exportUrl.replace('__YEAR_ID__', year);
            $('#export_excel').attr('action', exportUrl);
        });

    });
</script>

@else
    @include('errors.403')
    @endpermission