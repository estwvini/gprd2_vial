@inject('Project', '\App\Models\Business\Project')

@if(!$files->where('is_road', 1)->count())
    <div class="alert alert-warning align-center" role="alert">
        {{ trans('attachments.messages.warning.no_files') }}
    </div>
@endif

@foreach($files->where('is_road', 1) as $file)
    <div class="item form-group">
        <label class="control-label col-md-6 col-sm-6 col-xs-6" for="loan_id">
            {{ $file->name }}
        </label>

        <div id="container_{{ $file->name }}">

            <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="input-group">
                    <div>
                        @permission('download.attachments_roads_show.projects_review.plans_management')
                        <a href="{{ route('download.attachments_roads_show.projects_review.plans_management', ['id' => $file->id]) }}"><span
                                    class="input-group-addon download-file"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    data-original-title="{{ trans('attachments.labels.download_file') }}">
                        <span class="glyphicon glyphicon-download-alt"></span>
                    </span></a>
                        @endpermission
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach