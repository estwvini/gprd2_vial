@permission('structure.project.programmatic_structure.execution')
@inject('Role', '\App\Models\System\Role')
@inject('ProjectFiscalYear', '\App\Models\Business\Planning\ProjectFiscalYear')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('project_structure.title_singular') }}
            </h3>
        </div>
    </div>
    <div class="title_right hidden-xs">
        <ol class="breadcrumb pull-right mb-0">
            @permission('index.project.programmatic_structure.execution')
            <li>
                <a class="ajaxify" href="{{ route('index.project.programmatic_structure.execution') }}"> {{ trans('projects.title') }}</a>
            </li>
            @endpermission

            <li class="active"> {{ trans('project_structure.title_singular') }}</li>
        </ol>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 p-0">
        <h4>{{ trans('projects.labels.project') }}:
            <small>{{ $project->name }}</small>
        </h4>
    </div>

    <div class="clearfix"></div>

    <div class="title_right hidden-xs">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        @permission('profile.project.programmatic_structure.execution')
                        <a class="btn btn-xs btn-success ajaxify structure-action" id="profile"
                           href="{{ route('profile.project.programmatic_structure.execution', ['id' => $project->id]) }}" data-ajaxify="#view_area">
                            <i class="fa fa-dot-circle-o"></i> {{ trans('projects.labels.profile') }}
                        </a>
                        @endpermission

                        @permission('logic_frame.project.programmatic_structure.execution')
                        <a class="btn btn-xs btn-primary ajaxify structure-action" id="logic_frame"
                           href="{{ route('logic_frame.project.programmatic_structure.execution', ['id' => $project->id]) }}" data-ajaxify="#view_area">
                            <i class="fa fa-file-text"></i> {{ trans('projects.labels.logic_frame') }}
                        </a>
                        @endpermission

                        @permission('index.activities.project.programmatic_structure.execution')
                        <a class="btn btn-xs btn-primary structure-action" id="activities">
                            <i class="fa fa-puzzle-piece"></i> {{ trans('projects.labels.activities') }}
                        </a>
                        @endpermission
                        @if($projectFiscalYear->status != $ProjectFiscalYear::STATUS_IN_PROGRESS)
                            <a class="btn btn-warning pull-right" id="start"
                               href="#">
                                <i class="fa fa-play"></i> {{ trans('project_structure.labels.start') }}
                            </a>
                        @endif
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content" id="view_area">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        const showActivities = (projectId) => {
            let url = "{{ route('index.activities.project.programmatic_structure.execution', ['id' => '__PROJECTID__']) }}";
            url = url.replace('__PROJECTID__', projectId)

            pushRequest(url, "#view_area", () => {
                $('.structure-action').removeClass('btn-success btn-primary').addClass('btn-primary');
                $('#activities').removeClass('btn-success btn-primary').addClass('btn-success');
            }, 'GET', {});
        }

        $('.structure-action').on('click', (e) => {
            if ($(e.currentTarget).attr('id') != 'activities') {
                $('.structure-action').removeClass('btn-success btn-primary').addClass('btn-primary');
                $(e.currentTarget).removeClass('btn-success btn-primary').addClass('btn-success');
            }
        })

        $('#activities').on('click', (e) => {

            @if($projectFiscalYear->status != $ProjectFiscalYear::STATUS_IN_PROGRESS)
            pushRequest("{{ route('check_status.project.programmatic_structure.execution', ['id' => $projectFiscalYear->id]) }}", null, (response) => {
                if (response) {
                    confirmModal("{!! trans('project_structure.messages.confirm.reset_budget_items') !!}", () => {
                        pushRequest("{{ route('reset_budget_items.project.programmatic_structure.execution', ['id' => $projectFiscalYear->id]) }}", null, () => {
                            showActivities({{ $project->id }})
                        }, 'PUT', {
                            _token: '{{ csrf_token() }}'
                        });
                    })
                } else {
                    showActivities({{ $project->id }})
                }
            }, 'GET', {});
            @else
            showActivities({{ $project->id }})
            @endif

        })

        $('#profile').click();

        $('#start').on('click', () => {
            pushRequest("{{ route('check_status.project.programmatic_structure.execution', ['id' => $projectFiscalYear->id]) }}", null, (response) => {
                if (response) {
                    confirmModal("{!! trans('project_structure.messages.confirm.reset_budget_items_on_start') !!}", () => {
                        pushRequest("{{ route('reset_budget_items.project.programmatic_structure.execution', ['id' => $projectFiscalYear->id]) }}", null, () => {
                            pushRequest("{{ route('start.project.programmatic_structure.execution', ['id' => $projectFiscalYear->id]) }}", null, null,
                                'POST', {
                                    _token: '{{ csrf_token() }}'
                                });
                        }, 'PUT', {
                            _token: '{{ csrf_token() }}'
                        });
                    })
                } else {
                    confirmModal("{!! trans('project_structure.messages.confirm.start_project') !!}", () => {
                        pushRequest("{{ route('start.project.programmatic_structure.execution', ['id' => $projectFiscalYear->id]) }}", null, null,
                            'POST', {
                                _token: '{{ csrf_token() }}'
                            });
                    })
                }
            }, 'GET', {});
        })
    })
</script>

@else
    @include('errors.403')
    @endpermission