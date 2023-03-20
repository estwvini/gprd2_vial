<div id="myModal" class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-file-text"></i> {{ trans('rejections.title') }}
        </h4>
    </div>

    <div class="mt-5">

        <p id="info" class="text-center mt-3 ml-3 mr-3">@isset($data['info']){{ $data['info'] }}@endisset</p>
        <hr>

        <form role="form" action="" method="" class="form-horizontal form-label-left" id="rejectForm" novalidate>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rejectObservations">
                    {{ trans('rejections.labels.observations') }} <span class="text-danger">*</span>
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <textarea name="rejectObservations" id="rejectObservations" maxlength="200" rows="4" class="form-control vertical"></textarea>
                </div>
            </div>

            <div class="text-center mb-5">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
                <button id="btnConfirmReject" type="button" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.accept') }}</button>
            </div>

        </form>
    </div>
</div>

<script>
    $(() => {
        let rejectForm = $('#rejectForm');

        $validateDefaults.rules = {
            rejectObservations: {
                required: true,
                maxlength: 200
            }
        };

        rejectForm.validate($validateDefaults);
        rejectForm.ajaxForm($formAjaxDefaults);

        $('#btnConfirmReject').unbind('click');

        $('#btnConfirmReject').on('click', () => {

            if (rejectForm.valid()) {
                @if($data['table_id'] === 'projects_review_tb')
                    let datatable = $('#{{ $data['table_id'] }}').DataTable();
                @endif

                pushRequest('{!! $data['route'] !!}', null, () => {
                    $modal_st.modal('hide');

                    @if($data['table_id'] === 'projects_review_tb')
                        datatable.draw();
                    @else
                        pushRequest(`{{ route('load_table.physical.progress.project_tracking.execution') }}`, '#physical_progress_table', () => {
                            $('#load_quarterly').val(1)
                            $('#load_gantt').val(1)
                        }, 'GET', {
                            'project_id': '{{ $data['project_id'] }}',
                        }, true);
                    @endif

                }, 'put', {
                    _token: '{{ csrf_token() }}',
                    ids: {{ $data['id'] }},
                    observations: $('#rejectObservations').val()
                });

            }
        })

    });
</script>