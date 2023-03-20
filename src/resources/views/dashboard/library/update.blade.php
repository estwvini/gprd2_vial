@permission('edit.inventory_library')
@inject('Document', 'App\Models\Business\Library\Document')

<div id="myModal" class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-road"></i> {{ trans('library.labels.update') }} - {{ $entity->type}}
        </h4>
    </div>

    <div class="mt-5">
        <form role="form" action="{{ route('update.edit.inventory_library', ['id' => $entity->id]) }}" method="post"
              class="form-horizontal form-label-left" id="document_update_fm" novalidate>

            @csrf
            <input type="hidden" name="type" id="type" value="{{ $entity->type }}"/>
            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="code">
                    {{ trans('library.labels.code') }} <span class="text-danger">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="code" id="code" maxlength="10" autocomplete="off"
                         value="{{ $entity->code }}"
                         class="form-control col-md-7 col-sm-7 col-xs-12"/>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                    {{ trans('library.labels.name') }} <span class="text-danger">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="name" id="name" maxlength="100" autocomplete="off"
                        value="{{ $entity->name }}" 
                        class="form-control col-md-7 col-sm-7 col-xs-12"/>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                    {{ trans('library.labels.description') }}
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="description" id="description" maxlength="200" autocomplete="off"
                        value="{{ $entity->description }}" 
                        class="form-control col-md-7 col-sm-7 col-xs-12"/>
                </div>
            </div>

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="document">
                    {{ trans('library.labels.file') }} <span class="text-danger">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="file" name="document" id="document"
                            class="form-control col-md-7 col-sm-7 col-xs-12"/>
                </div>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.save') }}</button>
            </div>

        </form>
    </div>
</div>

<script>
    $(() => {

        let $form = $('#document_update_fm');

        $validateDefaults.rules = {
            document: {
                required: true,
                sizeFiles: true,
                extension: 'pdf'
            },
            type: {
                required: true
            },
            code: {
                required: true
            },           
            name: {
                required: true               
            }
        };

         // Delimitar el tamaño de los archivos
         jQuery.validator.addMethod("sizeFiles", (value, element) => {
            if ($(element).attr("type") === "file") {
                if (element.files && element.files.length) {
                    files = element.files;
                    let fileSize = 0;
                    $.each(files, function (index, element) {
                        fileSize += element.size;
                    });
                    return (parseInt(fileSize) <= {{ $Document::MAX_SIZE_UPLOAD }});
                }
            }
            return false;
        }, '{{ trans("library.messages.errors.size_file") }}: ' + '{{ $Document::STRING_MAX_SIZE_UPLOAD }}');

        $validateDefaults.messages = {
            name: {
                remote: '{{ trans('library.messages.validations.create_uniqueName') }}'
            },
            document: {
                extension: '{{ trans('library.messages.errors.only_pdf') }}'
            }
        };      


        $form.validate($.extend(false, $validateDefaults));

        let datatable = $('#library_tb').DataTable();

        $form.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                processResponse(response, null, () => {
                    $validateDefaults.rules = {};
                    $validateDefaults.messages = {};
                    $modal.modal('hide');
                    datatable.draw();
                });
            }
        }));
    });
</script>

@else
    @include('errors.403')
    @endpermission