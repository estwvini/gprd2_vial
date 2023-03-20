@permission('physical_budgetary_advancement.budget.progress.project_tracking.execution')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('projects.title') }}
                <small>{{ trans('project_tracking.labels.progress') }}</small>
            </h3>
        </div>
    </div>
    <div class="title_right hidden-xs">
        <ol class="breadcrumb pull-right mb-0">
            @permission('index.project_tracking.execution')
            <li>
                <a class="ajaxify" href="{{ route('index.project_tracking.execution') }}"> {{ trans('project_tracking.title') }}</a>
            </li>
            @endpermission

            <li class="active"> {{ trans('project_tracking.labels.progress') }}</li>
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
                        <h2>
                            <a class="btn btn-xs btn-success ajaxify" id="physical_progress"
                               href="{{ route('index.physical.progress.project_tracking.execution', ['id' => $projectId]) }}" data-ajaxify="#view_area">
                                <i class="fa fa-line-chart"></i> {{ trans('project_tracking.labels.physical_progress') }}
                            </a>
                            @if(api_available())
                                <a class="btn btn-xs btn-primary ajaxify progress-action" id="budget_progress"
                                   href="{{ route('budget.progress.project_tracking.execution', ['id' => $projectId]) }}" data-ajaxify="#view_area">
                                    <i class="fa fa-bar-chart"></i> {{ trans('project_tracking.labels.budget_progress') }}
                                </a>
                                <a class="btn btn-xs btn-primary ajaxify progress-action" id="certifications"
                                   href="{{ route('index.projects.certifications.execution', ['id' => $projectId]) }}" data-ajaxify="#view_area">
                                    <i class="fa fa-certificate"></i> {{ trans('project_tracking.labels.certifications') }}
                                </a>
                            @endif
                        </h2>

                        <ul class="nav navbar-right panel_toolbox">
                            @permission('index.project_tracking.execution')
                            <li class="pull-right">
                                <a href="{{ route('index.project_tracking.execution') }}" class="btn btn-box-tool ajaxify">
                                    <i class="fa fa-times"></i>
                                </a>
                            </li>
                            @endpermission
                        </ul>
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

        $('#physical_help, #budget_help').hide()

        $('#physical_progress').on('click', (e) => {
            $(e.currentTarget).removeClass('btn-success btn-primary').addClass('btn-success');
            $('#budget_progress').removeClass('btn-success btn-primary').addClass('btn-primary');
            $('#certifications').removeClass('btn-success btn-primary').addClass('btn-primary');
            $('#physical_help').show()
            $('#budget_help').hide()
        });
        $('#budget_progress').on('click', (e) => {
            $(e.currentTarget).removeClass('btn-success btn-primary').addClass('btn-success');
            $('#physical_progress').removeClass('btn-success btn-primary').addClass('btn-primary');
            $('#certifications').removeClass('btn-success btn-primary').addClass('btn-primary');
            $('#budget_help').show()
            $('#physical_help').hide()
        });
        $('#certifications').on('click', (e) => {
            $(e.currentTarget).removeClass('btn-success btn-primary').addClass('btn-success');
            $('#physical_progress').removeClass('btn-success btn-primary').addClass('btn-primary');
            $('#budget_progress').removeClass('btn-success btn-primary').addClass('btn-primary');
            $('#budget_help').hide()
            $('#physical_help').hide()
        });

        $('#physical_progress').click();
    })
</script>

@else
    @include('errors.403')
    @endpermission
