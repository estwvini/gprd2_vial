<div id="calendar"></div>

<script>
    $(() => {

        let calendar = $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month'
            },
            selectable: true,
            selectHelper: true,
            editable: false,
            eventColor: '#3788d8',
            eventLimit: true,
            height: 700,
            select: function (start, end, allDay) {
                pushRequest('{{ route('create.admin_activities.execution') }}', null, () => {
                    $('#date_init').val(start.format('DD-MM-YYYY'));
                })
            },
            eventClick: function (calEvent, jsEvent, view) {

                let url = '{{ route('edit.admin_activities.execution', ['id' => '__ID__']) }}'
                url = url.replace('__ID__', calEvent.id);
                pushRequest(url);
            }
        });

        $('.nav-tabs a[href="#calendar-view"]').on('shown.bs.tab', function (event) {
            calendar.fullCalendar('render');
        });

        pushRequest('{{ route('calendar.admin_activities.execution') }}', null, (response) => {
            $.each(response, (index, value) => {
                let event = {
                    id: value.id,
                    title: value.name,
                    allDay: false,
                    color: userColor(value.assigned_user_id)
                }
                if (value.date_init) {
                    event.start = moment(value.date_init, "DD-MM-YYYY");
                    event.end = moment(value.date_init, "DD-MM-YYYY");
                }

                if (value.date_end) {
                    event.end = moment(value.date_end, "DD-MM-YYYY");
                }

                calendar.fullCalendar('renderEvent', event, true);
            });
        });

        // get a random color
        function randomColor() {

            var chars = '0123456789ABCDEF';
            var color = '#';

            for (var i = 0; i < 6; i++)
                color += chars[Math.floor(Math.random() * 16)];

            return color;
        }

        // get a color for a specified agent
        function userColor(id) {

            var key = 'user-color-' + id;
            var color = sessionStorage.getItem(key);

            if (!color) {
                color = randomColor();
                sessionStorage.setItem(key, color);
            }

            return color;
        }
    });
</script>