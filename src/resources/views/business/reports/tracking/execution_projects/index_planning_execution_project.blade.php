@permission('index.planning_execution_projects.reports')
<div>
    <div class="page-title">
        <div class="col-md-10 col-sm-10 col-xs-10">
            <h3> {{ trans('reports.title') }}</h3>
            <h2>
                <i class="fa fa-product-hunt"></i> {{ trans('reports.labels.planning_execution_projects') }}
            </h2>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="form-group has-feedback col-md-2 col-xs-12">
                            <label class="control-label" for="date">
                                {{ trans('reports.progress_investment_project.date') }}
                            </label>
                            <input name="date_init" id="date" value="{{ now()->format('d-m-Y') }}"
                                   class="form-control has-feedback-left readonly-white"
                                   placeholder=" DD-MM-YYYY" autocomplete="off" readonly/>
                            <span class="fa fa-calendar form-control-feedback left mt-2 color-blue" aria-hidden="true"></span>
                        </div>

                        <div class="form-group col-md-4 col-xs-12">
                            <label class="control-label" for="responsible_unit_id">
                                {{ trans('admin_activities.labels.responsible_unit') }}
                            </label>
                            <select class="form-control select2" id="responsible_unit_id">
                                @foreach($executingUnits as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->code }} - {{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 mt-3">
                            <div class="text-right pull-right">
                                @permission('export.index.planning_execution_projects.reports')
                                <a id="export_pdf" class="btn pdf-export-button" href="#">
                                    <i class="fa fa-file-pdf-o"></i> {{ trans('reports.export.pdf') }}
                                </a>
                                @endpermission
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {

        // Add datetimepicker
        $('#date').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: 'es-es',
            useCurrent: false,
            ignoreReadonly: true
        });


        $('#export_pdf').on('click', (e) => {
            e.preventDefault();

            $.ajax({
                url: '{{ route('export.index.planning_execution_projects.reports') }}',
                method: 'GET',
                data: {
                    responsible_unit_id: $('#responsible_unit_id').val(),
                    date: $('#date').val(),
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
                    a.download = '{{ trans('reports.planning_execution_projects.filename') }}';
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