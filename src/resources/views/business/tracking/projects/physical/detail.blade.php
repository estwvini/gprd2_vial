@permission('view.physical.progress.project_tracking.execution')

<div id="myModal" class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-tasks"></i> {{ trans('physical_progress.labels.detail') }}
        </h4>
    </div>

    <div class="modal-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <table class="table table-bordered detail-table">
                    <tbody>
                    <tr>
                        <td class="w-25">{{ trans('physical_progress.labels.task') }}</td>
                        <td colspan="2">{{ $task->name }}</td>
                    </tr>
                    <tr>
                        <td class="w-25">{{ trans('physical_progress.labels.startDate') }}</td>
                        <td colspan="2">{{ $task->date_init }}</td>
                    </tr>
                    <tr>
                        <td class="w-25">{{ trans('physical_progress.labels.endDate') }}</td>
                        <td colspan="2">{{ $task->date_end }}</td>
                    </tr>
                    <tr>
                        <td class="w-25">{{ trans('physical_progress.labels.dueDate') }}</td>
                        <td colspan="2">{{ $task->due_date ?? '' }}</td>
                    </tr>
                    <tr>
                        <td class="w-25">{{ trans('physical_progress.labels.beneficiaries') }}</td>
                        <td colspan="2">{{ $task->beneficiaries ?? '' }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="ml-10 mr-10 mt-3"><i class="fa fa-paperclip color-blue"></i>
                    {{ trans('physical_progress.labels.attachments') }}
                </label>
                @include('business.tracking.projects.physical.view_files', ['files' => $task->files])
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> {{ trans('app.labels.close') }}</button>
    </div>
</div>

@else
    @include('errors.403')
    @endpermission
