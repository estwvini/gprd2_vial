@permission('create.traffic.inventory_roads')

<div class="modal-content" id="traffic_create">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('traffic.labels.create') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" action="{{ route('store.create.traffic.inventory_roads') }}"
                  method="post"
                  class="form-horizontal form-label-left" id="traffic_create_fm">
                @csrf

                <input type="hidden" name="codigo" value="{{ $code }}">

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Numlivianos">
                        <span class="label label-primary">{{ trans('traffic.labels.numlivianos') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Numlivianos" id="Numlivianos"
                               class="form-control col-md-7 col-sm-7 col-xs-12 updateTotal"
                               placeholder="{{ trans('traffic.placeholders.numlivianos') }}"/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Tranlivianos">
                        {{ trans('traffic.labels.tranlivianos') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Tranlivianos" id="Tranlivianos"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('traffic.placeholders.tranlivianos') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Numbuses">
                        <span class="label label-primary">{{ trans('traffic.labels.numbuses') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Numbuses" id="Numbuses"
                               class="form-control col-md-7 col-sm-7 col-xs-12 updateTotal"
                               placeholder="{{ trans('traffic.placeholders.numbuses') }}"/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Tranbuses">
                        {{ trans('traffic.labels.tranbuses') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Tranbuses" id="Tranbuses"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('traffic.placeholders.tranbuses') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Num2ejes">
                        <span class="label label-primary">{{ trans('traffic.labels.num2ejes') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Num2ejes" id="Num2ejes"
                               class="form-control col-md-7 col-sm-7 col-xs-12 updateTotal"
                               placeholder="{{ trans('traffic.placeholders.num2ejes') }}"/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Tran2ejes">
                        {{ trans('traffic.labels.tran2ejes') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Tran2ejes" id="Tran2ejes"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('traffic.placeholders.tran2ejes') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Num3ejes">
                        <span class="label label-primary">{{ trans('traffic.labels.num3ejes') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Num3ejes" id="Num3ejes"
                               class="form-control col-md-7 col-sm-7 col-xs-12 updateTotal"
                               placeholder="{{ trans('traffic.placeholders.num3ejes') }}"/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Tran3ejes">
                        {{ trans('traffic.labels.tran3ejes') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Tran3ejes" id="Tran3ejes"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('traffic.placeholders.tran3ejes') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Num4ejes">
                        <span class="label label-primary">{{ trans('traffic.labels.num4ejes') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Num4ejes" id="Num4ejes"
                               class="form-control col-md-7 col-sm-7 col-xs-12 updateTotal"
                               placeholder="{{ trans('traffic.placeholders.num4ejes') }}"/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Tran4ejes">
                        {{ trans('traffic.labels.tran4ejes') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Tran4ejes" id="Tran4ejes"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('traffic.placeholders.tran4ejes') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Num5ejes">
                        <span class="label label-primary">{{ trans('traffic.labels.num5ejes') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Num5ejes" id="Num5ejes"
                               class="form-control col-md-7 col-sm-7 col-xs-12 updateTotal"
                               placeholder="{{ trans('traffic.placeholders.num5ejes') }}"/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Tran5ejes">
                        {{ trans('traffic.labels.tran5ejes') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Tran5ejes" id="Tran5ejes"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('traffic.placeholders.tran5ejes') }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Total tráfico">
                        <span class="label label-primary">{{ trans('traffic.labels.total tráfico') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" disabled
                               class="form-control col-md-7 col-sm-7 col-xs-12 totalTraffic"
                               placeholder="{{ trans('traffic.placeholders.total tráfico') }}"/>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-2 mt-2">
                        <span class="label label-primary">{{ trans('app.labels.hdm4') }}</span>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="tipo_dia_codigo">
                        {{ trans('traffic.labels.tipo_dia_codigo') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <select class="form-control select2"
                                id="tipo_dia_codigo" name="tipo_dia_codigo" readonly>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($typeDays as $typeDay)
                                <option value="{{ $typeDay->descrip }}">
                                    {{ $typeDay->descrip }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="dias_semana">
                        {{ trans('traffic.labels.dias_semana') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="dias_semana" id="dias_semana"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('traffic.placeholders.dias_semana') }}"/>
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

        let $form = $('#traffic_create_fm');

        $validateDefaults.rules = {
            Numlivianos: {
                required: true,
                number: true,
                maxlength: 9
            },
            Tranlivianos: {
                required: true,
                number: true,
                maxlength: 9
            },
            Numbuses: {
                required: true,
                number: true,
                maxlength: 9
            },
            Tranbuses: {
                required: true,
                number: true,
                maxlength: 9
            },
            Num2ejes: {
                required: true,
                number: true,
                maxlength: 9
            },
            Tran2ejes: {
                required: true,
                number: true,
                maxlength: 9
            },
            Num3ejes: {
                required: true,
                number: true,
                maxlength: 9
            },
            Tran3ejes: {
                required: true,
                number: true,
                maxlength: 9
            },
            Num4ejes: {
                required: true,
                number: true,
                maxlength: 9
            },
            Tran4ejes: {
                required: true,
                number: true,
                maxlength: 9
            },
            Num5ejes: {
                required: true,
                number: true,
                maxlength: 9
            },
            Tran5ejes: {
                required: true,
                number: true,
                maxlength: 9
            },
            'Total tráfico': {
                required: true,
                number: true,
                maxlength: 9
            },
            tipo_dia_codigo: {
                required: true,
                maxlength: 120
            },
            dias_semana: {
                required: true,
                maxlength: 120
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

        $('.updateTotal').on('keyup', () => {
            let total = 0;
            $('.updateTotal').each(function (index, data) {
                if ($(this).val()) {
                    total += parseInt($(this).val());
                }
            });

            $('.totalTraffic').val(total)
        })
    });
</script>

@else
    @include('errors.403')
    @endpermission