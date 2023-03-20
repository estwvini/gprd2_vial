@if(currentUser()->can($urlLoadTable))

    @inject('Activity', '\App\Models\Business\Planning\ActivityProjectFiscalYear')
    @inject('Task', '\App\Models\Business\Task')

    @if($projectSchedule->count())
        <table class="schedule-table" id="schedule_tb">
            <thead>
            <tr>
                <th width="25%">{{ trans('schedule.labels.task') }}</th>
                <th width="12%">{{ trans('schedule.labels.budget') }}</th>
                <th width="12%">{{ trans('schedule.labels.startDate') }}</th>
                <th width="12%">{{ trans('schedule.labels.endDate') }}</th>
                <th width="1%">{{ trans('schedule.labels.duration') }}</th>
                <th width="1%">{{ trans('schedule.labels.relevance') }}</th>
                <th width="15%">{{ trans('schedule.labels.responsible') }}</th>
                <th width="12%">{{ trans('schedule.labels.weight') }}</th>
            </tr>
            </thead>

            <tbody>

            @foreach($projectSchedule as $component)
                @if(isset($component['children']) && $component['children']->count())
                    @include('business.planning.projects.schedule.loadComponent', ['element' => $component])
                @endif

                @if(isset($component['children']) && $component['children']->count())
                    @foreach($component['children'] as $activity)

                        @include('business.planning.projects.schedule.loadActivity', ['element' => $activity])

                        @if(isset($activity['children']) && !empty($activity['children']))
                            @foreach($activity['children'] as $task)
                                @include('business.planning.projects.schedule.loadTask', ['element' => $task])
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach

            </tbody>
        </table>
    @else
        <div class="alert alert-warning align-center" role="alert">
            {{ trans('schedule.messages.warning.no_info_schedule') }}
        </div>
    @endif

    <script>
        $(() => {

            /**
             * Obtiene la diferencia en meses
             *
             * @param dt2
             * @param dt1
             * @returns {*|string}
             */
            let diff_months = (dt2, dt1) => {
                let end = moment(dt2, "DD-MM-YYYY");
                let init = moment(dt1, "DD-MM-YYYY");
                return end.diff(init, 'days', true) || 1;
            }

            /**
             * Calcula el valor total de las ponderaciones de las tareas e hito de una actividad
             *
             * @param activity_id
             * @param element_id
             * @returns {number}
             */
            let getTotalWeightNewTask = (activity_id) => {

                let totalActivityTasksWeight = 0;

                $(`.activity_${activity_id}_task_weight`).each((index, element) => {
                    totalActivityTasksWeight += parseFloat($(element).val() || 0)
                })

                totalActivityTasksWeight += parseFloat($(`#new_task_weight`).val() || 0)

                $(`#total_weight`).text(`${totalActivityTasksWeight.toFixed(2)} %`)

                if (totalActivityTasksWeight.toFixed(2) <= {{ $Activity::MAX_TOTAL_WEIGHT }}) {
                    $(`#total_weight`).addClass('green').removeClass('red')
                } else {
                    $(`#total_weight`).addClass('red').removeClass('green')
                }

                return totalActivityTasksWeight.toFixed(2)
            }

            /**
             * Cierra todos los elementos de edición abiertos
             */
            let clear = () => {
                $('.task_hidden_buttons').hide();
                $('.task_hidden_row').hide();
                $('.task_row').not('.hiddenTasks').show();

                $('.activity_hidden_buttons').hide();
                $('.activity_hidden_row').hide();
                $('.activity_row').show();

                $('.final_weights').show()
                $('.temp_weights').hide()
                $('.temp_weights').empty()

                $('#new_task_row').remove()
                $('#new_task_buttons').remove()
            }

            clear();

            @if(!$projectSchedule->count())
            $('#addTask').hide()
            @endif

            // Remove add task click event
            $('#addTask').off('click');

            // Add task click action
            $('#addTask').on('click', () => {

                // Check if there is a tile selected
                if ($('tr.treeview-item-selected').length) {

                    let activity_id = $('tr.treeview-item-selected').attr('activity_id')

                    if ($(`#activity_${activity_id}_date_init_db`).val() && $(`#activity_${activity_id}_date_end_db`).val()) {

                        clear()

                        // Open activity
                        $(`#arrow_${activity_id}_down`).show()
                        $(`#arrow_${activity_id}_right`).hide()

                        $(`.task_activity_${activity_id}`).show()
                        $(`.task_activity_${activity_id}`).removeClass('hiddenTasks')

                        // Build html code for the new task
                        const newRow = `<tr id="new_task_row" activity_id="${activity_id}" class="new_task_hidden_row">
                        <td>
                            <input type="text" id="new_task_name" name="name" maxlength="140" class="new_task form-control" autocomplete="off" placeholder="{{ trans('schedule.placeholders.task') }}"/>
                        </td>
                        <td><label>{{ trans('schedule.labels.notApply') }}</label></td>
                        <td>
                            <input id="new_task_date_init" name="date_init" placeholder="DD-MM-YYYY" type='text' class="new_task form-control readonly-white" autocomplete="off" readonly />
                            <label id="new_task_date_init_not_apply">{{ trans('schedule.labels.notApply') }}</label>
                        </td>
                        <td>
                            <input id="new_task_date_end" name="date_end" placeholder="DD-MM-YYYY" type='text' class="new_task form-control readonly-white" autocomplete="off" readonly />
                        </td>
                        <td>
                            <input type="text" id="new_task_duration" name="duration" class="new_task form-control" disabled/>
                            <label id="new_task_duration_not_apply">{{ trans('schedule.labels.notApply') }}</label>
                        </td>
                        <td><label>{{ trans('schedule.labels.notApply') }}</label></td>
                        <td>
                            <select class="form-control select2 new_task" id="new_task_responsible_id" name="responsible_id">
                                <option value=""></option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                    {{ $user->fullName() }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <div class="mt-3 input-group" width="100%">
                                <input type="number" id="new_task_weight" name="weight"
                                    class="new_task form-control" autocomplete="off"
                                    placeholder="{{ trans('schedule.placeholders.weight') }}"
                                    min="0"
                                    max="100"/>
                                <span class="p-2 input-group-addon">%</span>
                            </div>
                        </td>
                    </tr>

                    <tr id="new_task_buttons" class="new_task_hidden_buttons">
                        <td colspan="8">
                            <div class="text-center mb-1 mt-1">

                                <div class="btn-group btn-group-toggle pull-left" data-toggle="buttons">
                                    <label id="label_option_task" class="btn btn-primary active">
                                        <input id="option_task" type="radio" value="{{ $Task::ELEMENT_TYPE['TASK'] }}" name="new_task_type" checked>Tarea
                                    </label>
                                    <label id="label_option_milestone" class="btn btn-default">
                                        <input id="option_milestone" type="radio" value="{{ $Task::ELEMENT_TYPE['MILESTONE'] }}" name="new_task_type">Hito
                                    </label>
                                </div>

                                <div class="pull-right mt-3">
                                    <label>{{ trans('schedule.labels.totalWeight') }}: <label class="total_weight" id="total_weight"></label> </label>
                                </div>

                                <button activity_id="${activity_id}" id="cancel_new_task" type="button" class="btn btn-info"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </button>
                            <button activity_id="${activity_id}" id="submit_new_task" type="button" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.save') }}
                            </button>
                        </div>
                    </td>
                </tr>`;

                        $(newRow).insertAfter($('tr.treeview-item-selected'))

                        $('#new_task_date_init_not_apply').hide()
                        $('#new_task_duration_not_apply').hide()

                        // Show total weight of activity tasks
                        getTotalWeightNewTask(activity_id)

                        // Task type event
                        $('input[name="new_task_type"]').on('change', (e) => {
                            let milestone = false
                            $(`.task_activity_${activity_id}`).each((index, element) => {
                                if ($(element).attr('type') === '{{ $Task::ELEMENT_TYPE['MILESTONE'] }}') {
                                    milestone = true;
                                }
                            })

                            // If milestone
                            if ($('input[name="new_task_type"]:checked').val() === '{{ $Task::ELEMENT_TYPE['MILESTONE'] }}') {
                                if (milestone) {
                                    $('#label_option_task').button('toggle')
                                    notify('{{ trans('schedule.messages.validation.milestone_already_exists') }}', 'warning', '{{ trans('app.labels.warning') }}')
                                } else {
                                    $('#new_task_name').attr('placeholder', '{{ trans('schedule.placeholders.milestone') }}')
                                    $('#new_task_date_init_not_apply').show()
                                    $('#new_task_duration_not_apply').show()
                                    $('#new_task_date_init').hide()
                                    $('#new_task_duration').hide()
                                    $(e.currentTarget).parent('label').addClass('btn-primary')
                                    $('#label_option_task').addClass('btn-default')
                                    $(e.currentTarget).parent('label').removeClass('btn-default')
                                    $('#label_option_task').removeClass('btn-primary')

                                    $(`#new_task_date_end`).data('DateTimePicker').minDate(moment($(`#activity_${activity_id}_date_init_db`).val(), "DD-MM-YYYY"))
                                    $(`#new_task_date_end`).data('DateTimePicker').maxDate(moment($(`#activity_${activity_id}_date_end_db`).val(), "DD-MM-YYYY").millisecond(0).second(59).minute(59).hour(23))

                                    $(`#new_task_date_init`).unbind('dp.change')
                                    $(`#new_task_date_init`).val('')
                                    $(`#new_task_duration`).val('')
                                }
                            } else { // If task
                                $('#new_task_name').attr('placeholder', '{{ trans('schedule.placeholders.task') }}')
                                $('#new_task_date_init_not_apply').hide()
                                $('#new_task_duration_not_apply').hide()
                                $('#new_task_date_init').show()
                                $('#new_task_duration').show()
                                $(e.currentTarget).parent('label').addClass('btn-primary')
                                $('#label_option_milestone').addClass('btn-default')
                                $(e.currentTarget).parent('label').removeClass('btn-default')
                                $('#label_option_milestone').removeClass('btn-primary')

                                $(`#new_task_date_init`).on('dp.change', (e) => {
                                    $(`#new_task_date_end`).data('DateTimePicker').minDate(e.date);

                                    if ($(e.currentTarget).val() && $(`#new_task_date_end`).val()) {
                                        $(`#new_task_duration`).val(diff_months($(`#new_task_date_end`).val(), $(e.currentTarget).val()))
                                    }
                                });

                                if ($(`#new_task_date_end`).val()) {
                                    $(`#new_task_date_init`).data('DateTimePicker').maxDate(moment($(`#new_task_date_end`).val(), "DD-MM-YYYY"))
                                }
                            }

                        })

                        // Add datetimepicker
                        $(`#new_task_date_init, #new_task_date_end`).datetimepicker({
                            format: 'DD-MM-YYYY',
                            locale: 'es-es',
                            useCurrent: false,
                            ignoreReadonly: true,
                            viewDate: moment($(`#activity_${activity_id}_date_init_db`).val(), "DD-MM-YYYY")
                        });

                        $(`#new_task_date_init, #new_task_date_end`).on('dp.hide', (e) => {
                            setTimeout(() => {
                                $(e.currentTarget).data('DateTimePicker').viewDate(moment($(`#activity_${activity_id}_date_init_db`).val(), "DD-MM-YYYY"))
                            }, 1);
                        });

                        $(`#new_task_date_init`).data('DateTimePicker').minDate(moment($(`#activity_${activity_id}_date_init_db`).val(), "DD-MM-YYYY"))
                        $(`#new_task_date_init`).data('DateTimePicker').maxDate(moment($(`#activity_${activity_id}_date_end_db`).val(), "DD-MM-YYYY").millisecond(0).second(59).minute(59).hour(23))

                        $(`#new_task_date_end`).data('DateTimePicker').minDate(moment($(`#activity_${activity_id}_date_init_db`).val(), "DD-MM-YYYY"))
                        $(`#new_task_date_end`).data('DateTimePicker').maxDate(moment($(`#activity_${activity_id}_date_end_db`).val(), "DD-MM-YYYY").millisecond(0).second(59).minute(59).hour(23))

                        $(`#new_task_date_init`).on('dp.change', (e) => {
                            $(`#new_task_date_end`).data('DateTimePicker').minDate(e.date)

                            if ($(e.currentTarget).val() && $(`#new_task_date_end`).val()) {
                                $(`#new_task_duration`).val(diff_months($(`#new_task_date_end`).val(), $(e.currentTarget).val()))
                            }
                        });

                        $(`#new_task_date_end`).on('dp.change', (e) => {
                            $(`#new_task_date_init`).data('DateTimePicker').maxDate(e.date)

                            if ($(`#new_task_date_init`).val() && $(e.currentTarget).val()) {
                                $(`#new_task_duration`).val(diff_months($(e.currentTarget).val(), $(`#new_task_date_init`).val()))
                            }
                        });

                        $(`#new_task_responsible_id`).select2({
                            placeholder: '{{ trans('schedule.labels.select') }}'
                        });

                        $(`#new_task_responsible_id`).siblings('span.select2').addClass('schedule_select2')

                        $('#new_task_weight').on('keyup', (e) => {
                            getTotalWeightNewTask(activity_id)

                            if (parseFloat($(e.currentTarget).val()) > parseFloat($(e.currentTarget).attr('max')) || parseFloat($(e.currentTarget).val()) < parseFloat($(e.currentTarget).attr('min'))) {
                                $(e.currentTarget).addClass('has-error')
                            } else {
                                $(e.currentTarget).removeClass('has-error')
                            }
                        })

                        // Cancel action
                        $('#cancel_new_task').on('click', () => {
                            $('#new_task_row').remove()
                            $('#new_task_buttons').remove()
                            $('tr.treeview-item-selected').find('i').removeClass('treeview-action-item-selected')
                            $('tr.treeview-item-selected').removeClass('treeview-item-selected')
                        })

                        // Submit new task action
                        $('#submit_new_task').on('click', (e) => {
                            let activity_id = $(e.currentTarget).attr('activity_id')

                            $('.new_task.has-error').removeClass('has-error')

                            let check = false
                            let check_weight = false
                            let check_length = false
                            let elements = ``
                            let totalWeight = getTotalWeightNewTask(activity_id)

                            if ($('input[name="new_task_type"]:checked').val() === '{{ $Task::ELEMENT_TYPE['TASK'] }}') {
                                elements = `#new_task_name, #new_task_date_init, #new_task_date_end, #new_task_duration, #new_task_responsible_id, #new_task_weight`;
                            } else {
                                elements = `#new_task_name, #new_task_date_end, #new_task_responsible_id, #new_task_weight`;
                            }

                            $(elements).filter((index, element) => {
                                if (!$(element).val()) {
                                    check = true

                                    if ($(element).hasClass('select2')) {
                                        $(element).siblings('span.select2').addClass('new_task').addClass('has-error')
                                    }
                                }

                                return !$(element).val()
                            }).addClass('has-error')

                            if ($('#new_task_weight').val()) {
                                if (parseFloat($('#new_task_weight').val()) > parseFloat($('#new_task_weight').attr('max'))) {
                                    $('#new_task_weight').addClass('has-error')
                                    check_weight = true;
                                    notify('{{ trans('schedule.messages.validation.weight_100') }}', 'warning', '{{ trans('app.labels.warning') }}')
                                }

                                if (parseFloat($('#new_task_weight').val()) <= parseFloat($('#new_task_weight').attr('min'))) {
                                    $('#new_task_weight').addClass('has-error')
                                    check_weight = true;
                                    notify('{{ trans('schedule.messages.validation.weight_0') }}', 'warning', '{{ trans('app.labels.warning') }}')
                                }

                                if (totalWeight > {{ $Activity::MAX_TOTAL_WEIGHT }}) {
                                    check_weight = true;
                                    notify('{{ trans('schedule.messages.validation.total_weight') }}', 'warning', '{{ trans('app.labels.warning') }}');
                                }

                                if ($(`input[name="new_task_type"]:checked`).val() === '{{ $Task::ELEMENT_TYPE['MILESTONE'] }}') {
                                    if (parseFloat($(`#new_task_weight`).val()) < {{ $Task::MIN_WEIGHT_MILESTONE }}) {
                                        check_weight = true;
                                        notify('{{ trans('schedule.messages.validation.milestone_weight') }}', 'warning', '{{ trans('app.labels.warning') }}');
                                    }
                                }
                            }

                            if ($(`#new_task_name`).length > {{ $Task::MAX_NAME_LENGTH }}) {
                                check_length = true
                                notify('{{ trans('schedule.messages.validation.max_length_name') }}', 'warning', '{{ trans('app.labels.warning') }}');
                            }

                            if (!check && !check_weight && !check_length) {
                                pushRequest(`{{ route($urlStoreSchedule) }}`, null, () => {
                                    pushRequest(`{{ route($urlLoadTable) }}`, '#schedule_table', () => {
                                        $('#load_gantt').val(1)
                                    }, 'get', {
                                        'project_id': '{{ $project->id }}'
                                    }, false);
                                }, 'post', {
                                    'activity_id': activity_id,
                                    'type': $('input[name="new_task_type"]:checked').val(),
                                    'name': $('#new_task_name').val(),
                                    'date_init': $('#new_task_date_init').val(),
                                    'date_end': $('#new_task_date_end').val(),
                                    'responsible_id': $('#new_task_responsible_id').val(),
                                    'weight_percentage': $('#new_task_weight').val(),
                                    '_token': '{!! csrf_token() !!}'
                                }, false);
                            } else {
                                if (check) {
                                    notify('{{ trans('schedule.messages.validation.required_fields') }}', 'warning', '{{ trans('app.labels.warning') }}')
                                }
                            }
                        })
                    } else {
                        notify('{{ trans('schedule.messages.validation.missing_dates') }}', 'warning', '{{ trans('app.labels.warning') }}');
                    }

                } else {
                    notify('{{ trans('schedule.messages.validation.missing_activity') }}', 'warning', '{{ trans('app.labels.warning') }}');
                }
            })

        })

    </script>

@else
    @include('errors.403')
@endif