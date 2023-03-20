@permission('load_gantt.physical.progress.project_tracking.execution')

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

<div id="gantt_chart"></div>

@if(!$ganttStructure)
    <div class="alert alert-warning align-center" role="alert">
        {{ trans('physical_progress.messages.warning.no_info_gantt') }}
    </div>
@endif

<script>
    $(() => {
        @if($ganttStructure)

        let g = new JSGantt.GanttChart(document.getElementById('gantt_chart'), 'day');

        g.addLang('es2', $jsgantt_es);

        g.setOptions({
            vCaptionType: 'Complete',  // Set to Show Caption : None,Caption,Resource,Duration,Complete,
            vQuarterColWidth: 36,
            vDateTaskDisplayFormat: 'day dd month yyyy', // Shown in tool tip box
            vDayMajorDateDisplayFormat: 'mon yyyy - Week ww',// Set format to dates in the "Major" header of the "Day" view
            vWeekMinorDateDisplayFormat: 'dd mon', // Set format to display dates in the "Minor" header of the "Week" view
            vLang: 'es2',
            vAdditionalHeaders: { // Add data columns to your table
                encoded: {
                    title: '{{ trans('physical_progress.labels.encoded') }}'
                }
            },
            vShowTaskInfoLink: 1, // Show link in tool tip (0/1)
            vShowEndWeekDate: 0,  // Show/Hide the date for the last day of the week in header for daily
            vUseSingleCell: 10000, // Set the threshold cell per table row (Helps performance for large data.
            vFormatArr: ['Day', 'Week', 'Month', 'Quarter'], // Even with setUseSingleCell using Hour format on such a large chart can cause issues in some browsers,
        });

        g.setShowTaskInfoNotes(0)
        g.setShowComp(0)
        g.setFormatArr('Day')
        g.setShowTaskInfoComp(0)

        let gantt = '{!! $ganttStructure !!}'

        gantt = $.parseJSON(gantt.replace(/\n/g, "\\\\n").replace(/\r/g, "\\\\r").replace(/\t/g, "\\\\t"))

        if (gantt.length) {
            gantt.forEach((element) => {
                g.AddTaskItemObject(element)
            })
        }

        g.Draw();

        /**
         * Ajusta el ancho del gráfico
         */
        let changeChartWidth = () => {
            let width = $('#gantt_chart').width()

            if (width <= 1050) {
                $('.glistlbl, .gtasktableh').css('width', 'auto !important')
            } else {
                $('.glistlbl, .gtasktableh').css('width', '100% !important')
            }
        }

        changeChartWidth()
        /**
         * Ajusta tamaño de los componentes cuando se redimensiona la pantalla
         */
        $(window).resize(() => {
            changeChartWidth()
        })

        @endif
    });
</script>

@else
    @include('errors.403')
    @endpermission