@permission('index_show.schedule.projects_review.plans_management')
@inject('ProjectFiscalYear', 'App\Models\Business\Planning\ProjectFiscalYear')
<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('schedule.title') }}</h3>
        </div>
    </div>
    <div class="title_right hidden-xs">
        <ol class="breadcrumb pull-right mb-0">
            @permission('index_show.schedule.projects_review.plans_management')
            <li>
                @if($entity_status == $ProjectFiscalYear::STATUS_REVIEWED)
                    @permission('index.projects.plans_management')
                    <a class="ajaxify" href="{{ route('index.projects.plans_management') }}"> {{ trans('projects.title') }}</a>
                    @endpermission
                @else
                    @permission('index.projects_review.plans_management')
                    <a class="ajaxify" href="{{ route('index.projects_review.plans_management') }}"> {{ trans('projects.title') }}</a>
                    @endpermission
                @endif
            </li>
            @endpermission

            <li class="active"> {{ trans('schedule.title') }}</li>
        </ol>
    </div>
    <div class="item form-group col-md-12 col-sm-12 col-xs-12">
        <label class="control-label col-md-12 col-sm-12 col-xs-12">
            <h5 class="h5-subtitle">{{ trans('projects.labels.project') }}: <span class="h5-subtitle">{{ $project->cup }} - {{ $project->name }}</span></h5>
        </label>
    </div>

    <div class="clearfix"></div>

    <input type="hidden" id="load_gantt" value="1">

    <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
        <li class="nav-item active">
            <a id="tab_schedule" role="tab" data-toggle="tab" href="#panel_schedule" aria-controls="panel_schedule">
                {{ trans('schedule.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a id="tab_gantt" role="tab" data-toggle="tab" href="#panel_gantt" aria-controls="panel_gantt">
                {{ trans('schedule.labels.gantt') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="x_content tab-pane active" role="tabpanel" id="panel_schedule">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                <i class="fa fa-tasks"></i> {{ trans('schedule.title') . ' - ' . trans('schedule.labels.fiscalYear') . ': ' . $fiscal_year }}
                            </h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row header-schedule">
                                <div class="col-md-6">
                                    <table class="table table-bordered detail-table">
                                        <tbody>
                                        <tr>
                                            <td class="w-25">{{ trans('projects.labels.project') }}</td>
                                            <td colspan="2">{{ $project->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="w-25">{{ trans('projects.labels.init_date') }}</td>
                                            <td colspan="2">{{ $project->date_init }}</td>
                                        </tr>
                                        <tr>
                                            <td class="w-25">{{ trans('projects.labels.end_date') }}</td>
                                            <td colspan="2">{{ $project->date_end }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div id="schedule_table"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="x_content tab-pane" role="tabpanel" id="panel_gantt">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>
                                <i class="fa fa-tasks"></i> {{ trans('schedule.labels.gantt') . ' - ' . trans('schedule.labels.fiscalYear') . ': ' . $fiscal_year }}
                            </h2>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div id="gantt_chart_container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {
        pushRequest(`{{ route('load_table_show.schedule.projects_review.plans_management') }}`, '#schedule_table', null, 'get', {
            'project_id': '{{ $project->id }}',
        }, false);

        $('#tab_gantt').on('click', () => {
            if (!$('#panel_gantt').hasClass('active')) {
                if ($('#load_gantt').val() == 1) {
                    pushRequest(`{{ route('load_gantt_show.schedule.projects_review.plans_management') }}`, '#gantt_chart_container', () => {
                        $('#load_gantt').val(0)
                    }, 'get', {
                        'project_id': '{{ $project->id }}',
                    }, false);
                }
            }
        })
    });
</script>

@else
    @include('errors.403')
    @endpermission