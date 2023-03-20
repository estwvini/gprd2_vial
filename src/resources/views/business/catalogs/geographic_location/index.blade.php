@permission('index.geographic_locations.module_configuration_catalogs')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('geographic_locations.title') }} - {{ $province }}
                <small>{{ trans('app.labels.catalogs') }}</small>
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        <i class="fa fa-map"></i> {{ trans('geographic_locations.title') }}
                    </h2>

                    @permission('create.geographic_locations.module_configuration_catalogs')
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.geographic_locations.module_configuration_catalogs') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('geographic_locations.labels.create', ['type' => trans('geographic_locations.labels.geographic_location_create')]) }}
                            </a>
                        </li>
                    </ul>
                    @endpermission

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row vertical-align-end">
                        <div class="form-group col-md-2">
                            <label class="control-label" for="type">
                                {{ trans('geographic_locations.labels.location_type') }}
                            </label>
                            <select class="form-control" id="type">
                                <option value="0">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>
                                <option value="{{ \App\Models\Business\Catalogs\GeographicLocation::TYPE_CANTON }}"> {{ trans('geographic_locations.labels.CANTON') }}</option>
                                <option value="{{ \App\Models\Business\Catalogs\GeographicLocation::TYPE_PARISH }}"> {{ trans('geographic_locations.labels.PARISH') }}</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label" for="canton">
                                {{ trans('geographic_locations.labels.CANTON') }}
                            </label>
                            <select class="form-control" id="canton">
                                <option value="0">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>
                                @foreach($cantons as $canton)
                                    <option value="{{ $canton->id }}">
                                        {{ $canton->code }} - {{ $canton->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <button class="btn btn-success btn-block mb-0" id="search">{{ trans('app.labels.search') }}</button>
                        </div>
                    </div>

                    <table class="table table-striped" id="geographic_locations_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('geographic_locations.labels.code', ['type' => '']) }}</th>
                            <th>{{ trans('geographic_locations.labels.CANTON') }}</th>
                            <th>{{ trans('geographic_locations.labels.PARISH') }}</th>
                            <th>{{ trans('geographic_locations.labels.location_type') }}</th>
                            <th>{{ trans('app.headers.enabled') }}</th>
                            <th>{{ trans('app.labels.actions') }}</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        let datatable = build_datatable($('#geographic_locations_tb'), {

            ajax: {
                url: '{!! route('data.index.geographic_locations.module_configuration_catalogs') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        "filters": {
                            type: $("#type").val(),
                            province: $("#province").val(),
                            canton: $("#canton").val(),
                        },
                    });
                },
            },
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'code', width: '10%', sortable: false, searchable: true},
                {data: 'canton', width: '30%', sortable: false, searchable: true},
                {data: 'parish', width: '25%', sortable: false, searchable: true},
                {data: 'type', width: '10%', sortable: false, searchable: true},
                {data: 'enabled', width: '10%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '20%', sortable: false, searchable: false, class: 'text-center'}
            ],
            rowGroup: {
                dataSrc: 'canton'
            },
        }, (e) => { // on enabled switch change

            e.preventDefault();

            let locationType = ($(e.currentTarget).closest('tr').find('td:nth-child(4)').text()) === '{{ trans('geographic_locations.labels.CANTON') }}' ? '{{ trans
            ('geographic_locations.labels.CANTON') }}' : '{{ trans('geographic_locations.labels.PARISH') }}';

            let statusOn = '{{ trans('geographic_locations.messages.confirm.status_on') }}'.replace(':type', locationType);
            let statusOff = '{{ trans('geographic_locations.messages.confirm.status_off') }}'.replace(':type', locationType);

            let confirmMessage = $(e.currentTarget).is(':checked') ? statusOn : statusOff;

            const id = $(e.currentTarget).closest('tr').attr('id');

            confirmModal(confirmMessage, () => {

                let url = "{!! route('status.geographic_locations.module_configuration_catalogs', ['id' => '__ID__']) !!}";
                url = url.replace('__ID__', id);

                pushRequest(url, null, () => {
                    datatable.draw();
                }, 'put', {
                    _token: '{{ csrf_token() }}'
                });
            });
        });

        $('#search').on('click', () => {
            datatable.draw();
        });

        $('#type').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', () => {

            if ($('#type').val() === 'CANTON') {
                canton.prop("disabled", true);
                canton.val('0').change();
            } else {
                canton.prop("disabled", false);
            }
        });

        let canton = $('#canton').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        })
    });
</script>

@else
    @include('errors.403')
    @endpermission