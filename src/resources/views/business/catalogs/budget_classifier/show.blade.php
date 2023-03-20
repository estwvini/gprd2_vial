@permission('show.budget_classifiers.module_configuration_catalogs')

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-inbox"></i> {{ trans('budget_classifiers.labels.info') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form class="form-horizontal form-label-left">

                <div class="col-md-10 col-sm-10 col-xs-12">
                    <div class="item form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12" for="code">
                            {{ trans('budget_classifiers.labels.code') }} :
                        </label>

                        <label class="control-label control-label col-md-7 col-sm-8 col-xs-12" for="code" style="font-weight: normal; text-align: left;">
                            {{ $entity->code }}
                        </label>

                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12" for="title">
                            {{ trans('budget_classifiers.labels.title') }} :
                        </label>

                        <label class="control-label col-md-7 col-sm-8 col-xs-12" for="title" style="font-weight: normal; text-align: justify;">
                            {{ $entity->title }}
                        </label>

                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12" for="description">
                            {{ trans('app.headers.description') }} :
                        </label>

                        <label class="control-label col-md-7 col-sm-8 col-xs-12" for="description" style="font-weight: normal; text-align: justify;">
                            {{ $entity->description }}
                        </label>
                    </div>


                    <div class="item form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12" for="enable">
                            {{ trans('app.headers.enabled') }} :
                        </label>
                        <label class="control-label control-label col-md-7 col-sm-8 col-xs-12" style="text-align: left;">
                            <i class="fa @if($entity->enabled) fa-check text-success @else fa-times text-danger @endif"></i>
                        </label>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"> {{ trans('app.labels.accept') }}</button>
    </div>
</div>

@else
    @include('errors.403')
    @endpermission