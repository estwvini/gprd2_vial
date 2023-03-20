@permission('index.spending_guide.module_configuration_catalogs')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('spending_guide.title') }}
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
                        <i class="fa fa-compass"></i> {{ trans('spending_guide.title') }}
                    </h2>

                    @permission('create.spending_guide.module_configuration_catalogs')
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.spending_guide.module_configuration_catalogs') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('spending_guide.labels.create', ['type' => trans('spending_guide.labels.spending_orientation')]) }}
                            </a>
                        </li>
                    </ul>
                    @endpermission

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="row vertical-align-end">
                        <div class="form-group col-md-2">
                            <label class="control-label" for="orientation">
                                {{ trans('spending_guide.labels.level_1') }}
                            </label>
                            <select class="form-control" id="orientation">
                                <option value="0">{{ html_entity_decode(trans('app.placeholders.select')) }}</option>
                                @foreach($orientations as $orientation)
                                    <option value="{{ $orientation->id }}">
                                        {{ $orientation->code }} - {{ $orientation->description }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label" for="addressing">
                                {{ trans('spending_guide.labels.level_2') }}
                            </label>
                            <select class="form-control" id="addressing" disabled>
                                <option value="0">{{ html_entity_decode(trans('app.placeholders.select')) }}</option>

                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="control-label" for="category">
                                {{ trans('spending_guide.labels.level_3') }}
                            </label>
                            <select class="form-control" id="category" disabled>
                                <option value="0">{{ html_entity_decode(trans('app.placeholders.select')) }}</option>

                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <button class="btn btn-success btn-block mb-0" id="search">{{ trans('app.labels.search') }}</button>
                        </div>
                    </div>

                    <table class="table table-striped" id="spending_guide_tb">
                        <thead>
                        <tr>
                            <th></th>
                            <th>{{ trans('spending_guide.labels.code') }} <i role="button" data-toggle="tooltip" data-placement="top"
                                                                             data-original-title="{{ trans('spending_guide.messages.info.codeInfo') }}"
                                                                             class="fa fa-info-circle blue"></i>
                            </th>
                            <th>{{ trans('spending_guide.labels.level') }}</th>
                            <th>{{ trans('app.headers.description') }}</th>
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
        let $table = $('#spending_guide_tb');
        let datatable = build_datatable($table, {
            ajax: {
                url: '{!! route('data.index.spending_guide.module_configuration_catalogs') !!}',
                "data": (d) => {
                    return $.extend({}, d, {
                        "filters": {
                            spending: $("#orientation").val(),
                            addressing: $("#addressing").val(),
                            category: $("#category").val(),
                        },
                    });
                },
            },
            columns: [
                {data: 'id', visible: false, sortable: false, searchable: false, width: '0'},
                {data: 'full_code', width: '10%', visible: true, sortable: true, searchable: true},
                {data: 'level', width: '10%', visible: true, sortable: false, searchable: true, name: 'level'},
                {data: 'description', width: '30%', sortable: false, searchable: true},
                {data: 'enabled', width: '15%', sortable: false, searchable: false, class: 'text-center'},
                {data: 'actions', width: '20%', sortable: false, searchable: false, class: 'text-center'}
            ]
        }, (e) => { // on enabled switch change

            e.preventDefault();

            let levelDescription = $(e.currentTarget).closest('tr').find('td:nth-child(4)').text();

            let statusOn = '{{ trans('spending_guide.messages.confirm.status_on') }}'.replace(':type', levelDescription);
            let statusOff = '{{ trans('spending_guide.messages.confirm.status_off') }}'.replace(':type', levelDescription);

            let confirmMessage = $(e.currentTarget).is(':checked') ? statusOn : statusOff;

            const id = $(e.currentTarget).closest('tr').attr('id');

            confirmModal(confirmMessage, () => {

                let url = "{!! route('status.spending_guide.module_configuration_catalogs', ['id' => '__ID__']) !!}";
                url = url.replace('__ID__', id);

                pushRequest(url, null, () => {
                    datatable.draw();
                }, 'put', {
                    _token: '{{ csrf_token() }}'
                });
            });
        });

        let orientation = $('#orientation').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', () => {
            addressing.html('');
            addressing.prop("disabled", true);
            addressing.append('<option value="0">{{ html_entity_decode(trans('app.placeholders.select')) }}</option>');

            category.html('');
            category.prop("disabled", true);
            category.append('<option value="0">{{ html_entity_decode(trans('app.placeholders.select')) }}</option>');

            let url = '{{ route('children.create.spending_guide.module_configuration_catalogs', ['id' => '__ID__']) }}';
            url = url.replace('__ID__', orientation.val());

            pushRequest(url, null, (response) => {
                let opt = [];
                $.each(response, (index, value) => {
                    opt.push({
                        id: value.id,
                        text: value.code + ' - ' + value.description
                    });
                });
                addressing.select2({
                    data: opt
                });
                if (opt.length > 0) {
                    addressing.prop("disabled", false);
                }
            }, 'get', null, false)
        });

        let addressing = $('#addressing').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', () => {

            category.html('');
            category.prop("disabled", true);
            category.append('<option value="0">{{ html_entity_decode(trans('app.placeholders.select')) }}</option>');

            let url = '{{ route('children.create.spending_guide.module_configuration_catalogs', ['id' => '__ID__']) }}';
            url = url.replace('__ID__', addressing.val());

            pushRequest(url, null, (response) => {
                let opt = [];
                $.each(response, (index, value) => {
                    opt.push({
                        id: value.id,
                        text: value.code + ' - ' + value.description
                    });
                });
                category.select2({
                    data: opt
                });
                if (opt.length > 0) {
                    category.prop("disabled", false);
                }
            }, 'get', null, false)
        });

        let category = $('#category').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        });

        $('#search').on('click', () => {
            datatable.draw();
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission
