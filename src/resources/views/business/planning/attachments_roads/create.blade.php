@permission('create_roads.attachments.projects.plans_management')
@inject('Project', '\App\Models\Business\Project')

<div id="myModal" class="modal-content">
    <div class="modal-header pb-0">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-paperclip"></i> {{ trans('attachments_roads.title') }}
        </h4>
        <div class="item form-group col-md-12 col-sm-12 col-xs-12">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">
                <h5 class="h5-subtitle">{{ trans('projects.labels.project') }}: <span class="h5-subtitle">{{ $project->cup }} - {{ $project->name }}</span></h5>
            </label>
        </div>
    </div>

    <div class="mt-5 mb-4 ml-5 mr-4">
        <form role="form" action="{{ route('store.create_roads.attachments.projects.plans_management', ['project_id' => $project->id]) }}" method="post"
              class="form-horizontal form-label-left" id="attachments_create_fm">

            @method('POST')
            @csrf

            <div id="dynamic_files">
                @include('business.planning.attachments_roads.partial.inputs')
            </div>

            <div class="ln_solid"></div>
            <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                <button type="button" class="btn btn-info" data-dismiss="modal">
                    <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                </button>
                <button id="submit_attachments" class="btn btn-success" style="display: none;">
                    <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    $(() => {
        let attachmentsForm = $('#attachments_create_fm');
        let submitAttachments = $('#submit_attachments');
        let datatable = $('#projects_tb').DataTable();

        // Initialize submit button
        submitAttachments.on('click', (e) => {
            e.preventDefault();

            if (attachmentsForm.valid()) {
                let url = '{!! route('store.create_roads.attachments.projects.plans_management', ['project_id' => $project->id]) !!}';
                let formData = new FormData(attachmentsForm[0]);

                pushRequest(url, null, () => {
                    datatable.draw();
                    $modal.modal('hide');
                }, 'POST', formData, false, {form: true})
            }
        });

        /**
         * Inicializa los elementos de la vista y sus acciones.
         */
        const initializeElements = () => {

            // Initialize change event for file inputs
            $('input[type=file]').each((index, element) => {
                $(element).change((e) => {
                    enableSubmitButton();
                })
            });

            // Initialize delete buttons
            $('span.input-group-addon.remove-file').on('click', (e) => {
                let url = "{!! route('destroy_roads.attachments.projects.plans_management', ['id' => '__ID__']) !!}";
                url = url.replace('__ID__', $(e.currentTarget).attr('data-project'));

                pushRequest(url, '#dynamic_files', () => {
                    datatable.draw();
                    initializeElements();
                    enableSubmitButton();
                }, 'DELETE', {
                    _token: '{{ csrf_token() }}',
                    fileId: $(e.currentTarget).attr('data-file'),
                    project_id: '{{ $project->id }}'
                });

                $(e.currentTarget).unbind('click')
            });

            @if($project->is_road)
            // Initialize form validation
            attachmentsForm.validate($.extend(false, $validateDefaults, {}));

            $('input[type=file]').each((index, element) => {
                $(element).rules('add', {
                    required: true
                });
            });

            attachmentsForm.ajaxForm($.extend(false, $formAjaxDefaults, {}));
            @endif
        };

        /**
         * Verificar si algún archivo ha sido subido para habilitar el botón de guardar
         */
        const enableSubmitButton = () => {
            let inputsUpdated = false;

            $('input[type=file]').each((index, element) => {
                if ($(element).val()) {
                    inputsUpdated = true;
                    return false
                }
            });

            if (inputsUpdated) {
                submitAttachments.show();
            } else {
                submitAttachments.hide();
            }
        };

        initializeElements();
        enableSubmitButton();
    })
</script>

@else
    @include('errors.403')
    @endpermission