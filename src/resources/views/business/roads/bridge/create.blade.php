@permission('create.bridge.inventory_roads')

<div class="modal-content" id="bridge_create">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('bridge.labels.create') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" action="{{ route('store.create.bridge.inventory_roads') }}"
                  method="post"
                  class="form-horizontal form-label-left" id="bridge_create_fm">
                @csrf

                <input type="hidden" name="codigo" value="{{ $code }}">

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="codp">
                        {{ trans('bridge.labels.codp') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="codp" id="codp"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.codp') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nombre">
                        {{ trans('bridge.labels.nombre') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="nombre" id="nombre"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.nombre') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="rioqueb">
                        {{ trans('bridge.labels.rioqueb') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="rioqueb" id="rioqueb"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.rioqueb') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="caparodad">
                        {{ trans('bridge.labels.caparodad') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="caparodad" name="caparodad" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($rollingLeatherBridges as $rollingLeatherBridge)
                                <option value="{{ $rollingLeatherBridge->descrip }}">{{ $rollingLeatherBridge->descrip }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="galibo">
                        {{ trans('bridge.labels.galibo') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="galibo" id="galibo"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.galibo') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="ancho">
                        {{ trans('bridge.labels.ancho') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="ancho" id="ancho"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.ancho') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="anchotot">
                        {{ trans('bridge.labels.anchotot') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="anchotot" id="anchotot"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.anchotot') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="longitud">
                        {{ trans('bridge.labels.longitud') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="longitud" id="longitud"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.longitud') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="protlater">
                        {{ trans('bridge.labels.protlater') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="protlater" name="protlater" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($sideProtections as $sideProtection)
                                <option value="{{ $sideProtection->descrip }}">{{ $sideProtection->descrip }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="estprot">
                        {{ trans('bridge.labels.estprot') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="estprot" name="estprot" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($states as $state)
                                <option value="{{ $state->descrip }}">{{ $state->descrip }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="evalinfr">
                        {{ trans('bridge.labels.evalinfr') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="evalinfr" name="evalinfr" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($states as $state)
                                <option value="{{ $state->descrip }}">{{ $state->descrip }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="evalsupes">
                        {{ trans('bridge.labels.evalsupes') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="evalsupes" name="evalsupes" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($states as $state)
                                <option value="{{ $state->descrip }}">{{ $state->descrip }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="carga">
                        {{ trans('bridge.labels.carga') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="carga" id="carga"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.carga') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="sencarga">
                        {{ trans('bridge.labels.sencarga') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="sencarga" id="sencarga"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.sencarga') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="lat">
                        {{ trans('bridge.labels.lat') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="lat" id="lat"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.lat') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="longi">
                        {{ trans('bridge.labels.longi') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="longi" id="longi"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.longi') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="observ">
                        {{ trans('bridge.labels.observ') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <textarea name="observ" id="observ" class="form-control col-md-7 col-sm-7 col-xs-12" rows="5"
                                  placeholder="{{ trans('bridge.placeholders.observ') }}"></textarea>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen1">
                        {{ trans('bridge.labels.imagen1') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="file" name="imagen1" id="imagen1"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               accept="image/png, image/jpeg, image/jpg"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen2">
                        {{ trans('bridge.labels.imagen2') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="file" name="imagen2" id="imagen2"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               accept="image/png, image/jpeg, image/jpg"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen3">
                        {{ trans('bridge.labels.imagen3') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="file" name="imagen3" id="imagen3"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               accept="image/png, image/jpeg, image/jpg"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen4">
                        {{ trans('bridge.labels.imagen4') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="file" name="imagen4" id="imagen4"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               accept="image/png, image/jpeg, image/jpg"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen5">
                        {{ trans('bridge.labels.imagen5') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="file" name="imagen5" id="imagen5"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               accept="image/png, image/jpeg, image/jpg"/>
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <a class="btn btn-info closeModal">
                        <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                    </button>
                </div>

            </form>
        </div>
    </div>

    <div class="modal-footer">
    </div>
</div>

<script>
    $(() => {

        $('.select2').select2({});

        let $form = $('#bridge_create_fm');

        $validateDefaults.rules = {
            codp: {
                required: true,
                maxlength: 255
            },
            nombre: {
                required: true,
                maxlength: 80
            },
            rioqueb: {
                required: true,
                maxlength: 100
            },
            caparodad: {
                required: true,
                maxlength: 120
            },
            galibo: {
                required: true,
                number: true,
                min: 0,
                max: 1000,
                maxlength: 8
            },
            ancho: {
                required: true,
                number: true,
                min: 0,
                max: 1000,
                maxlength: 8
            },
            anchotot: {
                required: true,
                number: true,
                min: 0,
                max: 1000,
                maxlength: 8
            },
            longitud: {
                required: true,
                number: true,
                min: 0,
                max: 1000,
                maxlength: 20
            },
            protlater: {
                required: true,
                maxlength: 120
            },
            estprot: {
                required: true,
                maxlength: 120
            },
            evalinfr: {
                required: true,
                maxlength: 120
            },
            evalsupes: {
                required: true,
                maxlength: 120
            },
            carga: {
                required: true,
                number: true,
                maxlength: 8
            },
            sencarga: {
                required: true,
                maxlength: 255
            },
            lat: {
                required: true,
                maxlength: 255
            },
            longi: {
                required: true,
                maxlength: 255
            },
            observ: {
                required: true,
                maxlength: 180
            }
        };

        $form.validate($validateDefaults);

        $form.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                processResponse(response, null, () => {
                    $modal.modal('hide');
                });
            }
        }));

        $('.closeModal').on('click', (e) => {
            $modal.modal('hide');
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission