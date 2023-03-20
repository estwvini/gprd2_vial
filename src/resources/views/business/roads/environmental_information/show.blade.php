@permission('show.environmental_information.inventory_roads')
@inject('EnvironmentalInformation', '\App\Models\Business\Roads\EnvironmentalInformation')
<div class="modal-content" id="environmental_information_show">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('environmental_information.labels.details') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" class="form-horizontal form-label-left">

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="participa">
                        {{ trans('environmental_information.labels.participa') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->participa == $EnvironmentalInformation::STATUS_TRUE) SI @else NO @endif
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="eval_riesg">
                        {{ trans('environmental_information.labels.eval_riesg') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->eval_riesg == $EnvironmentalInformation::STATUS_TRUE) SI @else NO @endif
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="riesg_pot">
                        {{ trans('environmental_information.labels.riesg_pot') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->riesg_pot == $EnvironmentalInformation::STATUS_TRUE) SI @else NO @endif
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="reserv_nat">
                        {{ trans('environmental_information.labels.reserv_nat') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->reserv_nat == $EnvironmentalInformation::STATUS_TRUE) SI @else NO @endif
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="pueb_indig">
                        {{ trans('environmental_information.labels.pueb_indig') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->pueb_indig == $EnvironmentalInformation::STATUS_TRUE) SI @else NO @endif
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="resforest">
                        {{ trans('environmental_information.labels.resforest') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->resforest == $EnvironmentalInformation::STATUS_TRUE) SI @else NO @endif
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="prot_cuenc">
                        {{ trans('environmental_information.labels.prot_cuenc') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->prot_cuenc == $EnvironmentalInformation::STATUS_TRUE) SI @else NO @endif
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-8 col-sm-8 col-xs-12" for="act_ambie">
                        {{ trans('environmental_information.labels.act_ambie') }}
                        <span class="text-danger">*</span>
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        @if($entity->act_ambie == $EnvironmentalInformation::STATUS_TRUE) SI @else NO @endif
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