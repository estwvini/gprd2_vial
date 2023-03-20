<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">{{ trans('projects.import.import') }}</h4>
    </div>

    <div class="modal-body">
        <form role="form" action="{{ route('load.import.index.budget.projects.plans_management', ['projectFiscalYear' => $projectFiscalYear->id]) }}"
              method="post" class="form-horizontal form-label-left" enctype="multipart/form-data" id="import-fm">
            @method('POST')
            @csrf

            <label class="control-label col-md-5 col-sm-5 col-xs-5" for="files">
                {{ trans('attachments.labels.select_file') }}
            </label>
            <div class="col-md-5 col-sm-6 col-xs-7 pl-0">
                <div class="col-md-11 col-sm-11 col-xs-11">
                    <input type="file" name="file" id="files" class="form-control"
                           accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                </div>
                <div class="col-md-1 col-sm-1 col-xs-1 pl-0">
                    <i role="button" data-toggle="tooltip" data-placement="right"
                       data-original-title="{{ trans('projects.import.formats') }}"
                       class="fa fa-info-circle fa-tooltip blue"></i>
                </div>
            </div>
            <button class="btn btn-success" id="submit-fm" data-dismiss="modal">
                <i class="fa fa-cloud-upload"></i> {{ trans('projects.import.import') }}
            </button>
        </form>

        <div class="alert alert-danger fw-b mt-3" role="alert">
            {{ trans('projects.import.message') }}
        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">
            <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
        </button>
        <button class="btn btn-success" id="submit-fm" data-dismiss="modal">
            <i class="fa fa-cloud-upload"></i> {{ trans('projects.import.import') }}
        </button>
    </div>
</div>

<script>
    $(() => {
        let $form = $('#import-fm');
        $form.validate($validateDefaults);
        $form.ajaxForm($formAjaxDefaults);
        $('#submit-fm').on('click', () => {
            if($form.valid()){
                $form.submit();
            }
        });
    })
</script>
