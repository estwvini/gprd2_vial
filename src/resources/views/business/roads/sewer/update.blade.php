@permission('edit.sewer.inventory_roads')

<div class="modal-content" id="intersection_create">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('sewer.labels.edit') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" action="{{ route('update.edit.sewer.inventory_roads', ['gid' => $entity->gid]) }}"
                  method="post"
                  class="form-horizontal form-label-left" id="sewer_update_fm">
                @csrf

                <input type="hidden" name="codigo" value="{{ $entity->codigo }}">

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tipo">
                        {{ trans('sewer.labels.tipo') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="tipo" name="tipo" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($typeSewers as $typeSewer)
                                <option value="{{ $typeSewer->descrip }}"
                                        @if($entity->tipo == $typeSewer->descrip) selected @endif>
                                    {{ $typeSewer->descrip }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="longitud">
                        {{ trans('sewer.labels.longitud') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="longitud" id="longitud"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('sewer.placeholders.longitud') }}"
                               value="{{ $entity->longitud }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="material">
                        {{ trans('sewer.labels.material') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="material" name="material" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($materialSewers as $materialSewer)
                                <option value="{{ $materialSewer->descrip }}"
                                        @if($entity->material == $materialSewer->descrip) selected @endif>
                                    {{ $materialSewer->descrip }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cuancho">
                        {{ trans('sewer.labels.cuancho') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="cuancho" id="cuancho"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('sewer.placeholders.cuancho') }}" value="{{ $entity->cuancho }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cualto">
                        {{ trans('sewer.labels.cualto') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="cualto" id="cualto"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('sewer.placeholders.cualto') }}" value="{{ $entity->cualto }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cudiam">
                        {{ trans('sewer.labels.cudiam') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="cudiam" id="cudiam"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('sewer.placeholders.cudiam') }}" value="{{ $entity->cudiam }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cabezales">
                        {{ trans('sewer.labels.cabezales') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="cabezales" id="cabezales"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('sewer.placeholders.cabezales') }}"
                               value="{{ $entity->cabezales }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="ecabez">
                        {{ trans('sewer.labels.ecabez') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="ecabez" name="ecabez" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($states as $state)
                                <option value="{{ $state->descrip }}"
                                        @if($entity->ecabez == $state->descrip) selected @endif>
                                    {{ $state->descrip }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="ecuerpo">
                        {{ trans('sewer.labels.ecuerpo') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="ecuerpo" name="ecuerpo" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($states as $state)
                                <option value="{{ $state->descrip }}"
                                        @if($entity->ecuerpo == $state->descrip) selected @endif>
                                    {{ $state->descrip }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="lat">
                        {{ trans('sewer.labels.lat') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="lat" id="lat"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('sewer.placeholders.lat') }}" value="{{ $entity->lat }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="longi">
                        {{ trans('sewer.labels.longi') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="longi" id="longi"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('sewer.placeholders.longi') }}" value="{{ $entity->longi }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="observ">
                        {{ trans('sewer.labels.observ') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <textarea name="observ" id="observ" class="form-control col-md-7 col-sm-7 col-xs-12" rows="5"
                                  placeholder="{{ trans('sewer.placeholders.observ') }}">{{ $entity->observ }}</textarea>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen1">
                        {{ trans('sewer.labels.imagen1') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->imagen1)
                            <img src="{{ asset($entity->imagePath('imagen1')) }}"
                                 alt="{{ trans('sewer.labels.imagen1') }}"
                                 class="img-responsive avatar-view">
                        @endif
                        <input type="file" name="imagen1" id="imagen1"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               accept="image/png, image/jpeg, image/jpg"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen2">
                        {{ trans('sewer.labels.imagen2') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->imagen2)
                            <img src="{{ asset($entity->imagePath('imagen2')) }}"
                                 alt="{{ trans('sewer.labels.imagen2') }}"
                                 class="img-responsive avatar-view">
                        @endif
                        <input type="file" name="imagen2" id="imagen2"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               accept="image/png, image/jpeg, image/jpg"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen3">
                        {{ trans('sewer.labels.imagen3') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->imagen3)
                            <img src="{{ asset($entity->imagePath('imagen3')) }}"
                                 alt="{{ trans('sewer.labels.imagen3') }}"
                                 class="img-responsive avatar-view">
                        @endif
                        <input type="file" name="imagen3" id="imagen3"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               accept="image/png, image/jpeg, image/jpg"/>
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <a class="btn btn-info ajaxify closeModal">
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

        let $form = $('#sewer_update_fm');

        $validateDefaults.rules = {
            tipo: {
                required: true
            },
            longitud: {
                required: true,
                number: true,
                min: 0,
                max: 1000,
                maxlength: 20
            },
            material: {
                required: true,
                maxlength: 50
            },
            cuancho: {
                required: true,
                number: true,
                min: 0,
                max: 1000,
                maxlength: 9
            },
            cualto: {
                required: true,
                number: true,
                min: 0,
                max: 1000,
                maxlength: 19
            },
            cudiam: {
                required: true,
                number: true,
                min: 0,
                max: 1000,
                maxlength: 19
            },
            cabezales: {
                required: true,
                maxlength: 255
            },
            ecabez: {
                required: true
            },
            ecuerpo: {
                required: true
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