@permission('index.physical.progress.project_tracking.execution')

<div>
    <input type="hidden" id="load_gantt" value="1">
    <input type="hidden" id="load_quarterly" value="1">

    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a id="tab_physical_progress" role="tab" data-toggle="tab" href="#panel_physical_progress" aria-controls="panel_physical_progress">
                {{ trans('physical_progress.labels.schedule') }}
            </a>
        </li>
        <li class="nav-item">
            <a id="tab_gantt_progress" role="tab" data-toggle="tab" href="#panel_gantt_progress" aria-controls="panel_gantt_progress">
                {{ trans('physical_progress.labels.ganttProgress') }}
            </a>
        </li>
        @if($isLeader || $currentUser->isSuperAdmin())
            <li class="nav-item">
                <a id="tab_quarterly_progress" role="tab" data-toggle="tab" href="#panel_quarterly_progress" aria-controls="panel_quarterly_progress">
                    {{ trans('physical_progress.labels.quarterlyProgress') }}
                </a>
            </li>
        @endif
    </ul>
    <div class="tab-content">
        <div class="x_content tab-pane active" role="tabpanel" id="panel_physical_progress">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                <i class="fa fa-tasks"></i> {{ trans('physical_progress.labels.schedule') . ' - ' . trans('physical_progress.labels.fiscalYear') . ': ' . $fiscal_year}}
                            </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <div id="physical_progress_table"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="x_content tab-pane" role="tabpanel" id="panel_gantt_progress">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                <i class="fa fa-tasks"></i> {{ trans('physical_progress.labels.ganttProgress') . ' - ' . trans('physical_progress.labels.fiscalYear') . ': ' . $fiscal_year}}
                            </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div id="gantt_progress_container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($isLeader || $currentUser->isSuperAdmin())
            <div class="x_content tab-pane" role="tabpanel" id="panel_quarterly_progress">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>
                                    <i class="fa fa-tasks"></i> {{ trans('physical_progress.labels.quarterlyProgress') . ' - ' . trans('physical_progress.labels.fiscalYear') . ': ' . $fiscal_year}}
                                </h2>

                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div id="quarterly_progress_container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    $(() => {
        pushRequest(`{{ route('load_table.physical.progress.project_tracking.execution') }}`, '#physical_progress_table', null, 'get', {
            'project_id': '{{ $project->id }}',
        }, false);

        $('#tab_gantt_progress').on('click', () => {
            if (!$('#panel_gantt_progress').hasClass('active')) {
                if ($('#load_gantt').val() == 1) {
                    pushRequest(`{{ route('load_gantt.physical.progress.project_tracking.execution') }}`, '#gantt_progress_container', () => {
                        $('#load_gantt').val(0)
                    }, 'get', {
                        'project_id': '{{ $project->id }}',
                    }, false);
                }
            }
        });

        @if($isLeader || $currentUser->isSuperAdmin())
        $('#tab_quarterly_progress').on('click', () => {
            if (!$('#panel_quarterly_progress').hasClass('active')) {
                if ($('#load_quarterly').val() == 1) {
                    pushRequest(`{{ route('load_quarterly_progress.physical.progress.project_tracking.execution') }}`, '#quarterly_progress_container', () => {
                        $('#load_quarterly').val(0)
                    }, 'get', {
                        'project_id': '{{ $project->id }}',
                    }, false);
                }
            }
        });
        @endif

    });
</script>

@else
    @include('errors.403')
    @endpermission