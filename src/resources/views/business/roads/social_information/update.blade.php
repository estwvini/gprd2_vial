@permission('edit.social_information.inventory_roads')

<div class="modal-content" id="social_information_edit">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('social_information.labels.edit') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form"
                  action="{{ route('update.edit.social_information.inventory_roads', ['gid' => $entity->gid]) }}"
                  method="post"
                  class="form-horizontal form-label-left" id="social_information_edit_fm">
                @csrf

                <input type="hidden" name="codigo" value="{{ $entity->codigo }}">

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tipopob">
                        {{ trans('social_information.labels.tipopob') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="tipopob" name="tipopob" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($typesPopulation as $typePopulation)
                                <option value="{{ $typePopulation->descrip }}"
                                        @if($entity->tipopob == $typePopulation->descrip) selected @endif>
                                    {{ $typePopulation->descrip }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="asent">
                        {{ trans('social_information.labels.asent') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="asent" id="asent"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('social_information.placeholders.asent') }}"
                               value="{{ $entity->asent }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="organ1">
                        {{ trans('social_information.labels.organ1') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="organ1" id="organ1"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('social_information.placeholders.organ1') }}"
                               value="{{ $entity->organ1 }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="organ2">
                        {{ trans('social_information.labels.organ2') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="organ2" id="organ2"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('social_information.placeholders.organ2') }}"
                               value="{{ $entity->organ2 }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="organ3">
                        {{ trans('social_information.labels.organ3') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="organ3" id="organ3"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('social_information.placeholders.organ3') }}"
                               value="{{ $entity->organ3 }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="pobtot">
                        {{ trans('social_information.labels.pobtot') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="pobtot" id="pobtot"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('social_information.placeholders.pobtot') }}"
                               value="{{ $entity->pobtot }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="vivienda">
                        {{ trans('social_information.labels.vivienda') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="vivienda" id="vivienda"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('social_information.placeholders.vivienda') }}"
                               value="{{ $entity->vivienda }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="lat">
                        {{ trans('social_information.labels.lat') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="lat" id="lat"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('social_information.placeholders.lat') }}"
                               value="{{ $entity->lat }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="longi">
                        {{ trans('social_information.labels.longi') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="longi" id="longi"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('social_information.placeholders.longi') }}"
                               value="{{ $entity->longi }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="observ">
                        {{ trans('slope.labels.observ') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <textarea name="observ" id="observ" class="form-control col-md-7 col-sm-7 col-xs-12" rows="5"
                                  placeholder="{{ trans('social_information.placeholders.observ') }}">{{ $entity->observ }}</textarea>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen">
                        {{ trans('social_information.labels.imagen') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->imagen)
                            <img src="{{ asset($entity->imagePath()) }}"
                                 alt="{{ trans('social_information.labels.imagen') }}"
                                 class="img-responsive avatar-view">
                        @endif
                        <input type="file" name="imagen" id="imagen"
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

        let $form = $('#social_information_edit_fm');

        $validateDefaults.rules = {
            asent: {
                required: true,
                maxlength: 100
            },
            organ1: {
                required: true,
                maxlength: 120
            },
            organ2: {
                required: true,
                maxlength: 120
            },
            organ3: {
                required: true,
                maxlength: 120
            },
            pobtot: {
                required: true,
                number: true,
                maxlength: 8
            },
            vivienda: {
                required: true,
                number: true,
                maxlength: 8
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