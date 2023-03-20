@permission('create.geographic_locations.module_configuration_catalogs')

@inject('GeographicLocation', 'App\Models\Business\Catalogs\GeographicLocation')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('geographic_locations.title') }} - {{ $province }}
                <small>{{ trans('app.labels.catalogs') }}</small>
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.geographic_locations.module_configuration_catalogs')
                <li>
                    <a class="ajaxify"
                       href="{{ route('index.geographic_locations.module_configuration_catalogs') }}"> {{ trans('geographic_locations.title') }}</a>
                </li>
                @endpermission

                <li class="active"> {{ trans('app.labels.new') }}</li>
            </ol>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-map"></i>
                        @if(!isset($entity))
                            {{ trans('geographic_locations.labels.new', ['type' => trans('geographic_locations.labels.geographic_location')]) }}
                        @else
                            {{ trans('geographic_locations.labels.new', ['type' => trans('geographic_locations.labels.PARISH')]) }}
                        @endif
                    </h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('index.geographic_locations.module_configuration_catalogs') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form role="form" action="{{ route('store.create.geographic_locations.module_configuration_catalogs') }}" method="post"
                          class="form-horizontal form-label-left" id="geographic_locations_create_fm" novalidate>

                        @csrf

                        @if(isset($entity))
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                                    {{ trans('geographic_locations.labels.CANTON') }} :
                                </label>

                                <label class="control-label col-md-6 col-sm-6 col-xs-12"
                                       style="font-weight: normal; text-align: left;">{{ $entity->code . ' - ' . $entity->description }}</label>
                            </div>
                        @endif


                        <div class="row" id="div_type">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">
                                    {{ trans('geographic_locations.labels.type') }} <span class="text-danger">*</span>
                                </label>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control select2" name="type" id="type">
                                        <option></option>
                                        @foreach($types as $key => $value)
                                            <option value="{{ $key }}"
                                                    @if($key === $GeographicLocation::TYPE_CANTON) selected @endif>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div id='all'>
                            <div class="row" id="div_canton">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="canton">
                                        {{ trans('geographic_locations.labels.CANTON') }}<span class="text-danger"> *</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control select2" name="canton" id="canton">
                                            <option></option>
                                            @foreach($cantons as $obj)
                                                <option value="{{ $obj->id }}">
                                                    {{ $obj->code }} - {{ $obj->description }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">
                                {{ trans('geographic_locations.labels.geographic_location') }}

                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="number" name="code" id="code" min="0" max="99" maxlength="6"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       oninput="if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
                            </div>
                        </div>

                        @if(isset($entity))
                            <input type="hidden" name="parent_id" id="parent_id" value="{{ $entity->id }}"/>
                        @else
                            <input type="hidden" name="parent_id" id="parent_id" value=""/>
                        @endif


                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                {{  trans('geographic_locations.labels.geographic_location_name') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="description" id="description" maxlength="50"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"/>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="{{ route('index.geographic_locations.module_configuration_catalogs') }}" class="btn btn-info ajaxify">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        // initialize selects
        $('.select2').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}",
        });

        // remove parent
        $('#clear-parent').on('click', () => {
            $('#parent_id').val(null).trigger('change');
            if ($('#description').val()) {
                $form.validate().element(':input[name="description"]');
            }
        });

        let $form = $('#geographic_locations_create_fm');

        $validateDefaults.rules = {
            code: {
                required: true,
                onlyIntegers: true,
                minlength: 2,
                maxlength: 2,
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    data: {
                        fieldName: 'code',
                        fieldValue: () => {
                            return $('#code').val();
                        },
                        model: 'App\\Models\\Business\\Catalogs\\GeographicLocation',
                        filter: {
                            parent_id: () => {
                                return $('#parent_id').val();
                            },
                            type: () => {
                                return $('#parent_id').val() != "" ? '{{ $GeographicLocation::TYPE_PARISH }}' : '{{ $GeographicLocation::TYPE_CANTON }}';
                            }
                        }
                    }
                }
            },
            description: {
                required: true,
                minlength: 4,
                maxlength: 50
            }
        };

        $validateDefaults.messages = {
            code: {
                remote: '{!! trans('geographic_locations.messages.validation.geographic_location_code_exists') !!}'
            },
            description: {
                remote: '{!! trans('geographic_locations.messages.validation.geographic_location_description_exists') !!}'
            }
        };

        $form.validate($validateDefaults);

        let selectType = $('#type').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', () => {

            selectCanton.html('');
            selectCanton.prop("disabled", true);
            selectCanton.append('<option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>');

            let url = '{{ route('type.create.geographic_locations.module_configuration_catalogs', ['type'=> '__TYPE__']) }}';

            if (selectType.val() === 'PARISH') {
                url = url.replace('__TYPE__', 'CANTON');
            }

            pushRequest(url, null, (response) => {
                let opt = [];
                $.each(response, function (index, value) {
                    opt.push({
                        id: value.id,
                        text: value.code + ' - ' + value.description
                    });
                });

                if (selectType.val() === 'CANTON') {
                    $('#div_canton').hide();
                    $("#canton", $form).rules("remove", "required");
                    $('#div_canton').hide();
                }

                if (selectType.val() === 'PARISH') {
                    $('#div_canton').show();

                    selectCanton.select2({
                        data: opt
                    });
                    selectCanton.prop("disabled", false);

                    $("#canton", $form).rules("add", {
                        required: true
                    });
                }

            }, 'get', null, false)
        });

        let selectCanton = $('#canton').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', () => {

            $('#parent_id').val(selectCanton.val());
        });


        @if(isset($entity))
        @if($entity->type ==='CANTON')
        $('#type').val('PARISH');
        @endif
        $('#div_type').hide();
        $('#all').hide();
        @else
        $('#div_type').show();
        $('#div_canton').hide();
        @endif


        $form.ajaxForm($formAjaxDefaults);
    });
</script>

@else
    @include('errors.403')
    @endpermission