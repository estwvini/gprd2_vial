@permission('rejections_log.physical.progress.project_tracking.execution')

@inject('Task', '\App\Models\Business\Task')

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-times-circle"></i> {{ trans('rejections.labels.rejections') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 mt-4 text">
                    <table class="table table-bordered detail-table">
                        <tbody>
                        <tr>
                            <td class="w-25">{{ trans('schedule.labels.task') }}</td>
                            <td colspan="2">{{ $task->name }}</td>
                        </tr>
                        <tr>
                            <td class="w-25">{{ trans('projects.labels.state') }}</td>
                            <td colspan="2">{{ trans('physical_progress.labels.' . $task->status) }}</td>
                        </tr>
                        <tr>
                            <td class="w-25">{{ trans('schedule.labels.startDate') }}</td>
                            <td colspan="2">{{ $task->date_init }}</td>
                        </tr>
                        <tr>
                            <td class="w-25">{{ trans('schedule.labels.endDate') }}</td>
                            <td colspan="2">{{ $task->date_end }}</td>
                        </tr>
                        <tr>
                            <td class="w-25">{{ trans('physical_progress.labels.beneficiaries') }}</td>
                            <td colspan="2">{{ $task->beneficiaries ?? '' }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="x_panel">
                <table class="table table-striped" id="rejections_tb">
                </table>
            </div>

        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal"> {{ trans('app.labels.close') }}</button>
    </div>
</div>

<script>
    $(() => {

        build_datatable($('#rejections_tb'), {
            pageLength: 5,
            info: false,
            bLengthChange: false,
            ajax: '{!! $route !!}',
            order: [[ 3, "desc" ]],
            columns: [
                {data: 'id', visible: false, width: '0', sortable: false, searchable: false},
                {title: '{{ trans('rejections.labels.observations') }}', data: 'observations', width: '50%', searchable: true, class: 'text-justify'},
                {title: '{{ trans('rejections.labels.user') }}', data: 'user', width: '20%', searchable: true, class: 'text-justify'},
                {title: '{{ trans('rejections.labels.rejectDate') }}', data: 'created_at', width: '30%', searchable: true, class: 'text-center'}
            ]
        });
    })
</script>

@else
    @include('errors.403')
    @endpermission
