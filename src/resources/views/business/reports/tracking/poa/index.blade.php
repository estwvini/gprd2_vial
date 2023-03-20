@permission('index.poa_tracking.reports')

<div>
    <div class="page-title">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="col-md-11 col-sm-11 col-xs-11">
                <h3>{{ trans('app.labels.reports') }}</h3>
                <h2>
                    <i class="fa fa-list-alt"></i> {{ trans('reports.poa.title_tracking') }}
                </h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-4 col-sm-4 col-xs-12 mb-0">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <h6>{{ trans('reforms.labels.executing_unit') }}</h6>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control select2" id="executing_unit">
                                    <option value="0">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>
                                    @foreach($executingUnits as $unit)
                                        <option value="{{ $unit->id }}">
                                            {{ $unit->code }} - {{ $unit->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-12 mb-0">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <h6>{{ trans('reforms.labels.project') }}</h6>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control select2" id="project" disabled>
                                    <option value="0">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div class="text-right pull-right mt-3">
                                @permission('export.index.poa_tracking.reports')
                                <a id="export_pdf" class="btn pdf-export-button">
                                    <i class="fa fa-file-pdf-o"></i>{{ trans('reports.export.excel') }}
                                </a>
                                @endpermission
                            </div>
                        </div>

                    </div>

                    <div class="clearfix"></div>

                    <table class="table report-table" id="poa_tb">
                        <thead>
                        <tr>
                            <th colspan="7">{{ trans('reports.poa.programmatic_structure') }}</th>
                            <th colspan="5">{{ trans('reports.poa.alignment_budget_item') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.competence') }}</th>
                            <th colspan="4">{{ trans('reports.poa.alignment_orientation') }}</th>
                            <th colspan="3">{{ trans('reports.poa.alignment_location') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.source') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.institution') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.budget_item') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.assigned') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.encoded') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.for_compromising') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.total_accrued') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.jan') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.feb') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.mar') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.t1') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.apr') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.may') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.jun') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.t2') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.jul') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.aug') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.sep') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.t3') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.oct') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.nov') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.dec') }}</th>
                            <th rowspan="2">{{ trans('reports.poa.t4') }}</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>{{ trans('reports.poa.area') }}</th>
                            <th>{{ trans('reports.poa.program') }}</th>
                            <th>{{ trans('reports.poa.subprogram') }}</th>
                            <th>{{ trans('reports.poa.project') }}</th>
                            <th>{{ trans('reports.poa.executing_unit') }}</th>
                            <th>{{ trans('reports.poa.activity') }}</th>
                            <th>{{ trans('reports.poa.nature') }}</th>
                            <th>{{ trans('reports.poa.group') }}</th>
                            <th>{{ trans('reports.poa.subgroup') }}</th>
                            <th>{{ trans('reports.poa.item') }}</th>
                            <th>{{ trans('reports.poa.description') }}</th>
                            <th>{{ trans('reports.poa.orientation') }}</th>
                            <th>{{ trans('reports.poa.direction') }}</th>
                            <th>{{ trans('reports.poa.category') }}</th>
                            <th>{{ trans('reports.poa.sub_category') }}</th>
                            <th>{{ trans('reports.poa.province') }}</th>
                            <th>{{ trans('reports.poa.canton') }}</th>
                            <th>{{ trans('reports.poa.parish') }}</th>
                        </tr>
                        </thead>

                        <tfoot>
                        <tr id="tfoot-tr-4">
                            <th class="text-right" colspan="23">{{ trans('app.labels.footer_total') }}</th>
                            <th class="text-center" id="tfoot-th-total-assigned"></th>
                            <th class="text-center" id="tfoot-th-total-encoded"></th>
                            <th class="text-center" id="tfoot-th-total-for-compromising"></th>
                            <th class="text-center" id="tfoot-th-total"></th>
                            <th colspan=""></th>
                            <th colspan=""></th>
                            <th colspan=""></th>
                            <th colspan=""></th>
                            <th colspan=""></th>
                            <th colspan=""></th>
                            <th colspan=""></th>
                            <th colspan=""></th>
                            <th colspan=""></th>
                            <th colspan=""></th>
                            <th colspan=""></th>
                            <th colspan=""></th>
                            <th colspan=""></th>
                            <th colspan=""></th>
                            <th colspan=""></th>
                            <th colspan=""></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
            <a id="cancelLinks" href="{{ route('index.reports') }}"
               class="btn btn-info ajaxify">{{ trans('app.labels.backward') }}
            </a>
        </div>
    </div>

</div>

<script>
    $(() => {

        let dataTable = build_datatable($('#poa_tb'), {
            dom: 't',
            ajax: {
                url: '{!! route('data.index.poa_tracking.reports') !!}',
                type: 'post',
                dataSrc: function (response) {
                    if (response.exception !== '') {
                        notify(response.exception, 'warning')
                    }
                    return response.data;
                },
                "data": (d) => {
                    return $.extend({}, d, {
                        "filters": {
                            executing_unit: $("#executing_unit").val(),
                            project: $('#project').val(),
                        },
                        _token: '{{ csrf_token() }}'
                    });
                }
            },
            paging: false,
            responsive: false,
            scrollX: true,
            scrollY: '400px',
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false},
                {data: 'area', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'program', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'subprogram', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'project', width: '5%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'executingUnit', width: '5%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'activity', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'nature', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'group', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'subgroup', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'item', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'description', width: '5%', sortable: false, searchable: false},
                {data: 'competence', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'orientation', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'direction', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'category', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'subCategory', width: '5%', sortable: false, searchable: false},
                {data: 'province', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'canton', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'parish', width: '5%', sortable: false, searchable: false},
                {data: 'source', width: '5%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'institution', width: '5%', sortable: false, searchable: false},
                {data: 'code', width: '10%', sortable: false, searchable: false},
                {data: 'assigned', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'encoded', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'for_compromising', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'total_amount', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'jan', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'feb', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'mar', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 't1', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'apr', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'may', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'jun', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 't2', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'jul', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'aug', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'sep', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 't3', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'oct', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'nov', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'dec', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 't4', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ],
            initComplete: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            drawCallback: () => {
                $('.dataTables_scrollBody thead tr').css({visibility: 'collapse'});
                $('.dataTables_scrollBody tfoot tr').css({visibility: 'collapse'});
            },
            footerCallback: function () {
                let api = this.api(), json = api.ajax.json();

                // Update footer
                $('#tfoot-tr-4 #tfoot-th-total').html(
                    '$' + (json.totalAmount !== undefined ? json.totalAmount : 0.00)
                );

                $('#tfoot-tr-4 #tfoot-th-total-encoded').html(
                    '$' + (json.totalEncoded !== undefined ? json.totalEncoded : 0.00)
                );

                $('#tfoot-tr-4 #tfoot-th-total-assigned').html(
                    '$' + (json.totalAssigned !== undefined ? json.totalAssigned : 0.00)
                );

                $('#tfoot-tr-4 #tfoot-th-total-for-compromising').html(
                    '$' + (json.totalForCompromising !== undefined ? json.totalForCompromising : 0.00)
                );
            }
        });

        // Initialize clear selection buttons
        $('.input-group').each((index, element) => {
            let criterionSelect = $(element).find('select');
            let criterionClearButton = $(element).find('span.input-group-addon');

            criterionClearButton.on('click', () => {
                criterionSelect.val(null).trigger('change')
            })
        });

        $('.select2').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', (e) => {

            if ($(e.currentTarget).attr('id') === 'executing_unit') {
                $('#project').html('');
                $('#project').prop("disabled", true);
                $('#project').append('<option value="0">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>');

                if ($('#executing_unit').val() !== '0') {// '0' default option

                    let url = '{{ route('projects.poa.reports', ['executingUnitId' => '__ID__']) }}';
                    url = url.replace('__ID__', $('#executing_unit').val());

                    pushRequest(url, null, (response) => {
                        let opt = [];
                        $.each(response, (index, value) => {
                            opt.push({
                                id: value.id,
                                text: value.project.full_cup + ' - ' + value.project.name,
                            });
                        });
                        $('#project').select2({
                            data: opt
                        });
                        if (response.length > 0) {
                            $('#project').prop("disabled", false);
                        }
                    }, 'get', null, false);
                }
            }
            dataTable.draw();
        });

        $('#export_pdf').on('click', (e) => {
            e.preventDefault();

            $.ajax({
                url: '{{ route('export.index.poa_tracking.reports') }}',
                method: 'GET',
                data: {
                    filters: {
                        executing_unit: $("#executing_unit").val(),
                        project: $('#project').val()
                    }
                },
                xhrFields: {
                    responseType: 'blob'
                },
                beforeSend: () => {
                    showLoading();
                },
                success: (response) => {
                    let a = document.createElement('a');
                    let url = window.URL.createObjectURL(response);
                    a.href = url;
                    a.download = '{{ trans('reports.poa.export_xls') }}';
                    document.body.append(a);
                    a.click();
                    a.remove();
                    window.URL.revokeObjectURL(url);
                }
            }).always(() => {
                hideLoading();
            }).fail(function () {
                hideLoading();
            });
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
