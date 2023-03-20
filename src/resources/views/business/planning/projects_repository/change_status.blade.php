@permission('change_status.projects_repository.plans_management')
@inject('Project', '\App\Models\Business\Project')

<div id="myModal" class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="glyphicon glyphicon-pencil"></i> {{ trans('projects_repository.labels.update_status') }}
        </h4>
    </div>

    <div class="mt-5">
        <form role="form" action="" method="post"
              class="form-horizontal form-label-left" id="change_project_status_fm">

            @csrf

            <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">
                    {{ trans('projects_repository.labels.status') }} <span class="text-danger">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control select2" id="status" name="status" required>
                        <option value=""></option>
                        @foreach($status as $option)
                            <option value="{{ $option }}">{{ trans('projects.status.' . strtolower($option)) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
                <button id='btnSave' type="button" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.save') }}</button>
            </div>

        </form>
    </div>
</div>

<script>
    $(() => {

        $('#status').select2({
            placeholder: '{{ trans('projects_repository.placeholder.status') }}',
            dropdownParent: $("#myModal")
        });

        let $form = $('#change_project_status_fm');

        let validator = $form.validate($.extend(false, $validateDefaults));

        $('#status').on('change', (e) => {
            validator.element(e.currentTarget);
        });

        let datatable = $('#projects_repository_tb').DataTable();

        let route = '{!! route('update.change_status.projects_repository.plans_management', ['id' => $id]) !!}';
        $('#btnSave').on('click', () => {
            if ($form.valid()) {
                confirmModal('{{ trans('projects_repository.confirm.change_status') }}', () => {
                    pushRequest(route, null, () => {
                        $modal.modal('hide');
                        datatable.draw();
                    }, 'PUT', {
                        '_token': '{!! csrf_token() !!}',
                        'status': $('#status').val()
                    }, false)
                })
            }
        })
    });
</script>

@else
    @include('errors.403')
    @endpermission