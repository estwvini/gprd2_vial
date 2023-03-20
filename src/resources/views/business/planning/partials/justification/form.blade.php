<!-- Justification Modal -->
<div class="modal fade" id="justificationModal" tabindex="-1" role="dialog" aria-labelledby="justificationTitle">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="justificationTitle"><i class="fa fa-file-text"></i> {{ trans('justifications.labels.create') }}</h4>
            </div>

            <div class="modal-body">

                <p id="info" class="text-center mt-3 ml-3 mr-3">@isset($info){{ $info }}@endisset</p>
                <hr>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">

                        @if(isset($form) && $form)
                        <form role="form" class="form-horizontal form-label-left" id="justificationForm" novalidate>
                        @endif

                            <input type="hidden" name="action" id="action" value="@isset($action){{ $action }}@endisset"/>
                            <input type="hidden" name="justifiable" id="justifiable" value="true"/>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="justificationDescription">
                                    {{ trans('justifications.labels.description') }} <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea name="justificationDescription" id="justificationDescription" maxlength="500" rows="4"
                                          class="form-control vertical"></textarea>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="justificationFile">
                                    {{ trans('justifications.labels.file') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-11">
                                    <input type="file" name="justificationFile" id="justificationFile"
                                           class="form-control"
                                           accept="application/pdf"
                                           data-rule-required="true"
                                           data-msg-accept="{{ trans('justifications.messages.validations.file_extension') }}"/>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-1 pl-0">
                                    <i role="button" data-toggle="tooltip" data-placement="right"
                                       data-original-title="{{ trans('justifications.messages.info.abbreviation') }}"
                                       class="fa fa-info-circle fa-tooltip blue"></i>
                                </div>
                            </div>

                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="justificationDocumentReference">
                                    {{ trans('justifications.labels.document_reference') }}
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" name="justificationDocumentReference" id="justificationDocumentReference"
                                           class="form-control" maxlength="50"/>
                                </div>
                            </div>

                        @if(isset($form) && $form)
                        </form>
                        @endif

                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button id="btnCancelJustification" type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-times"></i> {{ trans('justifications.labels.dismiss') }}
                </button>
                @if(isset($type) && $type == 'submit')
                    <button id="justify" name="justify" type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> {{ trans('justifications.labels.save') }}
                    </button>
                @else
                    <button id="justify" name="justify" type="button" class="btn btn-success" data-dismiss="modal">
                        <i class="fa fa-check"></i> {{ trans('justifications.labels.save') }}
                    </button>
                @endif
            </div>

        </div>
    </div>
</div>

@if(isset($form) && $form)
<script>
    var justificationForm = $('#justificationForm');

    $validateDefaults.rules = {
        justificationDescription: {
            required: true,
            maxlength: 500
        },
        justificationFile: {
            required: true,
            extension: 'pdf'
        },
        justificationDocumentReference: {
            required: true,
            maxlength: 50
        }
    };

    justificationForm.validate($validateDefaults);
    justificationForm.ajaxForm($formAjaxDefaults);

    // Abrir el modal de justificación cuyo comportamiento corresponde a los parámetros enviados.
    function justificationModal (callback, data, message = null) {
        $('#justify').unbind('click');

        if(message) {
            $('#info').html(message);
        }
        $('#justificationModal').modal('toggle');

        $('#justify').click((e) => {
            e.preventDefault();

            if (!justificationForm.valid()) {
                return false;
            }

            let formData = new FormData($('#justificationForm')[0]);

            for (const key of Object.keys(data)) {
                if(data[key] instanceof Array) {
                    data[key].forEach(function(element) {
                        formData.append(key + '[]', element);
                    });
                } else {
                    formData.append(key, data[key]);
                }
            }

            callback(formData, {file: true});
            justificationForm.trigger('reset');
        });
    }
</script>
@endif