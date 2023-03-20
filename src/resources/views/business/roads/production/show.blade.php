@permission('show.production.inventory_roads')

<div class="modal-content" id="production_show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('production.labels.details') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" class="form-horizontal form-label-left">

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="sector">
                        {{ trans('production.labels.sector') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="prod1" id="prod1"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.sector') }}" value="{{ $entity->sector }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="prod1">
                        {{ trans('production.labels.prod1') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="prod1" id="prod1"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.prod1') }}" value="{{ $entity->prod1 }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="prod2">
                        {{ trans('production.labels.prod2') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="prod2" id="prod2"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.prod2') }}" value="{{ $entity->prod2 }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="prod3">
                        {{ trans('production.labels.prod3') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="prod3" id="prod3"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.prod3') }}" value="{{ $entity->prod3 }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="vol1">
                        {{ trans('production.labels.vol1') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="vol1" id="vol1"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.vol1') }}" value="{{ $entity->vol1 }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="vol2">
                        {{ trans('production.labels.vol2') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="vol2" id="vol2"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.vol2') }}" value="{{ $entity->vol2 }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="vol3">
                        {{ trans('production.labels.vol3') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="vol3" id="vol3"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.vol3') }}" value="{{ $entity->vol3 }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="dest1">
                        {{ trans('production.labels.dest1') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="dest1" id="dest1"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.dest1') }}" value="{{ $entity->dest1 }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="dest2">
                        {{ trans('production.labels.dest2') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="dest2" id="dest2"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.dest2') }}" value="{{ $entity->dest2 }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="dest3">
                        {{ trans('production.labels.dest3') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="dest3" id="dest3"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.dest3') }}" value="{{ $entity->dest3 }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="val1">
                        {{ trans('production.labels.val1') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="val1" id="val1"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.val1') }}" value="{{ $entity->val1 }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="val2">
                        {{ trans('production.labels.val2') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="val2" id="val2"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.val2') }}" value="{{ $entity->val2 }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="val3">
                        {{ trans('production.labels.val3') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="val3" id="val3"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.val3') }}" value="{{ $entity->val3 }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="flete1">
                        {{ trans('production.labels.flete1') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="flete1" id="flete1"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.flete1') }}"
                               value="{{ $entity->flete1 }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="flete2">
                        {{ trans('production.labels.flete2') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="flete2" id="flete2"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.flete2') }}"
                               value="{{ $entity->flete2 }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="flete3">
                        {{ trans('production.labels.flete3') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="flete3" id="flete3"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('production.placeholders.flete3') }}"
                               value="{{ $entity->flete3 }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="observ">
                        {{ trans('production.labels.observ') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <textarea name="observ" id="observ" class="form-control col-md-7 col-sm-7 col-xs-12" rows="5"
                                  placeholder="{{ trans('production.placeholders.observ') }}"
                                  disabled>{{ $entity->observ }}</textarea>
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