<tr id="task_row_{{ $element['id'] }}" class="task_activity_{{ $element['activity_id'] }} task_row" task_id="{{ $element['id'] }}" type="{{ $element['type'] }}"
    parent_row="activity_row_{{ $element['activity_id'] }}">
    @foreach($element as $key => $column)
        @if(!in_array($key, ['type', 'id', 'activity_id', 'status', 'responsible', 'rejections', 'dateDiff', 'attachment']))
            <td class="{{ $key }}" id="task_col_{{ $element['id'] }}_{{ $key }}">

                @switch($key)

                    @case('name')
                    <div class="ml-5">
                        @if(isset($element['responsible']) && $element['responsible'])
                            (<label class="acronym" data-toggle="tooltip" data-placement="top" data-original-title="{{ $element['responsible']->fullName() }}">
                                {{ $element['responsible']->getAcronym() }}
                            </label>)
                        @endif
                        <strong>{{ $column }}</strong>
                    </div>
                    @break

                    @case('c_progress')
                    <div id="task_col_data_{{ $element['id'] }}_{{ $key }}">
                        <strong>{{ $column }}</strong>
                    </div>
                    @if($element['status'] === $Task::STATUS_TO_REVIEW)
                        <label class="bg-purple">{{ trans('physical_progress.labels.' . $element['status']) }}</label>
                    @elseif($element['status'] === $Task::STATUS_REJECTED)
                        <label class="bg-red-300 text-white">{{ trans('physical_progress.labels.' . $element['status']) }}</label>
                    @endif
                    @break

                    @case('semaphore')
                    <div class="circle bg_{{ $column }}" data-toggle="tooltip" data-placement="top"
                         data-original-title="{{ trans('physical_progress.labels.' . $element['status']) }}"></div>
                    @break

                    @default
                    <div id="task_col_data_{{ $element['id'] }}_{{ $key }}">
                        <strong>{{ $column }}</strong>
                    </div>
                @endswitch

            </td>
        @endif
    @endforeach
    <td>
        @permission('view.physical.progress.project_tracking.execution')
        <a id="view_progress_{{ $element['id'] }}" class="btn btn-xs btn-info" role="button" data-toggle="tooltip" data-placement="top"
           data-original-title="{{ trans('app.labels.details') }}">
            <i class="fa fa-search"></i>
        </a>
        @endpermission
        @if((isset($element['responsible']) && $element['responsible'] && $currentUser->id === $element['responsible']->id) || $currentUser->isSuperAdmin())
            <a id="add_physical_progress_{{ $element['id'] }}" class="btn btn-xs btn-primary" role="button" data-toggle="tooltip" data-placement="top"
               data-original-title="{{ trans('physical_progress.labels.addProgress') }}">
                <i class="fa fa-edit"></i>
            </a>
            @if(!empty($element['attachment']))
                <a id="remove_physical_progress_{{ $element['id'] }}" class="btn btn-xs btn-danger" role="button" data-toggle="tooltip" data-placement="top"
                   data-original-title="{{ trans('physical_progress.labels.removeProgress') }}">
                    <i class="fa fa-trash"></i>
                </a>
            @endif
            @if(!$element['rejections'])
                <br>
            @endif
        @endif
        @if($element['rejections'])
            <a id="rejections_log_physical_progress_{{ $element['id'] }}" class="btn btn-xs btn-info" role="button" data-toggle="tooltip" data-placement="top"
               data-original-title="{{ trans('rejections.labels.rejectionsLog') }}">
                <i class="fa fa-folder-open"></i>
            </a>
            <br>
        @endif

        @if($element['status'] === $Task::STATUS_TO_REVIEW)
            @if($currentUser->isSuperAdmin() || $currentUser->id === $project->activeLeader()->id)
                <a id="approve_progress_{{ $element['id'] }}" class="btn btn-xs btn-success" role="button" data-toggle="tooltip" data-placement="top"
                   data-original-title="{{ trans('app.labels.approve') }}">
                    <i class="fa fa-check"></i>
                </a>
                <a id="reject_progress_{{ $element['id'] }}" class="btn btn-xs btn-warning" role="button" data-toggle="tooltip" data-placement="top"
                   data-original-title="{{ trans('app.labels.reject') }}">
                    <i class="fa fa-times"></i>
                </a>
            @endif
        @endif
    </td>
</tr>

<script>
    $(() => {
        $('#add_physical_progress_{{ $element['id'] }}').on('click', () => {
            @if($element['dateDiff'])
            pushRequest('{{ route('edit.physical.progress.project_tracking.execution', ['id' => $element['id'], 'project_id' => $project->id]) }}', null, () => {
                $('#load_quarterly').val(1)
                $('#load_gantt').val(1)
            }, 'GET', null, false);
            @else
            notify('{{ trans('physical_progress.messages.exceptions.current_date_invalid', ['element' => $element['type'] === $Task::ELEMENT_TYPE['TASK'] ? trans('physical_progress.labels.type.' . $Task::ELEMENT_TYPE['TASK']) : trans('physical_progress.labels.type.' . $Activity::TYPE) ]) }}', 'warning')
            @endif
        })

        $('#remove_physical_progress_{{ $element['id'] }}').on('click', () => {
            confirmModal('{{ trans('physical_progress.messages.confirm.delete') }}', () => {
                pushRequest('{{ route('destroy.physical.progress.project_tracking.execution', ['id' => $element['id']]) }}', null, () => {
                    pushRequest(`{{ route('load_table.physical.progress.project_tracking.execution') }}`, '#physical_progress_table', () => {
                        $('#load_quarterly').val(1)
                        $('#load_gantt').val(1)
                    }, 'GET', {
                        'project_id': '{{ $project->id }}',
                    }, false);
                }, 'DELETE', {
                    _token: '{{ csrf_token() }}'
                }, false);
            })
        })

        $('#approve_progress_{{ $element['id'] }}').on('click', () => {
            confirmModal('{{ trans('physical_progress.messages.confirm.approve') }}', () => {
                pushRequest('{{ route('approve.physical.progress.project_tracking.execution', ['id' => $element['id']]) }}', null, () => {
                    pushRequest(`{{ route('load_table.physical.progress.project_tracking.execution') }}`, '#physical_progress_table', () => {
                        $('#load_quarterly').val(1)
                        $('#load_gantt').val(1)
                    }, 'GET', {
                        'project_id': '{{ $project->id }}',
                    }, false);
                }, 'POST', {
                    _token: '{{ csrf_token() }}'
                }, false);
            })
        })

        $('#reject_progress_{{ $element['id'] }}').on('click', () => {
            pushRequest('{!! route('observations.reject.physical.progress.project_tracking.execution') !!}', null, null, 'get', {
                info: '{{ trans('physical_progress.messages.confirm.reject') }}',
                route: '{!! route('reject.physical.progress.project_tracking.execution') !!}',
                table_id: 'physical_progress_table',
                project_id: '{{ $project->id }}',
                id: {{ $element['id'] }}
            }, false);
        })

        $('#rejections_log_physical_progress_{{ $element['id'] }}').on('click', () => {
            pushRequest('{!! route('rejections_log.physical.progress.project_tracking.execution') !!}', null, null, 'get', {
                id: {{ $element['id'] }}
            }, false);
        })

        $('#view_progress_{{ $element['id'] }}').on('click', () => {
            pushRequest('{!! route('view.physical.progress.project_tracking.execution') !!}', null, null, 'get', {
                id: {{ $element['id'] }}
            }, false);
        })
    })
</script>