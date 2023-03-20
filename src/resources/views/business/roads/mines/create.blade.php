@permission('create.mines.inventory_roads')

<div class="modal-content" id="intersection_create">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('mines.labels.create') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" action="{{ route('store.create.mines.inventory_roads') }}"
                  method="post"
                  class="form-horizontal form-label-left" id="mines_create_fm">
                @csrf

                <input type="hidden" name="codigo" value="{{ $code }}">

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tipo">
                        {{ trans('mines.labels.tipo') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="tipo" name="tipo" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($typeMines as $typeMine)
                                <option value="{{ $typeMine->descrip }}">
                                    {{ $typeMine->descrip }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="fuente">
                        {{ trans('mines.labels.fuente') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="fuente" name="fuente" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($sources as $source)
                                <option value="{{ $source->descrip }}">
                                    {{ $source->descrip }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="material">
                        {{ trans('mines.labels.material') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="material" name="material" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($materialMines as $materialMine)
                                <option value="{{ $materialMine->descrip }}">
                                    {{ $materialMine->descrip }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="distan">
                        {{ trans('mines.labels.distan') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="distan" id="distan"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('mines.placeholders.distan') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="lat">
                        {{ trans('mines.labels.lat') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="lat" id="lat"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('mines.placeholders.lat') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="longi">
                        {{ trans('mines.labels.longi') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="longi" id="longi"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('mines.placeholders.longi') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="observ">
                        {{ trans('mines.labels.observ') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <textarea name="observ" id="observ" class="form-control col-md-7 col-sm-7 col-xs-12" rows="5"
                                  placeholder="{{ trans('mines.placeholders.observ') }}"></textarea>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="imagen">
                        {{ trans('mines.labels.imagen') }}
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

        let $form = $('#mines_create_fm');

        $validateDefaults.rules = {
            tipo: {
                required: true,
                maxlength: 50
            },
            fuente: {
                required: true,
                maxlength: 50
            },
            material: {
                required: true,
                maxlength: 50
            },
            distan: {
                required: true,
                number: true,
                maxlength: 8,
                min: 0,
                max: 100
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