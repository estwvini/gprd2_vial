@if(is_null($entity->technical_file))
    <div class="item form-group">
        <label for="technical_file" class="control-label col-md-3 col-sm-3 col-xs-12">
            {{ trans('plan_indicators.labels.technical_file') }}
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="file" name="technical_file" id="technical_file"
                   class="disabledInputs form-control col-md-7 col-sm-7 col-xs-12"
                   accept="application/pdf"/>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-2">
            <span class="fa fa-info-circle fa-2x"
                  data-toggle="tooltip" rel="tooltip" data-placement="right"
                  title="{{ trans('plan_indicators.technical_file_description') }}">
            </span>
        </div>
    </div>
@else
    <div class="item form-group">
        <label for="technical_file" class="control-label col-md-3 col-sm-3 col-xs-12">
            {{ trans('plan_indicators.labels.technical_file') }}
        </label>
        <div class="col-md-9 col-sm-9 col-xs-10">
            <div class="col-md-1 col-sm-1 col-xs-2">
                @permission('download.indicator_attachments.full.indicator.plan_elements.plans.plans_management')
                <a href="{{ route('download.indicator_attachments.full.indicator.plan_elements.plans.plans_management', ['name' => $entity->id]) }}">
                    <span class="input-group-addon download-file"
                          data-toggle="tooltip" data-placement="top"
                          data-original-title="{{ trans('attachments.labels.download_file') }}">
                        <span class="glyphicon glyphicon-download-alt"></span>
                    </span>
                </a>
                @endpermission
            </div>
            <div class="col-md-1 col-sm-1 col-xs-2">
                @permission('destroy.indicator_attachments.full.indicator.plan_elements.plans.plans_management')
                <a>
                    <span class="input-group-addon remove-file"
                          data-indicator="{{ $entity->id }}"
                          data-toggle="tooltip" data-placement="top"
                          data-original-title="{{ trans('attachments.labels.delete_file') }}">
                        <span class="glyphicon glyphicon-trash"></span>
                    </span>
                </a>
                @endpermission
            </div>
        </div>
    </div>
@endif