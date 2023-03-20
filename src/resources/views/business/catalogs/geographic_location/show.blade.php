@permission('show.geographic_locations.module_configuration_catalogs')

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-map"></i> {{ trans('geographic_locations.labels.info') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form class="form-horizontal form-label-left">

                <div class="col-md-10 col-sm-10 col-xs-12">
                    @if($entity->parent_id)
                        <div class="item form-group">
                            <label class="control-label col-md-5 col-sm-4 col-xs-12" for="parent">
                                {{ trans('geographic_locations.labels.CANTON') }} :
                            </label>

                            <label class="control-label" for="parent" style="font-weight: normal">
                                {{ $entity->parent->description}}
                            </label>
                        </div>
                    @endif

                    <div class="item form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12" for="code">
                            @if($entity->type == \App\Models\Business\Catalogs\GeographicLocation::TYPE_CANTON)
                                {{ trans('geographic_locations.labels.code', ['type' => trans('geographic_locations.labels.CANTON')]) }} :
                            @else
                                {{ trans('geographic_locations.labels.code', ['type' => trans('geographic_locations.labels.PARISH')]) }} :
                            @endif
                        </label>

                        <label class="control-label" for="code" style="font-weight: normal">
                            {{ $entity->code }}
                        </label>

                    </div>

                    <div class="item form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12" for="description">
                            {{ trans('app.headers.name') }} :
                        </label>

                        <label class="control-label" for="description" style="font-weight: normal">
                            {{ $entity->description }}
                        </label>
                    </div>

                    @if(count($entity->children) > 0)
                        <div class="item form-group">
                            <label class="control-label col-md-5 col-sm-4 col-xs-12" for="children">
                                {{ trans('geographic_locations.labels.children') }} :
                            </label>

                            <div class="col-md-7 col-sm-8 col-xs-12" style="padding: 0;">
                                @foreach($entity->children as $childLocation)
                                    <label class="control-label" for="children" style="font-weight: normal">
                                        {{ $childLocation->description }}
                                    </label><br>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="item form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12" for="enable">
                            {{ trans('app.headers.enabled') }} :
                        </label>
                        <label class="control-label">
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