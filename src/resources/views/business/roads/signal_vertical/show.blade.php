@permission('show.signal_vertical.inventory_roads')

<div class="modal-content" id="signal_vertical_show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('signal_vertical.labels.details') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" class="form-horizontal form-label-left">

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="gid">
                        {{ trans('signal_vertical.labels.gid') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="gid" id="gid"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('signal_vertical.placeholders.gid') }}"
                               value="{{ $entity->gid }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tipo">
                        {{ trans('signal_vertical.labels.tipo') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="tipo" id="tipo"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('signal_vertical.placeholders.tipo') }}"
                               value="{{ $entity->tipo }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="estado">
                        {{ trans('signal_vertical.labels.estado') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="estado" id="estado"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('signal_vertical.placeholders.estado') }}"
                               value="{{ $entity->estado }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="lado">
                        {{ trans('signal_vertical.labels.lado') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="lado" id="lado"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('signal_vertical.placeholders.lado') }}"
                               value="{{ $entity->lado }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="lat">
                        {{ trans('signal_vertical.labels.lat') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="lat" id="lat"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('signal_vertical.placeholders.lat') }}"
                               value="{{ $entity->lat }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="longi">
                        {{ trans('signal_vertical.labels.longi') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="longi" id="longi"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('signal_vertical.placeholders.longi') }}"
                               value="{{ $entity->longi }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="observ">
                        {{ trans('signal_vertical.labels.observ') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <textarea name="observ" id="observ" class="form-control col-md-7 col-sm-7 col-xs-12" rows="5"
                                  placeholder="{{ trans('signal_vertical.placeholders.observ') }}"
                                  disabled>{{ $entity->observ }}</textarea>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen">
                        {{ trans('signal_vertical.labels.imagen') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->imagen)
                            <img src="{{ asset($entity->imagePath()) }}"
                                 alt="{{ trans('signal_vertical.labels.imagen') }}"
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