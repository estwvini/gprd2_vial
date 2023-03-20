<div class="x_panel tile">
    <div class="x_content">

        @if(currentUser()->isSuperAdmin())
            <form role="form" action="{{ route('import.history') }}"
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
                <button class="btn btn-success mt-3" id="submit-fm" data-dismiss="modal">
                    <i class="fa fa-cloud-upload"></i> {{ trans('projects.import.import') }}
                </button>
            </form>

            <script>
                $(() => {
                    let $form = $('#import-fm');
                    $form.validate($validateDefaults);
                    $form.ajaxForm($formAjaxDefaults);
                })
            </script>
        @endif
    </div>
</div>