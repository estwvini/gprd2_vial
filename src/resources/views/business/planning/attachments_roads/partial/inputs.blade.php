@inject('Project', '\App\Models\Business\Project')

<div class="item form-group">

    <div id="container_initiative">
        @if(!$project->files()->where('is_road', 1)->count())
            <label class="control-label col-md-5 col-sm-5 col-xs-5" for="loan_id">
                {{ trans('attachments_roads.labels.select_file') }}
            </label>
            <div class="col-md-5 col-sm-6 col-xs-7 pl-0">
                <div class="col-md-11 col-sm-11 col-xs-11">
                    <input type="file" name="files[]" id="files" multiple class="form-control"/>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-1 pl-0">
                    <i role="button" data-toggle="tooltip" data-placement="right"
                       data-original-title="{{ trans('files.messages.info.abbreviation_roads') }}"
                       class="fa fa-info-circle fa-tooltip blue"></i>
                </div>
            </div>
        @else
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="row">
                    @foreach($project->files()->where('is_road', 1)->get() as $file)
                        <div class="col-md-12">
                            <label class="control-label col-md-6 col-sm-6 col-xs-6" for="loan_id">
                                {{ $file->name }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="col-md-2 col-sm-2 col-xs-2 pl-0">
                                    @permission('download_roads.attachments.projects.plans_management')
                                    <a href="{{ route('download_roads.attachments.projects.plans_management', ['id' => $file->id]) }}"><span
                                                class="input-group-addon download-file" data-toggle="tooltip"
                                                data-placement="top"
                                                data-original-title="{{ trans('attachments_roads.labels.download_file') }}">
                                    <span class="glyphicon glyphicon-download-alt"></span>
                                    </span></a>
                                    @endpermission
                                </div>
                                <div class="col-md-2 col-sm-2 col-xs-2 pl-0">
                                    @permission('destroy_roads.attachments.projects.plans_management')
                                    <a><span class="input-group-addon remove-file"
                                             data-file="{{ $file->id }}" data-placement="top"
                                             data-project="{{ $project->id }}" data-toggle="tooltip"
                                             data-original-title="{{ trans('attachments_roads.labels.delete_file') }}">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    </span></a>
                                    @endpermission
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="control-label col-md-5 col-sm-5 col-xs-5" for="loan_id">
                            {{ trans('attachments_roads.labels.select_file') }}
                        </label>
                        <div class="col-md-5 col-sm-6 col-xs-7 pl-0">
                            <div class="col-md-11 col-sm-11 col-xs-11">
                                <input type="file" name="files[]" id="files" multiple class="form-control"/>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1 pl-0">
                                <i role="button" data-toggle="tooltip" data-placement="right"
                                   data-original-title="{{ trans('files.messages.info.abbreviation') }}"
                                   class="fa fa-info-circle fa-tooltip blue"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>