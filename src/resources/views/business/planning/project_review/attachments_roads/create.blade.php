@permission('attachments_roads_show.projects_review.plans_management')
@inject('Project', '\App\Models\Business\Project')

<div id="myModal" class="modal-content">
    <div class="modal-header pb-0">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-paperclip"></i> {{ trans('attachments_roads.title') }}
        </h4>
        <div class="item form-group col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                <h5 class="h5-subtitle">{{ trans('projects.labels.project') }}: <span class="h5-subtitle">{{ $project->cup }} - {{ $project->name }}</span></h5>
            </label>
        </div>
    </div>

    <div class="mt-5 mb-4 ml-5 mr-4">
        <form role="form" class="form-horizontal form-label-left">

            <div id="dynamic_files">
                @include('business.planning.project_review.attachments_roads.partial.inputs')
            </div>
            <div class="ln_solid"></div>
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <button type="button" class="btn btn-info" data-dismiss="modal">
                    <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                </button>
                <button id="submit_attachments" class="btn btn-success" style="display: none;">
                    <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                </button>
            </div>

        </form>
    </div>
</div>

@else
    @include('errors.403')
    @endpermission