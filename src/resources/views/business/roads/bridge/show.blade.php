@permission('show.bridge.inventory_roads')

<div class="modal-content" id="bridge_show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('bridge.labels.details') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" class="form-horizontal form-label-left">

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="gid">
                        {{ trans('bridge.labels.gid') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="gid" id="gid"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.gid') }}" value="{{ $entity->gid }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="codp">
                        {{ trans('bridge.labels.codp') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="codp" id="codp"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.codp') }}" value="{{ $entity->codp }}"
                               disabled/>
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
                               placeholder="{{ trans('bridge.placeholders.nombre') }}" value="{{ $entity->nombre }}"
                               disabled/>
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
                               placeholder="{{ trans('bridge.placeholders.rioqueb') }}" value="{{ $entity->rioqueb }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="caparodad">
                        {{ trans('bridge.labels.caparodad') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="caparodad" id="caparodad"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.caparodad') }}"
                               value="{{ $entity->caparodad }}" disabled/>
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
                               placeholder="{{ trans('bridge.placeholders.galibo') }}" value="{{ $entity->galibo }}"
                               disabled/>
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
                               placeholder="{{ trans('bridge.placeholders.ancho') }}" value="{{ $entity->ancho }}"
                               disabled/>
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
                               placeholder="{{ trans('bridge.placeholders.anchotot') }}" value="{{ $entity->anchotot }}"
                               disabled/>
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
                               placeholder="{{ trans('bridge.placeholders.longitud') }}" value="{{ $entity->longitud }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="protlater">
                        {{ trans('bridge.labels.protlater') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="protlater" id="protlater"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.protlater') }}"
                               value="{{ $entity->protlater }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="estprot">
                        {{ trans('bridge.labels.estprot') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="estprot" id="estprot"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.estprot') }}" value="{{ $entity->estprot }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="evalinfr">
                        {{ trans('bridge.labels.evalinfr') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="evalinfr" id="evalinfr"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.evalinfr') }}" value="{{ $entity->evalinfr }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="evalsupes">
                        {{ trans('bridge.labels.evalsupes') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="evalsupes" id="evalsupes"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('bridge.placeholders.evalsupes') }}"
                               value="{{ $entity->evalsupes }}" disabled/>
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
                               placeholder="{{ trans('bridge.placeholders.carga') }}" value="{{ $entity->carga }}"
                               disabled/>
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
                               placeholder="{{ trans('bridge.placeholders.sencarga') }}" value="{{ $entity->sencarga }}"
                               disabled/>
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
                               placeholder="{{ trans('bridge.placeholders.lat') }}" value="{{ $entity->lat }}"
                               disabled/>
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
                               placeholder="{{ trans('bridge.placeholders.longi') }}" value="{{ $entity->longi }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="observ">
                        {{ trans('bridge.labels.observ') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <textarea name="observ" id="observ" class="form-control col-md-7 col-sm-7 col-xs-12" rows="5"
                                  placeholder="{{ trans('bridge.placeholders.observ') }}"
                                  disabled>{{ $entity->observ }}</textarea>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen1">
                        {{ trans('bridge.labels.imagen1') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->imagen1)
                            <img src="{{ asset($entity->imagePath('imagen1')) }}"
                                 alt="{{ trans('bridge.labels.imagen1') }}"
                                 class="img-responsive avatar-view">
                        @endif
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen2">
                        {{ trans('bridge.labels.imagen2') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->imagen2)
                            <img src="{{ asset($entity->imagePath('imagen2')) }}"
                                 alt="{{ trans('bridge.labels.imagen2') }}"
                                 class="img-responsive avatar-view">
                        @endif
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen3">
                        {{ trans('bridge.labels.imagen3') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->imagen3)
                            <img src="{{ asset($entity->imagePath('imagen3')) }}"
                                 alt="{{ trans('bridge.labels.imagen3') }}"
                                 class="img-responsive avatar-view">
                        @endif
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen4">
                        {{ trans('bridge.labels.imagen4') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->imagen4)
                            <img src="{{ asset($entity->imagePath('imagen4')) }}"
                                 alt="{{ trans('bridge.labels.imagen4') }}"
                                 class="img-responsive avatar-view">
                        @endif
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen5">
                        {{ trans('bridge.labels.imagen5') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->imagen5)
                            <img src="{{ asset($entity->imagePath('imagen5')) }}"
                                 alt="{{ trans('bridge.labels.imagen5') }}"
                                 class="img-responsive avatar-view">
                        @endif
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <a class="btn btn-info ajaxify closeModal">
                        <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                    </a>
                </div>

            </form>
        </div>
    </div>

    <div class="modal-footer">
    </div>
</div>

<script>
    $(() => {
        $('.closeModal').on('click', (e) => {
            $modal.modal('hide');
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission