@permission('show.traffic.inventory_roads')

<div class="modal-content" id="traffic_show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('traffic.labels.details') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" class="form-horizontal form-label-left">

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Numlivianos">
                        <span class="label label-primary">{{ trans('traffic.labels.numlivianos') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Numlivianos" id="Numlivianos"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('traffic.placeholders.numlivianos') }}"
                               value="{{ $entity->Numlivianos }}" disabled/>
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
                               placeholder="{{ trans('traffic.placeholders.tranlivianos') }}"
                               value="{{ $entity->Tranlivianos }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Numbuses">
                        <span class="label label-primary">{{ trans('traffic.labels.numbuses') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Numbuses" id="Numbuses"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('traffic.placeholders.numbuses') }}"
                               value="{{ $entity->Numbuses }}" disabled/>
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
                               placeholder="{{ trans('traffic.placeholders.tranbuses') }}"
                               value="{{ $entity->Tranbuses }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Num2ejes">
                        <span class="label label-primary">{{ trans('traffic.labels.num2ejes') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Num2ejes" id="Num2ejes"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('traffic.placeholders.num2ejes') }}"
                               value="{{ $entity->Num2ejes }}" disabled/>
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
                               placeholder="{{ trans('traffic.placeholders.tran2ejes') }}"
                               value="{{ $entity->Tran2ejes }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Num3ejes">
                        <span class="label label-primary">{{ trans('traffic.labels.num3ejes') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Num3ejes" id="Num3ejes"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('traffic.placeholders.num3ejes') }}"
                               value="{{ $entity->Num3ejes }}" disabled/>
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
                               placeholder="{{ trans('traffic.placeholders.tran3ejes') }}"
                               value="{{ $entity->Tran3ejes }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Num4ejes">
                        <span class="label label-primary">{{ trans('traffic.labels.num4ejes') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Num4ejes" id="Num4ejes"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('traffic.placeholders.num4ejes') }}"
                               value="{{ $entity->Num4ejes }}" disabled/>
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
                               placeholder="{{ trans('traffic.placeholders.tran4ejes') }}"
                               value="{{ $entity->Tran4ejes }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Num5ejes">
                        <span class="label label-primary">{{ trans('traffic.labels.num5ejes') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Num5ejes" id="Num5ejes"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('traffic.placeholders.num5ejes') }}"
                               value="{{ $entity->Num5ejes }}" disabled/>
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
                               placeholder="{{ trans('traffic.placeholders.tran5ejes') }}"
                               value="{{ $entity->Tran5ejes }}" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="Total tráfico">
                        <span class="label label-primary">{{ trans('traffic.labels.total tráfico') }}</span>
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="text" name="Total tráfico" id="Total tráfico"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('traffic.placeholders.total tráfico') }}"
                               value="{{ $entity->{'Total tráfico'} }}" disabled/>
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
                        <input type="text" name="tipo_dia_codigo" id="tipo_dia_codigo"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('traffic.placeholders.Total tráfico') }}"
                               value="{{ $entity->tipo_dia_codigo }}" disabled/>
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
                               placeholder="{{ trans('traffic.placeholders.dias_semana') }}"
                               value="{{ $entity->dias_semana }}" disabled/>
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