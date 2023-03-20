@permission('index.admin_activities.execution')

<div>
    <div class="page-title">
        <div class="col-md-11 col-sm-11 col-xs-11">
            <h3>{{ trans('admin_activities.title') }}
            </h3>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">

                    <!-- Nav tabs -->
                    <ul class="md nav nav-tabs" role="tablist" style="display: inline-block" id="my-tabs">
                        <li role="presentation" class="active">
                            <a href="#table" aria-controls="table" role="tab" data-toggle="tab">{{ trans('admin_activities.labels.list') }}</a>
                        </li>
                        <li role="presentation">
                            <a href="#calendar-view" aria-controls="calendar" role="tab" data-toggle="tab">{{ trans('admin_activities.labels.calendar') }}</a>
                        </li>
                        <li role="presentation">
                            <a href="#graphic" aria-controls="graphic" role="tab" data-toggle="tab">{{ trans('admin_activities.labels.graphic') }}</a>
                        </li>
                    </ul>

                    @permission('create.admin_activities.execution')
                    <ul class="nav navbar-right panel_toolbox">
                        <li class="pull-right">
                            <a href="{{ route('create.admin_activities.execution') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-plus"></i> {{ trans('admin_activities.labels.create') }}
                            </a>
                        </li>
                    </ul>
                    @endpermission

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="table">
                            @include('business.execution.admin_activities.table')
                        </div>
                        <div role="tabpanel" class="tab-pane" id="calendar-view">
                            @include('business.execution.admin_activities.calendar')
                        </div>
                        <div role="tabpanel" class="tab-pane" id="graphic">
                            @include('business.execution.admin_activities.graphic')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="admin-act-delete" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-st">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-trash text-danger"></i> {{ trans('admin_activities.labels.delete') }}</h4>
            </div>
            <div class="modal-body">
                {{ trans('admin_activities.messages.confirm.delete') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('app.labels.cancel') }}</button>
                <button data-href="" id="act-delete" class="btn btn-danger" data-dismiss="modal">{{ trans('app.labels.delete') }}</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        $('#admin-act-delete').on('show.bs.modal', (event) => {
            let button = $(event.relatedTarget)
            let id = button.data('id')
            let url = "{{ route('delete.admin_activities.execution', ['adminActivity' => '__ID__']) }}";
            url = url.replace('__ID__', id)
            $('#act-delete').data('href', url)
        })

        $('#act-delete').on('click', (e) => {
            e.preventDefault();
            pushRequest($('#act-delete').data('href'), null, () => {
                let activities_tb = $('#activities_tb').DataTable();
                activities_tb.draw();
            }, 'delete', {_token: '{{ csrf_token() }}',})
        })
    });
</script>

@else
    @include('errors.403')
    @endpermission