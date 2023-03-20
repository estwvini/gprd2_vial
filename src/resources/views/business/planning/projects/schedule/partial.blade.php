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
                            <i class="fa fa-tasks"></i> {{ trans('schedule.title') . ' - ' . trans('schedule.labels.fiscalYear') . ': ' . $fiscal_year}}
                        </h2>
                        <div class="text-right pull-right d-flex">
                            @if(isset($replicate) && $replicate)
                                <a href="{{ route('replicate.index.schedule.projects.plans_management', ['projectFiscalYear' => $projectFiscalYear->id]) }}"
                                   class="btn btn-default ajaxify">
                                    <i class="fa fa-copy"></i> {{ trans('schedule.labels.replicate') }}</a>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row header-schedule">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel well-lg">
                                            <b>{{ trans('projects.labels.project') }}
                                                : </b>{{ $project->name }}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="date_init">
                                            {{ trans('projects.labels.init_date') }}
                                        </label>
                                        <div class="input-group mb-0">
                                            <input type="text" class="form-control picker @if(isset($projectDates) and $projectDates['date_init']) readonly-white @endif"
                                                   id="date_init"
                                                   autocomplete="off" readonly value="{{ $project->date_init }}">
                                            <span class="input-group-addon clear-selection">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="date_end">
                                            {{ trans('projects.labels.end_date') }}
                                        </label>
                                        <div class="input-group mb-0">
                                            <input type="text" class="form-control picker @if(isset($projectDates) and $projectDates['date_end']) readonly-white @endif"
                                                   id="date_end"
                                                   autocomplete="off" readonly value="{{ $project->date_end }}">
                                            <span class="input-group-addon clear-selection">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @if(isset($projectDates) and ($projectDates['date_init'] or $projectDates['date_end']))
                                    <button id="btn-update-dates" class="btn btn-success">{{ trans('projects.labels.update_project_dates') }}</button>
                                @endif
                            </div>

                            @if(currentUser()->can($urlLoadTable))
                                @if(currentUser()->can($urlStoreSchedule))
                                    <a id="addTask" project_id="{{ $project->id }}" class="ajaxify btn btn-success add-task-absolute">
                                        <i class="fa fa-plus"></i> {{ trans('schedule.labels.create') }}
                                    </a>
                                @endif
                            @endif
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
                            <i class="fa fa-tasks"></i> {{ trans('schedule.labels.gantt') . ' - ' . trans('schedule.labels.fiscalYear') . ': ' . $fiscal_year}}
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

<script>
    $(() => {
        pushRequest('{{ route($urlLoadTable) }}', '#schedule_table', null, 'get', {
            'project_id': '{{ $project->id }}',
        }, false);

        $('#tab_gantt').on('click', () => {
            if (!$('#panel_gantt').hasClass('active')) {
                if ($('#load_gantt').val() == 1) {
                    pushRequest('{{ route($urlLoadGantt) }}', '#gantt_chart_container', () => {
                        $('#load_gantt').val(0)
                    }, 'get', {
                        'project_id': '{{ $project->id }}',
                    }, false);
                }
            }
        });


        /**
         * Detecta scroll de la pantalla para fijar los elementos en la pantalla
         */
        $(window).scroll(() => {
            let scroll = $(window).scrollTop()
            if (scroll > 355) {
                $('#addTask').addClass('add-task-fixed')
                $('#addTask').removeClass('add-task-absolute')
            } else {
                $('#addTask').removeClass('add-task-fixed')
                $('#addTask').addClass('add-task-absolute')
            }
        });

        @if(isset($projectDates))
        $('.picker.readonly-white').datetimepicker({
            format: 'DD-MM-YYYY',
            locale: 'es-es',
            ignoreReadonly: true,
            minDate: moment('01-01-{{ $fiscal_year }}', 'DD-MM-YYYY'),
            maxDate: moment('31-12-{{ $fiscal_year }}', 'DD-MM-YYYY')
        });

        $('.input-group').each((index, element) => {
            let input = $(element).find('input.picker.readonly-white');
            $(element).find('span.input-group-addon').on('click', () => {
                input.datetimepicker('show');
            })
        });

        $('#btn-update-dates').on('click', () => {
            pushRequest('{!! route('update_dates.schedule.project.reprogramming.reforms_reprogramming.execution') !!}', null, () => {
                pushRequest('{{ route($urlLoadTable) }}', '#schedule_table', null, 'get', {
                    'project_id': '{{ $project->id }}',
                }, false);
            }, 'put', {
                _token: '{{ csrf_token() }}',
                projectFiscalYearId: '{{ $projectFiscalYear->id }}',
                date_init: $('#date_init').val(),
                date_end: $('#date_end').val()
            }, false);
        });
        @endif

    });
</script>
