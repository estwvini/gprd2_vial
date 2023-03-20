@permission('edit.shape.inventory_roads')
@inject('Shape', 'App\Models\Business\Roads\Shape')

<div class="modal-content" id="intersection_edit">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">
            <i class="fa fa-automobile"></i> {{ trans('shape.labels.edit') }}
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_content">
            <form role="form" action="{{ route('update.edit.shape.inventory_roads', ['gid' => $entity->gid]) }}"
                  method="post" class="form-horizontal form-label-left" id="shape_edit_fm">
                @csrf

                <input type="hidden" name="codigo" value="{{ $entity->codigo }}">

                <div class="item form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label class="align-center col-md-12 col-sm-12 col-xs-12">
                            {{ $entity->name }}
                        </label>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" for="shape">
                        {{ trans('shape.labels.shape') }}
                    </label>
                    <div class="col-md-4 col-sm-5 col-xs-12">
                        <input type="file" name="shape" id="shape"
                               class="form-control col-md-7 col-sm-7 col-xs-12"/>
                    </div>
                </div>

                <div class="ln_solid"></div>

                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <a class="btn btn-info ajaxify closeModal">
                        <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                    </button>
                </div>

            </form>
        </div>
    </div>

    <div class="modal-footer">
    </div>
</div>

<script>
    $(() => {

        $('.select2').select2({});

        let $form = $('#shape_edit_fm');

        $validateDefaults.rules = {
            shape: {
                required: true,
                sizeFiles: true,
                extension: 'geojson'
            }
        };

        $validateDefaults.messages = {
            'shape': {
                extension: '{{ trans('shape.messages.errors.only_json') }}'
            }
        }

        // Delimitar el tamaño de los archivos
        jQuery.validator.addMethod("sizeFiles", (value, element) => {
            if ($(element).attr("type") === "file") {
                if (element.files && element.files.length) {
                    files = element.files;
                    let fileSize = 0;
                    $.each(files, function (index, element) {
                        fileSize += element.size;
                    });
                    return (fileSize <= {{ $Shape::MAX_SIZE_UPLOAD }});
                }
            }
            return false;
        }, '{{ trans("shape.messages.errors.size_file") }}: ' + '{{ $Shape::STRING_MAX_SIZE_UPLOAD }}');

        $form.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                processResponse(response, null, () => {
                    $modal.modal('hide');
                });
            }
        }));

        $('.closeModal').on('click', (e) => {
            $modal.modal('hide');
        });
    });
</script>

@else
    @include('errors.403')
    @endpermission