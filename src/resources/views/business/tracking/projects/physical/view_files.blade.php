@if(!$files->count())
    <div class="alert alert-info align-center" role="alert">
        {{ trans('attachments.messages.warning.no_files') }}
    </div>
@endif

<ul class="list-group">
    @foreach($files as $file)
        <li class="list-group-item ">
            {{ $file->name }}
            <span class="pull-right">
                @permission('download_file.edit.physical.progress.project_tracking.execution')
                <a href="{{ route('download_file.edit.physical.progress.project_tracking.execution', ['id' => $file->id]) }}" class="ajaxify">
                    <span class="btn btn-xs btn-default">
                        <span class="fa fa-download color-blue" aria-hidden="true"></span>
                    </span>
                </a>
                @endpermission
            </span>
        </li>
    @endforeach
</ul>
