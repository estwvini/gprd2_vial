@permission('show.sewer.inventory_roads')

<div class="modal-content" id="intersection_create">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('sewer.labels.details') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form class="form-horizontal form-label-left">

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tipo">
                        {{ trans('sewer.labels.tipo') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="tipo" id="tipo"
                               class="form-control col-md-7 col-sm-7 col-xs-12" disabled
                               placeholder="{{ trans('sewer.placeholders.tipo') }}"
                               value="{{ $entity->tipo }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="longitud">
                        {{ trans('sewer.labels.longitud') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="longitud" id="longitud"
                               class="form-control col-md-7 col-sm-7 col-xs-12" disabled
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
                        <input type="text" name="material" id="material"
                               class="form-control col-md-7 col-sm-7 col-xs-12" disabled
                               placeholder="{{ trans('sewer.placeholders.material') }}"
                               value="{{ $entity->material }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="cuancho">
                        {{ trans('sewer.labels.cuancho') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="cuancho" id="cuancho" disabled
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
                        <input type="text" name="cualto" id="cualto" disabled
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
                        <input type="text" name="cudiam" id="cudiam" disabled
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
                        <input type="text" name="cabezales" id="cabezales" disabled
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
                        <input type="text" name="ecabez" id="ecabez" disabled
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('sewer.placeholders.ecabez') }}"
                               value="{{ $entity->ecabez }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="ecuerpo">
                        {{ trans('sewer.labels.ecuerpo') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="ecuerpo" id="ecuerpo" disabled
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('sewer.placeholders.ecuerpo') }}"
                               value="{{ $entity->ecuerpo }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="lat">
                        {{ trans('sewer.labels.lat') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="lat" id="lat" disabled
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
                        <input type="text" name="longi" id="longi" disabled
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
                                  placeholder="{{ trans('sewer.placeholders.observ') }}"
                                  disabled>{{ $entity->observ }}</textarea>
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