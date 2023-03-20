<tr id="task_row_{{ $element['id'] }}" class="task_activity_{{ $element['activity_id'] }} task_row" task_id="{{ $element['id'] }}" type="{{ $element['type'] }}"
    parent_row="activity_row_{{ $element['activity_id'] }}">
    @foreach($element as $key => $column)
        @if(!in_array($key, ['type', 'id', 'activity_id','responsible_id','weight', 'editable']))
            <td class="{{ $key }}" id="task_col_{{ $element['id'] }}_{{ $key }}">
                @if($key == 'name')
                    <div class="ml-5">
                        @if($element['editable'])
                            <i id="task_{{ $element['id'] }}_edit"
                               class="fa fa-pencil blue task mr-1"
                               task_id="{{ $element['id'] }}"
                               activity_id="{{ $element['activity_id'] }}"
                               type="{{ $element['type'] }}"
                               role="button"></i>
                        @endif
                        <strong>{{ $column }}</strong>
                    </div>
                @else

                    @if($key == 'weight_percentage')
                        <div id="task_col_{{ $element['id'] }}_{{ $key }}" class="final_weights">
                            <strong>{{ $column . ' %' }}</strong>
                        </div>
                        <div id="task_col_temp_{{ $element['id'] }}_{{ $key }}" class="temp_weights">

                        </div>
                    @else
                        <div id="task_col_{{ $element['id'] }}_{{ $key }}">
                            <strong>{{ $column }}</strong>
                        </div>
                    @endif

                @endif
            </td>
        @endif
    @endforeach
</tr>

<tr id="task_form_row_{{ $element['id'] }}" class="task_hidden_row_activity_{{ $element['activity_id'] }} task_hidden_row" parent_row="activity_row_{{ $element['activity_id'] }}"
    task_id="{{ $element['id'] }}">
    <td class="name">
        <input type="text" id="task_{{ $element['id'] }}_name" name="name" maxlength="140" class="edit_task form-control"
               autocomplete="off"

               @if($element['type'] === $Task::ELEMENT_TYPE['TASK'])
               placeholder="{{ trans('schedule.placeholders.task') }}"
               @else
               placeholder="{{ trans('schedule.placeholders.milestone') }}"
               @endif

               value="{{ $element['name'] }}"/>
    </td>
    <td>
        <strong>{{ trans('schedule.labels.notApply') }}</strong>
    </td>
    <td>
        <input name="date_init" id="task_{{ $element['id'] }}_date_init" task_id="{{ $element['id'] }}" placeholder="DD-MM-YYYY" type='text'
               class="edit_task form-control readonly-white"
               autocomplete="off" readonly
               value="{{ $element['date_init'] }}"/>
        <label id="task_{{ $element['id'] }}_date_init_not_apply">{{ trans('schedule.labels.notApply') }}</label>
    </td>
    <td>
        <input name="date_end" id="task_{{ $element['id'] }}_date_end" task_id="{{ $element['id'] }}" placeholder="DD-MM-YYYY" type='text'
               class="edit_task form-control readonly-white"
               autocomplete="off" readonly
               value="{{ $element['date_end'] }}"/>
    </td>
    <td>
        <input name="duration" id="task_{{ $element['id'] }}_duration" maxlength="3"
               class="edit_task form-control"
               disabled
               value="{{ $element['duration'] }}"/>
        <label id="task_{{ $element['id'] }}_duration_not_apply">{{ trans('schedule.labels.notApply') }}</label>
    </td>
    <td>
        <strong>{{ trans('schedule.labels.notApply') }}</strong>
    </td>
    <td>
        <select class="edit_task form-control select2" id="task_{{ $element['id'] }}_responsible_id" name="responsible_id">
            <option value=""></option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" @if($element['responsible_id'] == $user->id) selected @endif>
                    {{ $user->fullName() }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <div class="mt-3 input-group" width="100%">
            <input type="number"
                   name="weight" id="task_{{ $element['id'] }}_weight"
                   class="form-control col-md-7 col-sm-7 col-xs-12"
                   value="{{ $element['weight_percentage'] }}"
                   placeholder="{{ trans('schedule.placeholders.weight') }}"
                   min="0"
                   max="100"/>
            <span class="p-2 input-group-addon">%</span>
        </div>

        <input type="hidden"
               class="activity_{{ $element['activity_id'] }}_task_weight"
               task_id="{{ $element['id'] }}"
               value="{{ $element['weight_percentage'] }}"/>
    </td>
</tr>

<tr id="task_buttons_{{ $element['id'] }}" class="task_hidden_row_buttons_activity_{{ $element['activity_id'] }} task_hidden_buttons" parent_row="activity_row_{{ $element['activity_id'] }}"
    task_id="{{ $element['id'] }}">
    <td colspan="8">
        <div class="text-center mt-3">

            <div class="btn-group btn-group-toggle pull-left" data-toggle="buttons">
                <label id="label_option_task_{{ $element['id'] }}" class="btn @if($element['type'] === $Task::ELEMENT_TYPE['TASK']) btn-primary active @else btn-default @endif">
                    <input id="option_task_{{ $element['id'] }}" type="radio" value="{{ $Task::ELEMENT_TYPE['TASK'] }}" name="task_{{ $element['id'] }}_type"
                           @if($element['type'] === $Task::ELEMENT_TYPE['TASK']) checked @endif>{{ trans('schedule.labels.task') }}
                </label>
                <label id="label_option_milestone_{{ $element['id'] }}"
                       class="btn @if($element['type'] === $Task::ELEMENT_TYPE['MILESTONE']) btn-primary active @else btn-default @endif">
                    <input id="option_milestone_{{ $element['id'] }}" type="radio" value="{{ $Task::ELEMENT_TYPE['MILESTONE'] }}" name="task_{{ $element['id'] }}_type"
                           @if($element['type'] === $Task::ELEMENT_TYPE['MILESTONE']) checked @endif>{{ trans('schedule.labels.milestone') }}
                </label>
            </div>

            <div class="pull-right mt-3">
                <label>{{ trans('schedule.labels.totalWeight') }}: <label class="total_weight" id="total_weight_{{ $element['id'] }}"></label> </label>
            </div>

            <button id="task_{{ $element['id'] }}_cancel" task_id="{{ $element['id'] }}" type="button" class="btn btn-info cancel_task">
                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
            </button>
            <button id="task_{{ $element['id'] }}_submit" task_id="{{ $element['id'] }}" type="button" class="btn btn-success submit_task">
                <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
            </button>
            <button id="task_{{ $element['id'] }}_destroy" task_id="{{ $element['id'] }}" type="button" class="btn btn-danger destroy_task">
                <i class="fa fa-trash"></i> {{ trans('app.labels.delete') }}
            </button>
        </div>
    </td>
</tr>

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
         * Agrega los eventos y acciones a cada campo de la edición de una tarea o hito
         *
         * @param element_id
         */
        let addEventsToTaskFields = (element_id) => {

            // Add datetime picker
            $(`#task_${element_id}_date_init, #task_${element_id}_date_end`).datetimepicker({
                format: 'DD-MM-YYYY',
                locale: 'es-es',
                useCurrent: false,
                ignoreReadonly: true
            });

            $(`#task_${element_id}_date_init, #task_${element_id}_date_end`).on('dp.hide', (e) => {
                setTimeout(() => {
                    $(e.currentTarget).data('DateTimePicker').viewDate(moment($(`#task_${element_id}_date_init`).val(), "DD-MM-YYYY"));
                }, 1);
            });

            // Set min and max dates
            $(`#task_${element_id}_date_init`).data('DateTimePicker').minDate(moment($(`#activity_{{ $element['activity_id'] }}_date_init_db`).val(), "DD-MM-YYYY"));
            if ($(`#task_${element_id}_date_end`).val()) {
                $(`#task_${element_id}_date_init`).data('DateTimePicker').maxDate(moment($(`#task_${element_id}_date_end`).val(), "DD-MM-YYYY").millisecond(0).second(59).minute(59).hour(23));
            }

            if ($(`#task_${element_id}_date_init`).val()) {
                $(`#task_${element_id}_date_end`).data('DateTimePicker').minDate(moment($(`#task_${element_id}_date_init`).val(), "DD-MM-YYYY"));
            } else {
                $(`#task_${element_id}_date_end`).data('DateTimePicker').minDate(moment($(`#activity_{{ $element['activity_id'] }}_date_init_db`).val(), "DD-MM-YYYY"));
            }
            $(`#task_${element_id}_date_end`).data('DateTimePicker').maxDate(moment($(`#activity_{{ $element['activity_id'] }}_date_end_db`).val(), "DD-MM-YYYY").millisecond(0).second(59).minute(59).hour(23));

            $(`#task_${element_id}_date_init`).on('dp.change', (e) => {
                $(`#task_${element_id}_date_end`).data('DateTimePicker').minDate(e.date);

                if ($(e.currentTarget).val() && $(`#task_${element_id}_date_end`).val()) {
                    $(`#task_${element_id}_duration`).val(diff_months($(`#task_${element_id}_date_end`).val(), $(e.currentTarget).val()))
                }
            });

            $(`#task_${element_id}_date_end`).on('dp.change', (e) => {
                $(`#task_${element_id}_date_init`).data('DateTimePicker').maxDate(e.date);

                if ($(`#task_${element_id}_date_init`).val() && $(e.currentTarget).val()) {
                    $(`#task_${element_id}_duration`).val(diff_months($(e.currentTarget).val(), $(`#task_${element_id}_date_init`).val()))
                }
            });

            $(`#task_${element_id}_responsible_id`).select2({
                placeholder: '{{ trans('schedule.labels.select') }}'
            });

            $(`#task_${element_id}_responsible_id`).siblings('span.select2').addClass('schedule_select2')

            $(`#task_${element_id}_weight`).on('keyup', (e) => {
                getTotalWeight('{{ $element['activity_id'] }}', element_id)

                if (parseFloat($(e.currentTarget).val()) > parseFloat($(e.currentTarget).attr('max')) || parseFloat($(e.currentTarget).val()) < parseFloat($(e.currentTarget).attr('min'))) {
                    $(e.currentTarget).addClass('has-error')
                } else {
                    $(e.currentTarget).removeClass('has-error')
                }
            })

            // Change task type event
            $(`input[name="task_${element_id}_type"]`).on('change', (e) => {
                let milestone = false
                $(`.task_activity_{{ $element['activity_id'] }}`).each((index, element) => {
                    if (element_id != $(element).attr('task_id') && $(element).attr('type') === '{{ $Task::ELEMENT_TYPE['MILESTONE'] }}') {
                        milestone = true;
                    }
                })

                // If milestone
                if ($(`input[name="task_${element_id}_type"]:checked`).val() === '{{ $Task::ELEMENT_TYPE['MILESTONE'] }}') {
                    if (milestone) {
                        $(`#label_option_task_${element_id}`).button('toggle')
                        notify('{{ trans('schedule.messages.validation.milestone_already_exists') }}', 'warning', '{{ trans('app.labels.warning') }}')
                    } else {
                        $(`#task_${element_id}_name`).attr('placeholder', '{{ trans('schedule.placeholders.milestone') }}')
                        $(`#task_${element_id}_date_init_not_apply`).show()
                        $(`#task_${element_id}_duration_not_apply`).show()
                        $(`#task_${element_id}_date_init`).hide()
                        $(`#task_${element_id}_duration`).hide()
                        $(e.currentTarget).parent('label').addClass('btn-primary')
                        $(`#label_option_task_${element_id}`).addClass('btn-default')
                        $(e.currentTarget).parent('label').removeClass('btn-default')
                        $(`#label_option_task_${element_id}`).removeClass('btn-primary')

                        $(`#task_${element_id}_date_end`).data('DateTimePicker').minDate(moment($(`#activity_{{ $element['activity_id'] }}_date_init_db`).val(), "DD-MM-YYYY"))
                        $(`#task_${element_id}_date_end`).data('DateTimePicker').maxDate(moment($(`#activity_{{ $element['activity_id'] }}_date_end_db`).val(), "DD-MM-YYYY"))

                        $(`#task_${element_id}_date_init`).unbind('dp.change')
                        $(`#task_${element_id}_date_init`).val('')
                        $(`#task_${element_id}_duration`).val('')
                    }
                } else { // If Task
                    $(`#task_${element_id}_name`).attr('placeholder', '{{ trans('schedule.placeholders.task') }}')
                    $(`#task_${element_id}_date_init_not_apply`).hide()
                    $(`#task_${element_id}_duration_not_apply`).hide()
                    $(`#task_${element_id}_date_init`).show()
                    $(`#task_${element_id}_duration`).show()
                    $(e.currentTarget).parent('label').addClass('btn-primary')
                    $(`#label_option_milestone_${element_id}`).addClass('btn-default')
                    $(e.currentTarget).parent('label').removeClass('btn-default')
                    $(`#label_option_milestone_${element_id}`).removeClass('btn-primary')

                    $(`#task_${element_id}_date_init`).on('dp.change', (e) => {
                        $(`#task_${element_id}_date_end`).data('DateTimePicker').minDate(e.date);

                        if ($(e.currentTarget).val() && $(`#task_${element_id}_date_end`).val()) {
                            $(`#task_${element_id}_duration`).val(diff_months($(`#task_${element_id}_date_end`).val(), $(e.currentTarget).val()))
                        }
                    });

                    if ($(`#task_${element_id}_date_end`).val()) {
                        $(`#task_${element_id}_date_init`).data('DateTimePicker').maxDate(moment($(`#task_${element_id}_date_end`).val(), "DD-MM-YYYY"))
                    }
                }

            })
        }

        /**
         * Calcula el valor total de las ponderaciones de las tareas e hito de una actividad
         *
         * @param activity_id
         * @param element_id
         * @returns {number}
         */
        let getTotalWeight = (activity_id, element_id) => {

            let totalActivityTasksWeight = 0;
            $(`.activity_${activity_id}_task_weight`).each((index, element) => {
                if (element_id == $(element).attr('task_id')) {
                    totalActivityTasksWeight += parseFloat($(`#task_${element_id}_weight`).val() || 0)
                } else {
                    totalActivityTasksWeight += parseFloat($(element).val() || 0)
                }
            })

            $(`#total_weight_${element_id}`).text(`${totalActivityTasksWeight.toFixed(2)} %`)

            if (totalActivityTasksWeight.toFixed(2) <= {{ $Activity::MAX_TOTAL_WEIGHT }}) {
                $(`#total_weight_${element_id}`).addClass('green').removeClass('red')
            } else {
                $(`#total_weight_${element_id}`).addClass('red').removeClass('green')
            }

            return totalActivityTasksWeight.toFixed(2)
        }

        /**
         * Cierra todos los elementos de edición abiertos
         */
        let clear = () => {

            $('.task_hidden_row').each((index, element) => {
                if ($(element).is(':visible')) {
                    $(element).hide();
                    $(`#task_buttons_${$(element).attr('task_id')}`).hide();
                    $(`#task_row_${$(element).attr('task_id')}`).show();
                }
            })

            $('.activity_hidden_row').each((index, element) => {
                if ($(element).is(':visible')) {
                    $(element).hide();
                    $(`#activity_buttons_${$(element).attr('activity_id')}`).hide();
                    $(`#activity_row_${$(element).attr('activity_id')}`).show();
                }
            })

            $('.final_weights').show()
            $('.temp_weights').hide()
            $('.temp_weights').empty()

            $('#new_task_row').remove()
            $('#new_task_buttons').remove()
        }

        @if($element['type'] === $Task::ELEMENT_TYPE['TASK'])
        $(`#task_{{ $element['id'] }}_date_init_not_apply`).hide()
        $(`#task_{{ $element['id'] }}_duration_not_apply`).hide()
        @else
        $(`#task_{{ $element['id'] }}_date_init`).hide()
        $(`#task_{{ $element['id'] }}_duration`).hide()
        @endif

        addEventsToTaskFields({{ $element['id'] }})

        getTotalWeight('{{ $element['activity_id'] }}', '{{ $element['id'] }}')

        $(`#task_{{ $element['id'] }}_edit`).on('click', (e) => {
            let task_id = $(e.currentTarget).attr('task_id')

            clear()

            $(`#task_row_${task_id}`).hide()
            $(`#task_buttons_${task_id}`).show()
            $(`#task_form_row_${task_id}`).show()

        });

        // Cancel action
        $(`#task_{{ $element['id'] }}_cancel`).on('click', () => {
            clear()
        })

        // Save task action
        $(`#task_{{ $element['id'] }}_submit`).on('click', (e) => {

            let check = false
            let check_weight = false
            let check_length = false
            let elements = ``
            let task_id = $(e.currentTarget).attr('task_id')
            let totalWeight = getTotalWeight('{{ $element['activity_id'] }}', '{{ $element['id'] }}')

            $('.edit_task.has-error').removeClass('has-error')

            if ($(`input[name="task_${task_id}_type"]:checked`).val() === '{{ $Task::ELEMENT_TYPE['TASK'] }}') {
                elements = `#task_${task_id}_name, #task_${task_id}_date_init, #task_${task_id}_date_end, #task_${task_id}_duration, #task_${task_id}_responsible_id, #task_${task_id}_weight`
            } else {
                elements = `#task_${task_id}_name, #task_${task_id}_date_end, #task_${task_id}_responsible_id, #task_${task_id}_weight`
            }

            // Add error class to empty fields
            $(elements).filter((index, element) => {
                if (!$(element).val()) {
                    check = true

                    if ($(element).hasClass('select2')) {
                        $(element).siblings('span.select2').addClass('new_task').addClass('has-error')
                    }
                }

                return !$(element).val()
            }).addClass('has-error')

            if ($(`#task_${task_id}_weight`).val()) {
                if (parseFloat($(`#task_${task_id}_weight`).val()) > parseFloat($(`#task_${task_id}_weight`).attr('max'))) {
                    $(`#task_${task_id}_weight`).addClass('has-error')
                    check_weight = true;
                    notify('{{ trans('schedule.messages.validation.weight_100') }}', 'warning', '{{ trans('app.labels.warning') }}');
                }

                if (parseFloat($(`#task_${task_id}_weight`).val()) <= parseFloat($(`#task_${task_id}_weight`).attr('min'))) {
                    $(`#task_${task_id}_weight`).addClass('has-error')
                    check_weight = true;
                    notify('{{ trans('schedule.messages.validation.weight_0') }}', 'warning', '{{ trans('app.labels.warning') }}');
                }

                if (totalWeight > {{ $Activity::MAX_TOTAL_WEIGHT }}) {
                    check_weight = true;
                    notify('{{ trans('schedule.messages.validation.total_weight') }}', 'warning', '{{ trans('app.labels.warning') }}');
                }

                if ($(`input[name="task_${task_id}_type"]:checked`).val() === '{{ $Task::ELEMENT_TYPE['MILESTONE'] }}') {
                    if (parseFloat($(`#task_${task_id}_weight`).val()) < {{ $Task::MIN_WEIGHT_MILESTONE }}) {
                        check_weight = true;
                        notify('{{ trans('schedule.messages.validation.milestone_weight') }}', 'warning', '{{ trans('app.labels.warning') }}');
                    }
                }
            }

            if ($(`#task_${task_id}_name`).length > {{ $Task::MAX_NAME_LENGTH }}) {
                check_length = true
                notify('{{ trans('schedule.messages.validation.max_length_name') }}', 'warning', '{{ trans('app.labels.warning') }}');
            }

            if (!check && !check_weight && !check_length) {
                pushRequest(`{{ route($urlUpdateSchedule) }}`, null, () => {
                    pushRequest(`{{ route($urlLoadTable) }}`, '#schedule_table', () => {
                        $('#load_gantt').val(1)
                    }, 'get', {
                        'project_id': '{{ $project->id }}'
                    }, false);
                }, 'put', {
                    'id': '{{ $element['id'] }}',
                    'activity_id': '{{ $element['activity_id'] }}',
                    'type': $(`input[name="task_${task_id}_type"]:checked`).val(),
                    'name': $(`#task_${task_id}_name`).val(),
                    'date_init': $(`#task_${task_id}_date_init`).val(),
                    'date_end': $(`#task_${task_id}_date_end`).val(),
                    'responsible_id': $(`#task_${task_id}_responsible_id`).val(),
                    'weight_percentage': $(`#task_${task_id}_weight`).val(),
                    '_token': '{!! csrf_token() !!}'
                }, false);
            } else {
                if (check) {
                    notify('{{ trans('schedule.messages.validation.required_fields') }}', 'warning', '{{ trans('app.labels.warning') }}');
                }
            }

        })

        // Delete task action
        $(`#task_{{ $element['id'] }}_destroy`).on('click', () => {
            let confirmMessage = ''

            if ($(`input[name="task_{{ $element['id'] }}_type"]:checked`).val() === '{{ $Task::ELEMENT_TYPE['MILESTONE'] }}') {
                confirmMessage = '{{ trans('schedule.messages.confirm.delete_milestone') }}'
            } else {
                confirmMessage = '{{ trans('schedule.messages.confirm.delete_task') }}'
            }

            confirmModal(confirmMessage, () => {
                pushRequest(`{{ route($urlDestroySchedule, ['id' => $element['id']]) }}`, null, () => {
                    pushRequest(`{{ route($urlLoadTable) }}`, '#schedule_table', () => {
                        $('#load_gantt').val(1)
                    }, 'get', {
                        'project_id': '{{ $project->id }}'
                    }, false);
                }, 'delete', {
                    'type': $(`input[name="task_{{ $element['id'] }}_type"]:checked`).val(),
                    '_token': '{!! csrf_token() !!}'
                }, false);
            })
        })
    })
</script>