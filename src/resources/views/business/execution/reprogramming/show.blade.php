@permission('show.reprogramming.reforms_reprogramming.execution')
@inject('Reprogramming', 'App\Models\Business\Reprogramming')

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-refresh"></i> {{ trans('reprogramming.labels.show') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form class="form-horizontal form-label-left">

                <div class="col-md-10 col-sm-10 col-xs-12">
                    <div class="form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12">
                            {{ trans('reprogramming.labels.status') }} :
                        </label>
                        <label class="control-label">
                            <span class="label @if($entity->status == $Reprogramming::STATUS_DRAFT) label-warning @else label-success @endif fs-m">
                                {{ trans('reprogramming.labels.status_'. $entity->status) }}
                            </span>
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12">
                            {{ trans('reprogramming.labels.document') }} :
                        </label>

                        <label class="control-label" for="code" style="font-weight: normal">
                            {{ $entity->code }}
                        </label>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12">
                            {{ trans('app.headers.description') }} :
                        </label>

                        <label class="control-label" for="description" style="font-weight: normal">
                            {{ $entity->description }}
                        </label>
                    </div>

                    @if($entity->file())
                        <div class="form-group">
                            <label class="control-label col-md-5 col-sm-4 col-xs-12">
                                {{ trans('reprogramming.labels.file') }} :
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <a href="{{ route('download.reprogramming.reforms_reprogramming.execution', ['id' => $entity->file()->id]) }}" class="h4">
                                    <i class="fa fa-download text-success"></i>
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="control-label col-md-5 col-sm-4 col-xs-12">
                            {{ trans('reprogramming.labels.project') }} :
                        </label>

                        <label class="control-label" style="font-weight: normal">
                            {{ $entity->projectFiscalYear->project->name }}
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