@permission('create.critical_point.inventory_roads')

<div class="modal-content" id="intersection_create">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('critical_point.labels.create') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" action="{{ route('store.create.critical_point.inventory_roads') }}"
                  method="post"
                  class="form-horizontal form-label-left" id="critical_point_create_fm">
                @csrf

                <input type="hidden" name="codigo" value="{{ $code }}">

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tipo">
                        {{ trans('critical_point.labels.tipo') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="tipo" name="tipo" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($typeCriticalPoints as $typeCriticalPoint)
                                <option value="{{ $typeCriticalPoint->descrip }}">
                                    {{ $typeCriticalPoint->descrip }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="longi">
                        {{ trans('critical_point.labels.longi') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="longi" id="longi"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('critical_point.placeholders.longi') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="lat">
                        {{ trans('critical_point.labels.lat') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="lat" id="lat"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('critical_point.placeholders.lat') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="observ">
                        {{ trans('critical_point.labels.observ') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <textarea name="observ" id="observ" class="form-control col-md-7 col-sm-7 col-xs-12" rows="5"
                                  placeholder="{{ trans('critical_point.placeholders.observ') }}"></textarea>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen">
                        {{ trans('critical_point.labels.imagen') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
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

        let $form = $('#critical_point_create_fm');

        $validateDefaults.rules = {
            tipo: {
                required: true,
                maxlength: 120
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