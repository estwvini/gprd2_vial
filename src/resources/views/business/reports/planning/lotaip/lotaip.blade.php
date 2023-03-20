@permission('lotaip.reports')
    <div class="page-title">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3>{{ trans('app.labels.reports') }}</h3>
            <h2>
                <i class="fa fa-list-alt"></i> {{ trans('reports.lotaip.title') }}
            </h2>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row mb-15">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="text-right pull-right d-flex">
                        <label class="mt-3 mr-3" for="year">
                            {{ trans('reports.lotaip.year') }}
                        </label>
                        <select class="form-control" id="year">
                            @foreach($years as $year)
                                <option value="{{ $year->id }}" @if($year->year == $currentYear) selected @endif >{{ $year->year }}</option>
                            @endforeach
                        </select>

                        @permission('export.lotaip.reports')
                        <a id="export_excel" class="btn pdf-export-button ml-5" href=""><i class="fa fa-file-excel-o"></i> {{ trans('reports.export.excel') }}</a>
                        @endpermission
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content overflow-scroll" id="lotaip_table">

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
        $('#year').select2({}).on('change', () => {
            query($('#year').val());

            yearSelected = parseInt($("#year").val());

            let export_url = '{{ route('export.lotaip.reports', ['fiscalYearId' => '__FISCAL_YEAR__']) }}';
            export_url = export_url.replace('__FISCAL_YEAR__', yearSelected);
            $('#export_excel').attr('href', export_url);
        });

        let yearSelected = $("#year").val();

        let export_url = '{{ route('export.lotaip.reports', ['fiscalYearId' => '__FISCAL_YEAR__']) }}';
        export_url = export_url.replace('__FISCAL_YEAR__', yearSelected);
        $('#export_excel').attr('href', export_url);

        const query = (year) => {
            let url = '{{ route('data.lotaip.reports', ['fiscalYearId' => '__ID__']) }}';
            url = url.replace('__ID__', year);
            pushRequest(url, '#lotaip_table');
        };

        query($('#year').val());

    });
</script>

@else
    @include('errors.403')
    @endpermission