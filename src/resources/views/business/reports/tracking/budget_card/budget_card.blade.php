@permission('budget_card.reports')
<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('app.labels.reports') }}</h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel mb-15">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-list-alt"></i> {{ trans('reports.budget_card.title') }}
                    </h2>

                    @permission('export.budget_card.reports')
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a id="export_excel" class="btn pdf-export-button">
                                <i class="fa fa-file-excel-o"></i>{{ trans('reports.export.excel') }}
                            </a>
                        </li>
                    </ul>
                    @endpermission

                    <div class="clearfix"></div>
                </div>
                <div class="x_content mb-15">
                    <div class="row">
                        <div class="form-group col-md-2 col-xs-12">
                            <label class="control-label" for="budget_type">
                                {{ trans('reports.budget_card.type') }}
                            </label>
                            <div class="btn-group mb-2" data-toggle="buttons">
                                <label class="btn btn-default active">
                                    <input type="radio" name="budget_type" checked
                                           value="1"> {{ trans('reports.budget_card.type_expense') }}
                                </label>
                                <label class="btn btn-default">
                                    <input type="radio" name="budget_type"
                                           value="2"> {{ trans('reports.budget_card.type_income') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group col-md-2 col-xs-12">
                            <label class="control-label" for="level">
                                {{ trans('reports.budget_card.level') }}
                            </label>
                            <select class="form-control select2" id="level">
                                @foreach($levels as $level)
                                    <option value="{{ $level->niv_est }}" @if($loop->last) selected @endif>{{ $level->niv_est }} - {{ $level->des_est }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2 col-xs-12">
                            <label class="control-label" for="view_children">
                                {{ trans('reports.budget_card.view_children') }}
                            </label>
                            <div class="mt-3 mb-2">
                                {{ trans('reports.labels.no') }} <input type="checkbox" name="view_children"
                                                                        id="view_children"
                                                                        class="js-switch"/> {{ trans('reports.labels.yes') }}
                            </div>
                        </div>

                        <div class="form-group col-md-2 col-xs-12">
                            <label class="control-label" for="year">
                                {{ trans('reports.budget_card.year') }}
                            </label>
                            <select class="form-control" id="year">
                                @foreach($years as $year)
                                    <option value="{{ $year->year }}"
                                            @if($year->year == $currentYear) selected @endif >{{ $year->year }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2 col-xs-12">
                            <label class="control-label" for="date">
                                {{ trans('reports.budget_card.date') }}
                            </label>
                            <div class="input-group mb-0">
                                <input type="text" class="form-control picker readonly-white" id="date"
                                       autocomplete="off" readonly value="{{ $currentDate }}">
                                <span class="input-group-addon clear-selection">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-2 col-xs-12 text-center mt-4">
                            <button class="btn btn-success mb-0" id="search">{{ trans('app.labels.search') }}</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-2 col-xs-12" id="filter_unit">
                            <label class="control-label" for="executing_unit">
                                {{ trans('reports.budget_card.executing_unit') }}
                            </label>
                            <select class="form-control select2" id="executing_unit">
                                <option value="">{{ trans('app.labels.select') }}</option>
                                @foreach($executingUnits as $unit)
                                    <option value="{{ $unit->code }}">{{ $unit->code . ' - ' . $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5 col-sm-5 col-xs-12">
                            <input type="text" id="search-box" class="form-control search_box"
                                   placeholder="Buscar por Código ó Nombre...">
                        </div>
                    </div>
                    <table class="table report-table" id="budget_card">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('reports.budget_card.item') }}</th>
                            <th>{{ trans('reports.budget_card.name') }}</th>
                            <th>{{ trans('reports.budget_card.assigned') }}</th>
                            <th>{{ trans('reports.budget_card.reform') }}</th>
                            <th>{{ trans('reports.budget_card.encoded') }}</th>
                            <th>{{ trans('reports.budget_card.certified') }}</th>
                            <th>{{ trans('reports.budget_card.committed') }}</th>
                            <th>{{ trans('reports.budget_card.accrued') }}</th>
                            <th>{{ trans('reports.budget_card.by_committed') }}</th>
                            <th>{{ trans('reports.budget_card.by_accrued') }}</th>
                            <th>{{ trans('reports.budget_card.paid') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
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
        let datatable = build_datatable($('#budget_card'), {
            dom: '<t>ir',
            ajax: {
                url: '{!! route('data.budget_card.reports') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        year: $('#year').val(),
                        date: $('#date').val(),
                        type: $('input[type=radio][name=budget_type]:checked').val(),
                        level: $('#level').val(),
                        view_children: $('input[type=checkbox][name=view_children]:checked').val(),
                        executing_unit: $('#executing_unit').val()
                    });
                },
                "dataSrc": function (response) {
                    if (response.exception !== '') {
                        notify(response.exception, 'warning')
                    }
                    return response.data;
                }
            },
            paging: false,
            responsive: false,
            scrollX: true,
            scrollY: '400px',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false},
                {data: 'cuenta', width: '15%', sortable: false},
                {data: 'nom_cue', width: '30%', sortable: false},
                {data: 'asig_ini', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'reformas', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'codificado', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'certificado', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'comprometido', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'devengado', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'por_comprometer', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'por_devengar', width: '5%', sortable: false, searchable: false, class: "text-center"},
                {data: 'pagado', width: '5%', sortable: false, searchable: false, class: "text-center"},
            ],
            initComplete: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            drawCallback: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
        });
        $('#date').datetimepicker({
            format: 'YYYY-MM-DD',
            locale: 'es-es',
            ignoreReadonly: true,
            minDate: moment($('#year').val() + "-01-01", "YYYY-MM-DD"),
            maxDate: moment($('#year').val() + "-12-31", "YYYY-MM-DD")
        });

        $('.select2').select2({});
        $('#year').select2({}).on('change', () => {
            $('#date').data('DateTimePicker').destroy();
            $('#date').datetimepicker(
                {
                    format: 'YYYY-MM-DD',
                    locale: 'es-es',
                    date: moment($('#year').val() + "-12-31", "YYYY-MM-DD"),
                    ignoreReadonly: true,
                    minDate: moment($('#year').val() + "-01-01", "YYYY-MM-DD"),
                    maxDate: moment($('#year').val() + "-12-31", "YYYY-MM-DD")
                }
            );
            let d = new Date();
            $('#date').val($('#year').val() + '-' + d.getMonth().toString().padStart(2, "0") + '-' + d.getDay().toString().padStart(2, "0"));
        });

        $('#search').on('click', () => {
            datatable.draw();
        });

        $('#search-box').on('keyup', () => {
            datatable.search($('#search-box').val()).draw();
        });

        $('input[type=radio][name=budget_type]').on('change', () => {
            $('#level').html('');
            let url = '{{ route('levels.budget_card.reports', ['year' => '__YEAR__', 'type' => '__TYPE__']) }}';
            url = url.replace('__YEAR__', $('#year').val());
            url = url.replace('__TYPE__', $('input[type=radio][name=budget_type]:checked').val());
            pushRequest(url, null, (response) => {
                let opt = [];
                $.each(response, (index, value) => {
                    opt.push({
                        id: value.niv_est,
                        text: value.niv_est + ' - ' + value.des_est,
                    });
                });

                $('#level').select2({
                    data: opt
                });
                if (opt.length > 0) {
                    $('#level').val($(opt).last()[0].id); // Select the last option level
                    $('#level').trigger('change');
                }
            }, 'get', null, false);

            if ($('input[type=radio][name=budget_type]:checked').val() == 1) {
                $('#filter_unit').show()
            } else {
                $('#filter_unit').hide()
            }

        });

        $('#export_excel').on('click', (e) => {
            e.preventDefault();
            $.ajax({
                url: '{{ route('export.budget_card.reports') }}',
                method: 'GET',
                data: {
                    year: $('#year').val(),
                    date: $('#date').val(),
                    type: $('input[type=radio][name=budget_type]:checked').val(),
                    level: $('#level').val(),
                    levelDescription: $('#level :selected').text(),
                    view_children: $('input[type=checkbox][name=view_children]:checked').val(),
                    item: $('#search-box').val(),
                    executing_unit: $('#executing_unit').val()
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: (response) => {
                    let a = document.createElement('a');
                    let url = window.URL.createObjectURL(response);
                    a.href = url;
                    a.download = '{{ trans('reports.budget_card.report_file_name') }}';
                    document.body.append(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                }
            });
        });

        $('.clear-selection').on('click', () => {
            $('.picker').datetimepicker('show');
        });

        /**
         * Ajusta tamaño de headers y footers de la tabla cuando se redimensiona la pantalla
         */
        $(window).resize(() => {
            $('#budget_card').DataTable().columns.adjust()
            $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
            $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
        })
    });
</script>

@else
    @include('errors.403')
    @endpermission
