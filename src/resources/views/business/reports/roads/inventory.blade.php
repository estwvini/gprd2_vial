@permission('inventory_roads.inventory_roads_report')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('general_characteristics_of_track.report') }}
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-automobile"></i>
                        {{ trans('reports/roads/inventory_roads_report.title') }}: {{ $gad["province_short_name"] }}
                    </h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="x_panel">
                        <div class="x_content">
                            <br>
                            <div class="form-horizontal form-label-left input_mask">

                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="canton">
                                            {{ trans('reports/roads/inventory_roads_report.labels.canton') }}
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <select class="form-control" name="canton" id="canton">
                                                <option value=""></option>
                                                @foreach($cantons as $canton)
                                                    <option value="{{ $canton->canton }}">
                                                        {{ $canton->canton }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                        <label class="control-label col-md-4 col-sm-4 col-xs-12" for="parroquia">
                                            {{ trans('reports/roads/inventory_roads_report.labels.parish') }}
                                        </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <select class="form-control" name="parroquia" id="parroquia" disabled>
                                                <option value=""></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <button type="button" class="btn btn-success" id="searchRoads">
                                        {{ trans('reports/roads/inventory_roads_report.labels.consult') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="result" style="display: none">
                        <table class="table table-striped" id="report_roads_tb">
                            <thead>
                            <tr>
                                <th>{{ trans('general_characteristics_of_track.labels.code') }}
                                    <i role="button" data-toggle="tooltip" data-placement="top"
                                       data-original-title="{{ trans('general_characteristics_of_track.messages.info.codeInfo') }}"
                                       class="fa fa-info-circle blue"></i>
                                </th>
                                <th>{{ trans('general_characteristics_of_track.labels.province') }}</th>
                                <th>{{ trans('general_characteristics_of_track.labels.canton') }}</th>
                                <th>{{ trans('general_characteristics_of_track.labels.parish') }}</th>
                                <th>{{ trans('general_characteristics_of_track.labels.origin') }}</th>
                                <th>{{ trans('general_characteristics_of_track.labels.destiny') }}</th>
                                <th>{{ trans('general_characteristics_of_track.labels.longitude_initial') }}</th>
                                <th>{{ trans('general_characteristics_of_track.labels.longitude_finish') }}</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="navbar-default navbar-fixed-bottom text-center">
    <a id="cancelLinks" href="{{ route('index.inventory_roads_report') }}"
       class="btn btn-info ajaxify">{{ trans('app.labels.backward') }}
    </a>
</footer>
<script>

    let canton = $('#canton').select2({
        placeholder: '{{ trans('reports/roads/inventory_roads_report.placeholders.canton') }}'
    }).on('change', () => {
        parish.html('');
        parish.prop("disabled", true);
        parish.append('<option value="0">{{ trans("reports/roads/inventory_roads_report.placeholders.parish") }}</option>');

        let url = '{{ route('parishes.index.inventory_roads.inventory_roads_report', ['name' => '__NAME__']) }}';
        url = url.replace('__NAME__', canton.val());

        pushRequest(url, null, (response) => {
            let opt = [];
            $.each($.parseJSON(response), (index, value) => {
                opt.push({
                    id: value.parroquia,
                    text: value.parroquia
                });
            });
            if (opt.length > 0) {
                parish.prop("disabled", false);
            }
            parish.select2({
                data: opt
            });
        }, 'get', null, false)
    });

    let parish = $('#parroquia').select2({
        placeholder: '{{ trans('reports/roads/inventory_roads_report.placeholders.parish') }}'
    });

    $('#searchRoads').on('click', () => {

        let url = "{!! route('data.index.inventory_roads.inventory_roads_report', ['province' => '__PROVINCE__', 'canton' => '__CANTON__', 'parish' => '__PARISH__']) !!}";

        let provincia = '{{ $gad["province_short_name"] }}';

        url = url.replace('__PROVINCE__', provincia);
        url = url.replace('__CANTON__', canton.val() ? canton.val() : 0);
        url = url.replace('__PARISH__', parish.val() ? parish.val() : 0);

        let $dataTable = build_datatable($('#report_roads_tb'), {
            ajax: '',
            columns: [
                {data: 'codigo', name: 'codigo', width: '10%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'prov', name: 'prov', width: '20%', sortable: false, searchable: true, class: 'text-center'},
                {data: 'canton', name: 'canton', width: '10%', sortable: false, searchable: true, class: 'text-center'},
                {
                    data: 'parroquia',
                    name: 'parroquia',
                    width: '10%',
                    sortable: false,
                    searchable: true,
                    class: 'text-center'
                },
                {
                    data: 'origen',
                    name: 'origen',
                    width: '10%',
                    sortable: false,
                    searchable: false,
                    class: 'text-center'
                },
                {
                    data: 'destino',
                    name: 'destino',
                    width: '10%',
                    sortable: false,
                    searchable: false,
                    class: 'text-center'
                },
                {data: 'longi', name: 'longi', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'longf', name: 'longf', width: '10%', sortable: false, searchable: false, class: 'text-center'}
            ]
        });

        $('#result').show();

        // Reload url when button is clicked
        $dataTable.ajax.url(url);
        showLoading();
        $dataTable.ajax.reload(() => {
            hideLoading();
        });

    });

</script>

@else
    @include('errors.403')
    @endpermission
