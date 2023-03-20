@permission('load_gantt_show.schedule.projects_review.plans_management')

<div id="gantt_chart"></div>

@if(!$ganttStructure)
    <div class="alert alert-warning align-center" role="alert">
        {{ trans('schedule.messages.warning.no_info_gantt') }}
    </div>
@endif

<script>
    $(() => {
        @if($ganttStructure)

        let g = new JSGantt.GanttChart(document.getElementById('gantt_chart'), 'day');

        g.setOptions({
            vCaptionType: 'Complete',  // Set to Show Caption : None,Caption,Resource,Duration,Complete,
            vQuarterColWidth: 36,
            vDateTaskDisplayFormat: 'day dd month yyyy', // Shown in tool tip box
            vDayMajorDateDisplayFormat: 'mon yyyy - Week ww',// Set format to dates in the "Major" header of the "Day" view
            vWeekMinorDateDisplayFormat: 'dd mon', // Set format to display dates in the "Minor" header of the "Week" view
            vLang: 'es',
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