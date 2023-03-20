<tr id="activity_row_{{ $element['id'] }}" class="activity_row treeview-item-unselected @if($element['affected']) affected_activity @endif" activity_id="{{ $element['id'] }}"
    role="button"
    parent_row="component_row_{{ $element['component_id'] }}">
    @foreach($element as $key => $column)
        @if(!in_array($key, ['type', 'id','responsible_id','weight', 'children', 'component_id', 'affected']))
            <td class="{{ $key }}" id="activity_col_{{ $element['id'] }}_{{ $key }}">
                @if($key == 'name')
                    <div class="ml-3">
                        @if(isset($element['children']) && $element['children']->count())
                            <i id="arrow_{{ $element['id'] }}_right" class="glyphicon glyphicon-chevron-right arrow_right mr-1"></i>
                            <i id="arrow_{{ $element['id'] }}_down" class="glyphicon glyphicon-chevron-down arrow_down mr-1"></i>
                        @endif
                        <i id="activity_{{ $element['id'] }}_edit"
                           class="fa fa-pencil mr-1"
                           activity_id="{{ $element['id'] }}"
                           role="button"></i>
                        <strong>{{ $column }}</strong>
                    </div>
                @else

                    @if($key == 'weight_percentage')
                        <div id="activity_col_{{ $element['id'] }}_{{ $key }}" class="final_weights">
                            <strong>{{ $column . ' %' }}</strong>
                        </div>
                        <div id="activity_col_temp_{{ $element['id'] }}_{{ $key }}" class="temp_weights">

                        </div>
                    @else
                        <div id="activity_col_{{ $element['id'] }}_{{ $key }}">
                            <strong>{{ ($key == 'budget' ? '$ ' : '') . $column }}</strong>
                        </div>
                    @endif

                @endif
            </td>
        @endif
    @endforeach
</tr>

<tr id="activity_form_row_{{ $element['id'] }}" class="activity_hidden_row" activity_id="{{ $element['id'] }}">
    <td class="name">
        <div class="ml-3">
            <input name="activity_name" id="activity_{{ $element['id'] }}_name" activity_id="{{ $element['id'] }}" type="text"
                   class="edit_activity form-control readonly-white" autocomplete="off"
                   value="{{ explode("-", $element['name'])[1] }} @if(count(explode("-", $element['name']))>2 ) {{ explode("-", $element['name'])[2] }} @endif  "/>
        </div>
    </td>
    <td>
        <strong>{{ '$ ' . $element['budget'] }}</strong>
        <input id="activity_{{ $element['id'] }}_budget" type="hidden" value="{{ $element['budget'] }}"/>
    </td>
    <td>
        <input name="date_init" id="activity_{{ $element['id'] }}_date_init" activity_id="{{ $element['id'] }}" placeholder="DD-MM-YYYY" type='text'
               class="edit_activity form-control readonly-white"
               autocomplete="off" readonly
               value="{{ $element['date_init'] }}"/>
        <input id="activity_{{ $element['id'] }}_date_init_db" type="hidden" value="{{ $element['date_init'] }}"/>
    </td>
    <td>
        <input name="date_end" id="activity_{{ $element['id'] }}_date_end" activity_id="{{ $element['id'] }}" placeholder="DD-MM-YYYY" type='text'
               class="edit_activity form-control readonly-white"
               autocomplete="off" readonly
               value="{{ $element['date_end'] }}"/>
        <input id="activity_{{ $element['id'] }}_date_end_db" type="hidden" value="{{ $element['date_end'] }}"/>
    </td>
    <td>
        <input name="duration" id="activity_{{ $element['id'] }}_duration" maxlength="3"
               class="edit_activity form-control"
               disabled
               value="{{ $element['duration'] }}"/>
    </td>
    <td>
        <select class="edit_activity form-control select2" id="activity_{{ $element['id'] }}_relevance" activity_id="{{ $element['id'] }}" name="relevance">
            <option value="">{{ trans('schedule.labels.select') }}</option>
            @foreach($relevanceOptions as $relevance)
                <option value="{{ $relevance }}" @if($element['relevance'] == $relevance) selected @endif>{{ $relevance }}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select class="edit_activity form-control select2" id="activity_{{ $element['id'] }}_responsible_id" name="responsible_id">
            <option value=""></option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" @if($element['responsible_id'] == $user->id) selected @endif>
                    {{ $user->fullName() }}
                </option>
            @endforeach
        </select>
    </td>
    <td>
        <input name="weight" id="activity_{{ $element['id'] }}_weight" maxlength="100"
               class="form-control col-md-7 col-sm-7 col-xs-12"
               disabled
               value="{{ $element['weight_percentage'] }}"/>
        <input id="activity_{{ $element['id'] }}_weight_value" class="weight_value" activity_id="{{ $element['id'] }}" type="hidden"
               value="{{ $element['weight'] }}"/>
        <input id="activity_{{ $element['id'] }}_weight_value_tmp" activity_id="{{ $element['id'] }}" type="hidden"
               value="{{ $element['weight'] }}"/>
    </td>
</tr>

<tr id="activity_buttons_{{ $element['id'] }}" class="activity_hidden_buttons">
    <td colspan="8">
        <div class="text-center mb-1 mt-1">
            <button id="activity_{{ $element['id'] }}_cancel" activity_id="{{ $element['id'] }}" type="button" class="btn btn-info cancel_activity">
                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
            </button>
            <button id="activity_{{ $element['id'] }}_submit" activity_id="{{ $element['id'] }}" type="button" class="btn btn-success submit_activity">
                <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
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
        };

        /**
         * Calcula la poderación de la actividad en edición y los temporales de las demás
         *
         * @param activity_id
         */
        let calculateWeight = (activity_id) => {
            if ($(`#activity_${activity_id}_duration`).val() && $(`#activity_${activity_id}_relevance`).val()) {
                let budget = parseFloat($(`#activity_${activity_id}_budget`).val().replace(/,/g, ''));

                let budgetMaxMin = getMaxMin('budget');
                let durationMaxMin = getMaxMin('duration');
                let relevanceMaxMin = getMaxMin('relevance');
                let xBudget = normalizedValue(budget, budgetMaxMin[0], budgetMaxMin[1]);
                let xDuration = normalizedValue(parseFloat($(`#activity_${activity_id}_duration`).val()), durationMaxMin[0], durationMaxMin[1]);
                let xRelevance = normalizedValue(parseFloat($(`#activity_${activity_id}_relevance`).val()), relevanceMaxMin[0], relevanceMaxMin[1]);

                let weightValue = (xBudget + xDuration + xRelevance) / 3;

                let totalWeight = 0;

                $('.weight_value').each((index, element) => {
                    if ($(element).attr('activity_id') !== activity_id) {
                        totalWeight += parseFloat($(element).val())
                    } else {
                        totalWeight += weightValue
                    }
                });

                let weight = ((weightValue * 100) / totalWeight).toFixed(2);
                $(`#activity_${activity_id}_weight`).val(`${weight} %`);

                $('.weight_value').each((index, element) => {
                    weight = ((parseFloat($(element).val()) * 100) / totalWeight).toFixed(2);

                    $(`#activity_col_temp_${$(element).attr('activity_id')}_weight_percentage`).html(`<strong>${weight} %</strong>`)
                });

                $('.final_weights').hide();
                $('.temp_weights').show();
            }
        };

        /**
         * Obtiene los valores máximos y mínimos
         */
        let getMaxMin = (variable) => {

            let nums = [];
            if (variable === 'budget') {
                $("input[id*='_budget']").each((index, element) => {
                    nums.push(parseFloat($(element).val().replace(/,/g, '')));
                });
            } else if (variable === 'duration') {
                $("input[id*='_duration']").each((index, element) => {
                    if (parseFloat($(element).val())) {
                        nums.push(parseFloat($(element).val()));
                    }
                });
            } else { // relevance
                $("select[id*='_relevance']").each((index, element) => {
                    if (parseFloat($(element).val())) {
                        nums.push(parseFloat($(element).val()));
                    }
                });
            }
            let max = Math.max.apply(Math, nums);
            let min = Math.min.apply(Math, nums);
            return [max, min];
        };

        let normalizedValue = (value, max, min) => {
            if ((max - min) !== 0) {
                return Math.abs((value - min) / (max - min));
            }
            return 1;
        };

        /**
         * Agrega los eventos y acciones a cada campo de la edición de una actividad
         *
         * @param element_id
         */
        let addEventsToActivityFields = (element_id) => {

            // Datetimepicker from bootstrap
            $(`#activity_${element_id}_date_init, #activity_${element_id}_date_end`).datetimepicker({
                format: 'DD-MM-YYYY',
                locale: 'es-es',
                useCurrent: false,
                ignoreReadonly: true,
                viewDate: moment('{{ $minDate }}', 'DD-MM-YYYY'),
                minDate: moment('{{ $minDate }}', 'DD-MM-YYYY'),
                maxDate: moment('{{ $maxDate }}', 'DD-MM-YYYY')
            });

            $(`#activity_${element_id}_date_init, #activity_${element_id}_date_end`).on('dp.hide', (e) => {
                setTimeout(() => {
                    $(e.currentTarget).data('DateTimePicker').viewDate(moment('{{ $minDate }}', 'DD-MM-YYYY'));
                }, 1);
            });

            if ($(`#activity_${element_id}_date_init`).val()) {
                $(`#activity_${element_id}_date_end`).data('DateTimePicker').minDate(moment($(`#activity_${element_id}_date_init`).val(), "DD-MM-YYYY"));
            }

            if ($(`#activity_${element_id}_date_end`).val()) {
                $(`#activity_${element_id}_date_init`).data('DateTimePicker').maxDate(moment($(`#activity_${element_id}_date_end`).val(), "DD-MM-YYYY"));
            }

            $(`#activity_${element_id}_date_init`).on('dp.change', (e) => {
                let activity_id = $(e.currentTarget).attr('activity_id')

                $(`#activity_${activity_id}_date_end`).data('DateTimePicker').minDate(e.date);

                if ($(e.currentTarget).val() && $(`#activity_${activity_id}_date_end`).val()) {
                    $(`#activity_${activity_id}_duration`).val(diff_months($(`#activity_${activity_id}_date_end`).val(), $(e.currentTarget).val()))
                }
            });

            $(`#activity_${element_id}_date_end`).on('dp.change', (e) => {
                let activity_id = $(e.currentTarget).attr('activity_id')

                $(`#activity_${activity_id}_date_init`).data('DateTimePicker').maxDate(e.date);

                if ($(`#activity_${activity_id}_date_init`).val() && $(e.currentTarget).val()) {
                    $(`#activity_${activity_id}_duration`).val(diff_months($(e.currentTarget).val(), $(`#activity_${activity_id}_date_init`).val()))
                }
            });

            // Select2 for responsible and relevance
            $(`#activity_${element_id}_responsible_id`).select2({
                placeholder: '{{ trans('schedule.labels.select') }}'
            });

            $(`#activity_${element_id}_responsible_id`).siblings('span.select2').addClass('schedule_select2')

            $(`#activity_${element_id}_relevance`).select2({
                placeholder: '{{ trans('schedule.labels.select') }}',
                minimumResultsForSearch: Infinity
            });

            // Calculate weight before a change
            // $(`#activity_${element_id}_date_init, #activity_${element_id}_date_end, #activity_${element_id}_relevance`).on('change dp.change', (e) => {
            //     let activity_id = $(e.currentTarget).attr('activity_id')
            //     calculateWeight(activity_id)
            // })
        };

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

        $('.arrow_right').hide()

        addEventsToActivityFields({{ $element['id'] }})

        // Click on activity event
        $(`#activity_row_{{ $element['id'] }}`).on('click', (e) => {

            if ($('#activity_form_row_' + $(e.currentTarget).attr('activity_id')).is(":hidden")) {
                $('.activity_row').removeClass('treeview-item-selected')
                $('.activity_row').find('i').removeClass('treeview-action-item-selected')

                $(e.currentTarget).addClass('treeview-item-selected')
                $(e.currentTarget).find('i').addClass('treeview-action-item-selected')
            }

        })

        // Edit activity action
        $(`#activity_{{ $element['id'] }}_edit`).on('click', (e) => {
            let activity_id = $(e.currentTarget).attr('activity_id')

            $(`#activity_row_${activity_id}`).removeClass('treeview-item-selected')
            $(`#activity_row_${activity_id}`).find('i').removeClass('treeview-action-item-selected')

            clear();
            // calculateWeight(activity_id)

            $(`#activity_row_${activity_id}`).hide()
            $(`#activity_buttons_${activity_id}`).show()
            $(`#activity_form_row_${activity_id}`).show()

        });

        // Cancel activity action
        $(`#activity_{{ $element['id'] }}_cancel`).on('click', (e) => {
            clear()
        })

        // Save activity action
        $(`#activity_{{ $element['id'] }}_submit`).on('click', (e) => {
            let activity_id = $(e.currentTarget).attr('activity_id')

            $('.edit_activity.has-error').removeClass('has-error')

            let check = false;

            $(`#activity_${activity_id}_name, #activity_${activity_id}_date_init, #activity_${activity_id}_date_end, #activity_${activity_id}_duration,
                #activity_${activity_id}_relevance, #activity_${activity_id}_responsible_id`).filter((index, element) => {
                if (!$(element).val()) {
                    check = true

                    if ($(element).hasClass('select2')) {
                        $(element).siblings('span.select2').addClass('edit_activity').addClass('has-error')
                    }
                }

                return !$(element).val()
            }).addClass('has-error')

            if (!check) {
                pushRequest(`{{ route($urlUpdateSchedule) }}`, null, () => {
                    pushRequest(`{{ route($urlLoadTable) }}`, '#schedule_table', () => {
                        $('#load_gantt').val(1)
                    }, 'get', {
                        'project_id': '{{ $project->id }}'
                    }, false);
                }, 'put', {
                    'id': activity_id,
                    'name': $(`#activity_${activity_id}_name`).val(),
                    'type': '{{ $Activity::TYPE }}',
                    'date_init': $(`#activity_${activity_id}_date_init`).val(),
                    'date_end': $(`#activity_${activity_id}_date_end`).val(),
                    'relevance': $(`#activity_${activity_id}_relevance`).val(),
                    'responsible_id': $(`#activity_${activity_id}_responsible_id`).val(),
                    'project_id': '{{ $project->id }}',
                    '_token': '{!! csrf_token() !!}'
                }, false);

            } else {
                notify('{{ trans('schedule.messages.validation.required_fields') }}', 'warning', '{{ trans('app.labels.warning') }}');
            }

        })
    })

</script>