@permission('edit.physical.progress.project_tracking.execution')

<div id="myModal" class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-tasks"></i> {{ trans('physical_progress.labels.addProgress') }}
        </h4>
    </div>

    <div class="mt-5">

        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pl-5 pr-5">
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
                        <td class="w-25">{{ trans('physical_progress.labels.beneficiaries') }}</td>
                        <td colspan="2">{{ $task->beneficiaries ?? '' }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <form role="form" action="{{ route('update.edit.physical.progress.project_tracking.execution', ['id' => $task->id]) }}" method="post"
              class="form-horizontal form-label-left" id="add_physical_progress_fm" novalidate>

            @method('PUT')
            @csrf

            <div class="item form-group">
                <label class="control-label col-lg-5 col-md-5 col-sm-5 col-xs-12" for="due_date">
                    {{ trans('physical_progress.labels.dueDate') }} <span class="required text-danger">*</span>
                </label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <input name="due_date" id="due_date"
                           class="form-control has-feedback-left readonly-white"
                           placeholder=" DD-MM-YYYY" autocomplete="off" value="{{ $task->due_date }}" readonly/>
                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-lg-5 col-md-5 col-sm-5 col-xs-12" for="beneficiaries">
                    {{ trans('physical_progress.labels.beneficiaries') }}
                </label>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <input name="beneficiaries" id="beneficiaries" type="number" min="0"
                           class="form-control" value="{{ $task->beneficiaries }}" />
                </div>
            </div>

            <div class="item form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div id="dynamic_files">
                            @include('business.tracking.projects.physical.files', ['files' => $task->files])
                        </div>
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <label class="control-label pt-0 col-lg-5 col-md-5 col-sm-5 col-xs-12" for="file">
                            {{ trans('physical_progress.labels.attachmentFile') }} <span class="text-danger">*</span>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <label class="control-label col-md-5 col-sm-5 col-xs-5" for="loan_id">
                                {{ trans('attachments.labels.select_file') }}
                            </label>
                            <div class="col-md-5 col-sm-6 col-xs-7 pl-0">
                                <div class="col-md-11 col-sm-11 col-xs-11">
                                    <input type="file" name="files[]" id="files"
                                           class="form-control"
                                           accept="application/pdf" multiple
                                           data-msg-accept="{{ trans('files.messages.validation.file_extension') }}"/>
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
            </div>

            <div class="text-center p-4">
                <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('physical_progress.labels.sendToReview') }}</button>
            </div>

        </form>
    </div>
</div>

<script>
    $(() => {

        let $form = $('#add_physical_progress_fm');

        // Add datetimepicker
        $(`#due_date`).datetimepicker({
            format: 'DD-MM-YYYY',
            locale: 'es-es',
            useCurrent: false,
            ignoreReadonly: true,
            minDate: moment('{{ $minDate }}', 'DD-MM-YYYY').millisecond(0).second(0).minute(0).hour(0),
            maxDate: moment('{{ $maxDate }}', 'DD-MM-YYYY').endOf('day'),
            viewDate: moment('{{ $minDate }}', 'DD-MM-YYYY').millisecond(0).second(0).minute(0).hour(0),
        });

        $(`#due_date`).on('dp.hide', (e) => {
            setTimeout(() => {
                $(e.currentTarget).data('DateTimePicker').viewDate(moment('{{ $minDate }}', 'DD-MM-YYYY'));
            }, 1);
        });

        $validateDefaults.rules = {
            due_date: {
                required: true
            },
            beneficiaries: {
                min: 0
            }
        };

        $form.validate($.extend(false, $validateDefaults))

        const initElement = () => {
            $('span.input-group-addon.remove-file').on('click', (e) => {
                let url = "{!! route('delete_file.edit.physical.progress.project_tracking.execution') !!}"

                pushRequest(url, '#dynamic_files', (response) => {
                    initElement();
                    if (response.required) {
                        $('#files').rules('add', {
                            required: true
                        })
                    }
                    if (!response.view) {
                        $('#dynamic_files').empty();
                    }
                }, 'DELETE', {
                    _token: '{{ csrf_token() }}',
                    file_id: $(e.currentTarget).attr('data-file'),
                    task_id: '{{ $task->id }}'
                }, false)
            })
        }

        @if(!$task->files()->count())
        $('#files').rules('add', {
            required: true
        })
        @else
        // Initialize delete buttons
        initElement();
        @endif

        $form.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                processResponse(response, null, () => {
                    $validateDefaults.rules = {};
                    $validateDefaults.messages = {};
                    $modal.modal('hide');

                    pushRequest(`{{ route('load_table.physical.progress.project_tracking.execution') }}`, '#physical_progress_table', null, 'GET', {
                        'project_id': '{{ $project_id }}',
                    }, false);
                });
            }
        }));
    });
</script>

@else
    @include('errors.403')
    @endpermission
