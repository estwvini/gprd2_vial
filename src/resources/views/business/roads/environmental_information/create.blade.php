@permission('create.environmental_information.inventory_roads')

<div class="modal-content" id="environmental_information_create">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('environmental_information.labels.create') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" action="{{ route('store.create.environmental_information.inventory_roads') }}"
                  method="post"
                  class="form-horizontal form-label-left" id="environmental_information_create_fm">
                @csrf

                <input type="hidden" name="codigo" value="{{ $code }}">

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="participa">
                        {{ trans('environmental_information.labels.participa') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="checkbox" name="participa" id="participa" class="js-switch" checked/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="eval_riesg">
                        {{ trans('environmental_information.labels.eval_riesg') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="checkbox" name="eval_riesg" id="eval_riesg" class="js-switch" checked/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="riesg_pot">
                        {{ trans('environmental_information.labels.riesg_pot') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="checkbox" name="riesg_pot" id="riesg_pot" class="js-switch" checked/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="reserv_nat">
                        {{ trans('environmental_information.labels.reserv_nat') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="checkbox" name="reserv_nat" id="reserv_nat" class="js-switch" checked/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="pueb_indig">
                        {{ trans('environmental_information.labels.pueb_indig') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="checkbox" name="pueb_indig" id="pueb_indig" class="js-switch" checked/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="resforest">
                        {{ trans('environmental_information.labels.resforest') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="checkbox" name="resforest" id="resforest" class="js-switch" checked/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="prot_cuenc">
                        {{ trans('environmental_information.labels.prot_cuenc') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="checkbox" name="prot_cuenc" id="prot_cuenc" class="js-switch" checked/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="act_ambie">
                        {{ trans('environmental_information.labels.act_ambie') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="checkbox" name="act_ambie" id="act_ambie" class="js-switch" checked/>
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

        let $form = $('#environmental_information_create_fm');

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