@foreach($files as $file)
    <div class="col-md-12">
        <label class="control-label col-md-6 col-sm-6 col-xs-6" for="loan_id">
            {{ $file->name }}
        </label>
        <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="col-md-2 col-sm-2 col-xs-2 pl-0">
                <a href="{{ route('download_file.edit.physical.progress.project_tracking.execution', ['id' => $file->id]) }}">
                    <span class="input-group-addon download-file" data-toggle="tooltip"
                          data-placement="top" data-original-title="{{ trans('attachments.labels.download_file') }}">
                        <span class="glyphicon glyphicon-download-alt"></span>
                    </span>
                </a>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-2 pl-0">
                <a href="#">
                    <span class="input-group-addon remove-file" data-file="{{ $file->id }}" data-placement="top" data-toggle="tooltip"
                          data-original-title="{{ trans('attachments.labels.delete_file') }}">
                        <span class="glyphicon glyphicon-trash"></span>
                    </span>
                </a>
            </div>
        </div>
    </div>
@endforeach
