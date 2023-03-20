@permission('create.inventory_roads')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('general_characteristics_of_track.title') }}
            </h3>
        </div>
        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.inventory_roads')
                <li>
                    <a class="ajaxify"
                       href="{{ route('index.inventory_roads') }}"> {{ trans('general_characteristics_of_track.title') }}</a>
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
                    <h2><i class="fa fa-automobile"></i> {{ trans('general_characteristics_of_track.labels.new') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form role="form" action="{{ route('store.create.inventory_roads') }}" method="post"
                          class="form-horizontal form-label-left" id="general_characteristic_of_track_create_fm">

                        @csrf

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="code">
                                {{ trans('general_characteristics_of_track.labels.code') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="text" name="codigo" id="codigo"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.code') }}"/>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-2 pl-0">
                                <i role="button" data-toggle="tooltip" data-placement="right"
                                   data-original-title="{{ trans('general_characteristics_of_track.messages.info.codeInfo') }}"
                                   class="fa fa-info-circle fa-tooltip blue"></i>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="responsible">
                                {{ trans('general_characteristics_of_track.labels.responsible') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="text" name="respons" id="respons"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.responsible') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="date">
                                {{ trans('general_characteristics_of_track.labels.date') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="text" name="fecha" id="fecha"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.date') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="province">
                                {{ trans('general_characteristics_of_track.labels.province') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="text" name="prov" id="prov"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.province') }}"
                                       disabled value="{{ $gad["province_short_name"] }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="canton">
                                {{ trans('general_characteristics_of_track.labels.canton') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="text" name="canton" id="canton"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.canton') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="parish">
                                {{ trans('general_characteristics_of_track.labels.parish') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="text" name="parroquia" id="parroquia"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.parish') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="number_road">
                                {{ trans('general_characteristics_of_track.labels.number_road') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="text" name="numcamino" id="numcamino"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.number_road') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="type_interconnection">
                                {{ trans('general_characteristics_of_track.labels.type_interconnection') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <select class="form-control select2"
                                        id="tipointer" name="tipointer" required>
                                    <option value="">{{ trans('app.labels.select') }}</option>
                                    @foreach($typeInterconnections as $typeInterconnection)
                                        <option value="{{ $typeInterconnection->descrip }}">
                                            {{ $typeInterconnection->descrip }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="origin">
                                {{ trans('general_characteristics_of_track.labels.origin') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="text" name="origen" id="origen"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.origin') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="destiny">
                                {{ trans('general_characteristics_of_track.labels.destiny') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="text" name="destino" id="destino"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.destiny') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="settlement">
                                {{ trans('general_characteristics_of_track.labels.settlement') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="text" name="asentami" id="asentami"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.settlement') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="longitude_initial">
                                {{ trans('general_characteristics_of_track.labels.longitude_initial') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="text" name="longi" id="longi"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.longitude_initial') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="latitude_initial">
                                {{ trans('general_characteristics_of_track.labels.latitude_initial') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="text" name="lati" id="lati"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.latitude_initial') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="longitude_finish">
                                {{ trans('general_characteristics_of_track.labels.longitude_finish') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="text" name="longf" id="longf"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.longitude_finish') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="latitude_finish">
                                {{ trans('general_characteristics_of_track.labels.latitude_finish') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="text" name="latf" id="latf"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.latitude_finish') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="alternate">
                                {{ trans('general_characteristics_of_track.labels.alternate') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="checkbox" name="altermat" id="altermat" class="js-switch" checked/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="treatment_plant">
                                {{ trans('general_characteristics_of_track.labels.treatment_plant') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="checkbox" name="planttr" id="planttr" class="js-switch" checked/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="fill">
                                {{ trans('general_characteristics_of_track.labels.fill') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="checkbox" name="relleno" id="relleno" class="js-switch" checked/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="social_projects">
                                {{ trans('general_characteristics_of_track.labels.social_projects') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="checkbox" name="proysoc" id="proysoc" class="js-switch" checked/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="strategic_projects">
                                {{ trans('general_characteristics_of_track.labels.strategic_projects') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="checkbox" name="proyest" id="proyest" class="js-switch" checked/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="national_security_projects">
                                {{ trans('general_characteristics_of_track.labels.national_security_projects') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="checkbox" name="proyseg" id="proyseg" class="js-switch" checked/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="productive_projects">
                                {{ trans('general_characteristics_of_track.labels.productive_projects') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="checkbox" name="proypro" id="proypro" class="js-switch" checked/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="change_climatic">
                                <span class="label label-primary">{{ trans('general_characteristics_of_track.labels.change_climatic') }}</span>
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <select class="form-control select2"
                                        id="coclimati" name="coclimati" required>
                                    <option value="">{{ trans('app.labels.select') }}</option>
                                    @foreach($climaticConditions as $climaticCondition)
                                        <option value="{{ $climaticCondition->descrip }}">
                                            {{ $climaticCondition->descrip }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                                <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="gid">
                                {{ trans('general_characteristics_of_track.labels.gid') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="text" name="gid" id="gid"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.gid') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="number_tram">
                                {{ trans('general_characteristics_of_track.labels.number_tram') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <input type="text" name="num_tra" id="num_tra"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('general_characteristics_of_track.placeholders.number_tram') }}"/>
                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            <a href="{{ route('index.inventory_roads') }}" class="btn btn-info ajaxify">
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

        $('.select2').select2({});

        $("#code").inputmask();

        $("#code").focusout(() => {

            let aux = $("#code").val();
            aux = aux.replace(/_/g, '0');
            $("#code").val(aux);
        });

        let $form = $('#general_characteristic_of_track_create_fm');

        $validateDefaults.rules = {
            codigo: {
                required: true,
                maxlength: 13,
                remote: {
                    url: "{!! route('check_code.create.inventory_roads') !!}",
                    data: {
                        fieldName: 'codigo',
                        fieldValue: () => {
                            return $('#codigo').val();
                        },
                        type: 'create'
                    }
                },
                codeControl: true
            },
            respons: {
                required: true,
                maxlength: 80
            },
            fecha: {
                required: true,
                maxlength: 12
            },
            prov: {
                required: true,
                maxlength: 255
            },
            canton: {
                required: true,
                maxlength: 255
            },
            parroquia: {
                required: true,
                maxlength: 255
            },
            numcamino: {
                required: true,
                number: true,
                maxlength: 9
            },
            tipointer: {
                required: true,
                maxlength: 9
            },
            origen: {
                required: true,
                maxlength: 120
            },
            destino: {
                required: true,
                maxlength: 120
            },
            asentami: {
                required: true,
                maxlength: 120
            },
            longi: {
                required: true,
                maxlength: 255
            },
            lati: {
                required: true,
                maxlength: 255
            },
            longf: {
                required: true,
                maxlength: 255
            },
            latf: {
                required: true,
                maxlength: 255
            },
            coclimati: {
                required: true,
                maxlength: 255
            },
            gid: {
                required: true,
                number: true,
                maxlength: 9
            },
            num_tra: {
                required: true,
                number: true,
                maxlength: 9
            }
        };

        jQuery.validator.addMethod("codeControl", function (value) {
            let expresion = new RegExp(/^[A-Za-z0-9\-\s]+$/g);
            let verify = expresion.test(value);
            return verify;
        }, "{{ trans('general_characteristics_of_track.messages.errors.code_validate') }}");

        $validateDefaults.messages = {
            codigo: {
                remote: '{{ trans('general_characteristics_of_track.messages.validation.code_exists') }}'
            }
        };

        $form.validate($validateDefaults);
        $form.ajaxForm($formAjaxDefaults);
    });
</script>

@else
    @include('errors.403')
    @endpermission
