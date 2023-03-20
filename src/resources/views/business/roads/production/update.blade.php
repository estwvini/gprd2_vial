@permission('edit.production.inventory_roads')

<div class="modal-content" id="production_edit">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('production.labels.edit') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" action="{{ route('update.edit.production.inventory_roads', ['gid' => $entity->gid]) }}"
                  method="post"
                  class="form-horizontal form-label-left" id="production_edit_fm">
                @csrf

                <input type="hidden" name="codigo" value="{{ $entity->codigo }}">

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="sector">
                        {{ trans('production.labels.sector') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="sector" name="sector" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($productiveSectors as $productiveSector)
                                <option value="{{ $productiveSector->descrip }}"
                                        @if($entity->sector == $productiveSector->descrip) selected @endif>
                                    {{ $productiveSector->descrip }}
                                </option>
                            @endforeach
                        </select>
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
                               placeholder="{{ trans('production.placeholders.prod1') }}" value="{{ $entity->prod1 }}"/>
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
                               placeholder="{{ trans('production.placeholders.prod2') }}" value="{{ $entity->prod2 }}"/>
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
                               placeholder="{{ trans('production.placeholders.prod3') }}" value="{{ $entity->prod3 }}"/>
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
                               placeholder="{{ trans('production.placeholders.vol1') }}" value="{{ $entity->vol1 }}"/>
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
                               placeholder="{{ trans('production.placeholders.vol2') }}" value="{{ $entity->vol2 }}"/>
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
                               placeholder="{{ trans('production.placeholders.vol3') }}" value="{{ $entity->vol3 }}"/>
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
                               placeholder="{{ trans('production.placeholders.dest1') }}" value="{{ $entity->dest1 }}"/>
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
                               placeholder="{{ trans('production.placeholders.dest2') }}" value="{{ $entity->dest2 }}"/>
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
                               placeholder="{{ trans('production.placeholders.dest3') }}" value="{{ $entity->dest3 }}"/>
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
                               placeholder="{{ trans('production.placeholders.val1') }}" value="{{ $entity->val1 }}"/>
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
                               placeholder="{{ trans('production.placeholders.val2') }}" value="{{ $entity->val2 }}"/>
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
                               placeholder="{{ trans('production.placeholders.val3') }}" value="{{ $entity->val3 }}"/>
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
                               value="{{ $entity->flete1 }}"/>
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
                               value="{{ $entity->flete2 }}"/>
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
                               value="{{ $entity->flete3 }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="observ">
                        {{ trans('production.labels.observ') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <textarea name="observ" id="observ" class="form-control col-md-7 col-sm-7 col-xs-12" rows="5"
                                  placeholder="{{ trans('production.placeholders.observ') }}">{{ $entity->observ }}</textarea>
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

        let $form = $('#production_edit_fm');

        $validateDefaults.rules = {
            sector: {
                required: true,
                maxlength: 50
            },
            prod1: {
                required: true,
                maxlength: 50
            },
            prod2: {
                required: true,
                maxlength: 50
            },
            prod3: {
                required: true,
                maxlength: 50
            },
            vol1: {
                required: true,
                number: true,
                maxlength: 8
            },
            vol2: {
                required: true,
                number: true,
                maxlength: 8
            },
            vol3: {
                required: true,
                number: true,
                maxlength: 8
            },
            dest1: {
                required: true,
                maxlength: 80
            },
            dest2: {
                required: true,
                maxlength: 80
            },
            dest3: {
                required: true,
                maxlength: 80
            },
            val1: {
                required: true,
                maxlength: 50
            },
            val2: {
                required: true,
                maxlength: 50
            },
            val3: {
                required: true,
                maxlength: 50
            },
            flete1: {
                required: true,
                maxlength: 50
            },
            flete2: {
                required: true,
                maxlength: 50
            },
            flete3: {
                required: true,
                maxlength: 50
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