@if(!$entity->files()->count())
    <div class="alert alert-info align-center" role="alert" id="file_alert">
        {{ trans('admin_activities.messages.validation.no_files') }}
    </div>
@endif

<ul class="list-group">
    @foreach($entity->files as $file)
        <li class="list-group-item ">
            {{ $file->name }}
            <span class="pull-right">
                <a href="{{ route('download.edit.admin_activities.execution', ['id' => $file->id]) }}" class="ajaxify">
                    <span class="btn btn-xs btn-default">
                        <span class="fa fa-download color-blue" aria-hidden="true"></span>
                    </span>
                </a>

                <a href="{{ route('delete.edit.admin_activities.execution', ['id' => $file->id, 'idActivity' => $entity->id]) }}"
                   class="deleteLink">
                    <span class="btn btn-xs btn-default">
                        <span class="fa fa-trash red" aria-hidden="true"></span>
                    </span>
                </a>
            </span>
        </li>
    @endforeach
</ul>

<script>
    $(() => {
        $('.deleteLink').on('click', (e) => {
            e.preventDefault();

            let url = $(e.currentTarget).attr('href');
            if (!url)
                return;
            pushRequest(url, '#dynamic_files');
        })
    })
</script>
