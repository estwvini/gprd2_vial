@permission('index.physical.progress.project_tracking.execution')

@inject('Activity', '\App\Models\Business\Planning\ActivityProjectFiscalYear')
@inject('Task', '\App\Models\Business\Task')
@inject('ProjectFiscalYear', '\App\Models\Business\Planning\ProjectFiscalYear')

<div class="row header-schedule">
    <div class="col-md-6 col-sm-6 col-xs-6">
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
    <div class="col-md-6 col-sm-6 col-xs-6 text-center">
        <div class="col-md-6 col-sm-6 col-xs-6 mt-4">
            <div class="col-md-12 col-sm-12 col-xs-12 div-flex">
                <div class="p-1 div-child-flex">
                    <h1 class="m-0">{{ $projectProgress }} %</h1>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 mt-3">
                <h4>{{ trans('physical_progress.labels.currentProgress') }}</h4>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-6 mt-4">
            <div class="col-md-12 col-sm-12 col-xs-12 div-flex">
                <div class="pull-left p-1 div-child-flex">
                    <div class="circle_big bg_red @if($semaphore === $ProjectFiscalYear::SEMAPHORE['DELAYED']) o-1 @else o-02 @endif" data-toggle="tooltip" data-placement="top"
                         data-original-title="{{ trans('physical_progress.labels.delayed') }}"></div>
                </div>
                <div class="pull-left p-1 div-child-flex">
                    <div class="circle_big bg_orange @if($semaphore === $ProjectFiscalYear::SEMAPHORE['AT_RISK']) o-1 @else o-02 @endif" data-toggle="tooltip" data-placement="top"
                         data-original-title="{{ trans('physical_progress.labels.atRisk') }}"></div>
                </div>
                <div class="pull-left p-1 div-child-flex">
                    <div class="circle_big bg_green @if($semaphore === $ProjectFiscalYear::SEMAPHORE['ONGOING']) o-1 @else o-02 @endif" data-toggle="tooltip" data-placement="top"
                         data-original-title="{{ trans('physical_progress.labels.ongoing') }}"></div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 mt-3">
                <h4>{{ trans('physical_progress.labels.currentStatus') }}</h4>
            </div>
        </div>
    </div>
</div>
<div class="row vertical-align-end">
    <div class="form-group col-md-2">
        <label class="control-label" for="status">
            {{ trans('physical_progress.labels.activity') }}
        </label>
        <input type="text" class="form-control  readonly-white" id="activity" value="{{ $filters['activity'] }}">
    </div>

    <div class="form-group col-md-2">
        <label class="control-label" for="status">
            {{ trans('physical_progress.labels.status') }}
        </label>
        <select class="form-control" id="status">
            <option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>
            <option value="white" @if($filters['state'] == 'white' ) selected @endif>{{ trans('physical_progress.labels.PENDING') }}</option>
            <option value="{{ \App\Models\Business\Planning\ActivityProjectFiscalYear::SEMAPHORE['DELAYED'] }}"
                    @if($filters['state'] == \App\Models\Business\Planning\ActivityProjectFiscalYear::SEMAPHORE['DELAYED'] ) selected @endif>{{ trans('physical_progress.labels.delayed') }}</option>
            <option value="{{ \App\Models\Business\Planning\ActivityProjectFiscalYear::SEMAPHORE['AT_RISK'] }}"
                    @if($filters['state'] == \App\Models\Business\Planning\ActivityProjectFiscalYear::SEMAPHORE['AT_RISK'] ) selected @endif>{{ trans('physical_progress.labels.atRisk') }}</option>
            <option value="{{ \App\Models\Business\Planning\ActivityProjectFiscalYear::SEMAPHORE['ONGOING'] }}"
                    @if($filters['state'] == \App\Models\Business\Planning\ActivityProjectFiscalYear::SEMAPHORE['ONGOING'] ) selected @endif>{{ trans('physical_progress.labels.COMPLETED_ONTIME') }}</option>
        </select>
    </div>

    <div class="form-group has-feedback col-md-2">
        <label class="control-label" for="date_from">
            {{ trans('physical_progress.labels.from') }}
        </label>
        <input name="date_from" id="date_from" value="{{ $filters['dateFrom'] }}"
               class="form-control has-feedback-left readonly-white picker"
               placeholder=" YYYY-MM-DD" autocomplete="off" readonly/>
        <span class="fa fa-calendar form-control-feedback left mt-2 color-blue" aria-hidden="true"></span>
    </div>

    <div class="form-group has-feedback col-md-2">
        <label class="control-label" for="date_to">
            {{ trans('physical_progress.labels.to') }}
        </label>
        <input name="date_init" id="date_to" {{ $filters['dateTo'] }}
        class="form-control has-feedback-left readonly-white picker"
               placeholder=" YYYY-MM-DD" autocomplete="off" readonly/>
        <span class="fa fa-calendar form-control-feedback left mt-2 color-blue" aria-hidden="true"></span>
    </div>
    <button type="button" class="btn btn-primary mb-3" id="search_act"> {{ trans('app.labels.search') }}</button>
    <button type="button" class="btn btn-default btn-outline mb-3 ml-2" id="clear"> {{ trans('app.labels.clear') }}</button>
    <div>
        <button id="export_excel" class="btn btn-primary mb-3 ml-2">
            <i class="fa fa-file-excel-o"></i>
            {{ trans('reports.export.excel') }}
        </button>
    </div>

</div>
@if($projectSchedule->count())
    <table class="schedule-table" id="schedule_tb">
        <thead id="tableHead">
        <tr>
            <th width="22%" style="text-align: inherit">
                <i class="glyphicon glyphicon-chevron-right arrow_right_all mr-1" role="button"></i>
                <i class="glyphicon glyphicon-chevron-down arrow_down_all mr-1" role="button"></i>
                {{ trans('physical_progress.labels.task') }}
            </th>
            <th width="9%">{{ trans('physical_progress.labels.encoded') }}</th>
            <th width="12%">{{ trans('physical_progress.labels.startDate') }}</th>
            <th width="12%">{{ trans('physical_progress.labels.endDate') }}</th>
            <th width="12%">{{ trans('physical_progress.labels.dueDate') }}</th>
            <th width="12%">{{ trans('physical_progress.labels.attachmentDate') }}</th>
            <th width="1%">{{ trans('physical_progress.labels.weight') }}</th>
            <th width="9%">{{ trans('physical_progress.labels.progress') }}</th>
            <th width="1%">{{ trans('physical_progress.labels.semaphore') }}</th>
            <th width="10%">{{ trans('app.labels.actions') }}</th>
        </tr>
        </thead>

        <tbody id="tableBody">

        @foreach($projectSchedule as $component)
            @if(isset($component['children']) && $component['children']->count())
                @include('business.tracking.projects.physical.loadComponent', ['element' => $component])
            @endif

            @if(isset($component['children']) && $component['children']->count())
                @foreach($component['children'] as $activity)
                    @include('business.tracking.projects.physical.loadActivity', ['element' => $activity])

                    @if(isset($activity['children']) && $activity['children']->count())
                        @foreach($activity['children'] as $task)
                            @include('business.tracking.projects.physical.loadTask', ['element' => $task, 'project' => $project, 'currentUser' => $currentUser])
                        @endforeach
                    @endif
                @endforeach
            @endif
        @endforeach

        </tbody>
    </table>
@else
    <div class="alert alert-warning align-center" role="alert">
        {{ trans('physical_progress.messages.warning.no_info_schedule') }}
    </div>
@endif

@else
    @include('errors.403')
    @endpermission


    <script>
        $(() => {
            $('#date_from, #date_to').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'es-es',
                useCurrent: false,
                ignoreReadonly: true
            });

            $('#date_from').on('dp.change', (e) => {
                $('#date_to').data('DateTimePicker').minDate(e.date);
            });

            $('#date_to').on('dp.change', (e) => {
                $('#date_from').data('DateTimePicker').maxDate(e.date)
            });

            $("#search_act").click(function () {
                search();
            });

            $("#clear").click(function () {
                $("#date_from").val('');
                $("#date_to").val('');
                $("#status").val('');
                $("#activity").val('');
                search();
            });

            function search() {
                pushRequest(`{{ route('load_table.physical.progress.project_tracking.execution') }}`, '#physical_progress_table', () => {
                    $('#load_quarterly').val(1)
                    $('#load_gantt').val(1)
                }, 'GET', {
                    'project_id': '{{ $project->id }}',
                    'dateFrom': $("#date_from").val(),
                    'dateTo': $("#date_to").val(),
                    'state': $("#status").val(),
                    'activity': $("#activity").val()
                }, false);
            }


            /**
             * Agrega los eventos y acciones para contraer o expandir componentes
             */
            let addArrowEvents = () => {

                // Arrow buttons events
                $(`.arrow_down_all`).on('click', (e) => {
                    $(e.currentTarget).hide();
                    $(e.currentTarget).siblings('.arrow_right_all').show();

                    $(`tr[parent_row='component']`).each((index, element) => {
                        $(element).find('.arrow_down').hide()
                        $(element).find('.arrow_right').show()
                        closeChildren($(element).attr('id'));
                    });
                });

                $(`.arrow_right_all`).on('click', (e) => {
                    $(e.currentTarget).hide();
                    $(e.currentTarget).siblings('.arrow_down_all').show();

                    $(`tr[parent_row='component']`).each((index, element) => {
                        $(element).find('.arrow_down').show()
                        $(element).find('.arrow_right').hide()
                        openChildren($(element).attr('id'));
                    });
                });

            }

            const closeChildren = (id) => {
                $(`tr[parent_row='${id}']`).each((index, element) => {

                    $(element).find('.arrow_down').hide()
                    $(element).find('.arrow_right').show()
                    $(element).hide()

                    closeChildren($(element).attr('id'))
                })
            }

            const openChildren = (id) => {
                $(`tr[parent_row='${id}']`).each((index, element) => {
                    $(element).find('.arrow_down').show()
                    $(element).find('.arrow_right').hide()
                    $(element).show();
                    openChildren($(element).attr('id'));
                })
            }

            $('.arrow_right_all').hide();
            addArrowEvents();

            $('#export_excel').on('click', (e) => {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('export.physical.progress.project_tracking.execution') }}',
                    method: 'GET',
                    xhrFields: {
                        responseType: 'blob'
                    },
                    data: {
                        'project_id': '{{ $project->id }}',
                        'dateFrom': $("#date_from").val(),
                        'dateTo': $("#date_to").val(),
                        'state': $("#status").val(),
                        'activity': $("#activity").val()
                    },
                    beforeSend: () => {
                        showLoading();
                    },
                    success: (response) => {
                        let a = document.createElement('a');
                        let url = window.URL.createObjectURL(response);
                        a.href = url;
                        a.download = '{{ trans('physical_progress.title') }}';
                        document.body.append(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);
                    }
                }).always(() => {
                    hideLoading();
                }).fail(function() {
                    hideLoading();
                });
            });
        })
    </script>