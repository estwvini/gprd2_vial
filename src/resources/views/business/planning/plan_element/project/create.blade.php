@permission('create.project.plan_elements.plans.plans_management')
@inject('Project', '\App\Models\Business\Project')

<div class="x_panel">
    <div class="x_title">
        <h2 class="align-center">{{ trans('projects.labels.create') }}</h2>

        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                <form role="form" method="post"
                      enctype="multipart/form-data"
                      class="form-horizontal form-label-left" id="projectFormCreate" novalidate>

                    @method('POST')
                    @csrf
                    <input type="hidden" value="1" name="edit_budget">
                    <div class="pb-4">{!! $route !!}</div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="project_name">
                            {{ trans('plan_elements.labels.project_name') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="name" id="project_name" maxlength="200"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('projects.placeholders.name') }}" autocomplete="off"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="cup">
                            {{ trans('projects.labels.cup') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="number" name="cup" id="cup" maxlength="3"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('projects.placeholders.cup') }}" autocomplete="off"
                                   value="{{ $cup }}" disabled/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="description">
                            {{ trans('plan_elements.labels.description') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="is_road">
                            {{ trans('plan_elements.labels.isRoad') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="checkbox" name="is_road" id="is_road" class="js-switch"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="responsible_unit_id">
                            {{ trans('plan_elements.labels.responsibleUnit') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control select2 select2_type" id="responsible_unit_id" name="responsible_unit_id">
                                <option value="">{{ trans('app.labels.select') }}</option>
                                @foreach($responsibleUnits as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="zone">
                            {{ trans('projects.labels.zone') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="zone" id="zone" maxlength="100"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('projects.placeholders.zone') }}" autocomplete="off"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="date_init">
                            {{ trans('projects.labels.init_date') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="date_init" id="date_init"
                                   class="form-control has-feedback-left readonly-white"
                                   placeholder=" DD-MM-YYYY" autocomplete="off" readonly/>
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="date_end">
                            {{ trans('projects.labels.end_date') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="date_end" id="date_end"
                                   class="form-control has-feedback-left readonly-white"
                                   placeholder=" DD-MM-YYYY" autocomplete="off" readonly/>
                            <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="month_duration">
                            {{ trans('projects.labels.month_duration') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="month_duration" id="month_duration" maxlength="100"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   disabled/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="execution_term">
                            {{ trans('projects.labels.execution_term') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="execution_term" id="execution_term" maxlength="100"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   disabled/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="tir">
                            {{ trans('projects.labels.tir') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="tir" id="tir" class="form-control col-md-7 col-sm-7 col-xs-12"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="van">
                            {{ trans('projects.labels.van') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="van" id="van" class="form-control col-md-7 col-sm-7 col-xs-12"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="benefit_cost">
                            {{ trans('projects.labels.benefit_cost') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea name="benefit_cost" id="benefit_cost"
                                      class="form-control col-md-7 col-sm-7 col-xs-12" placeholder="{{ trans('projects.placeholders.benefit_cost') }}"></textarea>
                        </div>
                    </div>

                    <fieldset id="budgets_fieldset" class="mt-5">
                        <legend class="scheduler-border">{{ trans('projects.labels.annual_budgets') }}</legend>
                        <div id="load_annual_budgets">

                        </div>

                        <div class="item form-group">
                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="referential_budget">
                                {{ trans('projects.labels.referential_budget') }}
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input name="referential_budget" id="referential_budget" maxlength="100"
                                           class="form-control col-md-7 col-sm-7 col-xs-12"
                                           disabled/>
                                </div>
                            </div>
                        </div>

                    </fieldset>

                    <div class="pull-right">
                        <button id="cancelBtn" type="button" class="btn btn-info"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
                        <button id="submitBtn" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.save') }} {{ trans('plan_elements.labels.PROJECT') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(() => {

        /**
         * Obtiene la diferencia en meses
         *
         * @param dt2
         * @param dt1
         * @returns {*|string}
         */
        const diff_months = (dt2, dt1) => {
            let end = moment(dt2, "DD-MM-YYYY");
            let init = moment(dt1, "DD-MM-YYYY");
            return end.diff(init, 'months', true).toFixed(2);
        }

        /**
         * Obtiene la diferencia en años
         *
         * @param dt2
         * @param dt1
         * @returns {number}
         */
        const diff_years = (dt2, dt1) => {
            let end = moment(dt2, "DD-MM-YYYY");
            let init = moment(dt1, "DD-MM-YYYY");
            return end.year() - init.year();
        }

        let $form = $('#projectFormCreate');

        /**
         * Agrega validaciones y lógica a cada campo de presupuesto anual
         */
        const addBudgetsLogic = () => {
            /**
             * Almacena la acción que se va a ejecutar ante un evento sobre el campo
             */
            const action = () => {
                let referential_budget = 0;
                $('input[id*="budgets"]').each((index, element) => {
                    referential_budget = referential_budget + parseFloat($(element).val() || 0)
                })
                $('#referential_budget').val(referential_budget.toFixed(2))
                $('#referential_budget').number(true, 2)
            }

            $('input[id*="budgets"]').on('focusin', (e) => {
                $(e.currentTarget).attr('maxlength', 16)
            })

            $('input[id*="budgets"]').each((index, element) => {
                $(element).number(true, 2)
                $(element).rules("add", {
                    required: true,
                    min: 0,
                    max: {{ $Project::MAX_ALLOWED_VALUE }},
                    messages: {
                        max: '{{ trans('plan_elements.messages.validations.maxValue') }}'
                    }

                });

                $(element).change(() => {
                    action()
                })

                $(element).keyup(() => {
                    action()
                })
            })
        }

        $('#budgets_fieldset').hide();

        $('#cancelBtn').click(() => {
            $('#load-area').empty();

            $('li').each((index, element) => {
                $(element).removeClass('treeview-item-selected')
            })
            $('i').each((index, element) => {
                $(element).removeClass('treeview-action-item-selected')
            })
        })

        // Add datetimepicker
        $(`#date_init, #date_end`).datetimepicker({
            format: 'DD-MM-YYYY',
            locale: 'es-es',
            useCurrent: false,
            ignoreReadonly: true,
            minDate: moment('{{ $minDate }}', 'DD-MM-YYYY').millisecond(0).second(0).minute(0).hour(0),
            maxDate: moment('{{ $maxDate }}', 'DD-MM-YYYY').millisecond(0).second(59).minute(59).hour(23),
            viewDate: moment('{{ $minDate }}', 'DD-MM-YYYY').millisecond(0).second(0).minute(0).hour(0)
        });

        $(`#date_init, #date_end`).on('dp.hide', (e) => {
            setTimeout(() => {
                $(e.currentTarget).data('DateTimePicker').viewDate(moment('{{ $minDate }}', 'DD-MM-YYYY').millisecond(0).second(0).minute(0).hour(0))
            }, 1);
        });

        $(`#date_init`).on('dp.change', (e) => {
            $(`#date_end`).data('DateTimePicker').minDate(e.date)

            if ($(e.currentTarget).val() && $(`#date_end`).val()) {
                $('#referential_budget').val('');

                let values = $('input[name*="budgets"]').map((index, element) => {
                    return $(element).val();
                }).get();

                pushRequest('{{ route('loadannualbudgets.create.project.plan_elements.plans.plans_management') }}', '#load_annual_budgets', () => {
                    $('#budgets_fieldset').slideDown()
                    addBudgetsLogic()
                }, 'GET', {'years': diff_years($(`#date_end`).val(), $(e.currentTarget).val()), 'values': values}, false);

                $('#month_duration').val(diff_months($(`#date_end`).val(), $(e.currentTarget).val()));
                $('#execution_term').val(diff_years($(`#date_end`).val(), $(e.currentTarget).val()) > 0 ? '{{ $Project::EXECUTION_TERM_PLURIANNUAL }}' : '{{ $Project::EXECUTION_TERM_ANNUAL }}');
            }
        });

        $(`#date_end`).on('dp.change', (e) => {
            $(`#date_init`).data('DateTimePicker').maxDate(e.date)

            if ($(`#date_init`).val() && $(e.currentTarget).val()) {
                $('#referential_budget').val('');

                let values = $('input[name*="budgets"]').map((index, element) => {
                    return $(element).val();
                }).get();

                pushRequest('{{ route('loadannualbudgets.create.project.plan_elements.plans.plans_management') }}', '#load_annual_budgets', () => {
                    $('#budgets_fieldset').slideDown()
                    addBudgetsLogic()
                }, 'GET', {'years': diff_years($(e.currentTarget).val(), $(`#date_init`).val() ), 'values': values}, false);

                $('#month_duration').val(diff_months($(e.currentTarget).val(), $(`#date_init`).val()));
                $('#execution_term').val(diff_years($(e.currentTarget).val(), $(`#date_init`).val()) > 0 ? '{{ $Project::EXECUTION_TERM_PLURIANNUAL }}' : '{{ $Project::EXECUTION_TERM_ANNUAL }}');
            }
        });

        $validateDefaults.rules = {
            name: {
                required: true,
                maxlength: 200,
                minlength: 3
            },
            cup: {
                required: true,
                maxlength: 3,
                digits: true,
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    async: false,
                    data: {
                        fieldName: 'cup',
                        fieldValue: function () {
                            return $('#cup').val();
                        },
                        model: 'App\\Models\\Business\\Project',
                        filter: {
                            plan_element_id: '{{ $planElementId }}'
                        }
                    }
                }
            },
            description: {
                required: true
            },
            responsible_unit_id: {
                required: true
            },
            zone: {
                required: true,
                maxlength: 100
            },
            date_init: {
                required: true
            },
            date_end: {
                required: true
            },
            tir: {
                required: false,
                maxlength: 14,
                number: true,
                onlyTwoDecimal: true
            },
            van: {
                required: false,
                maxlength: 14,
                number: true,
                onlyTwoDecimal: true
            },
            benefit_cost: {
                required: false
            }
        };

        // Validar que solo tenga 2 decimales
        jQuery.validator.addMethod("onlyTwoDecimal", (value) => {
            let RE = /^-?\d*(\.\d{1})?\d{0,1}$/;
            if (RE.test(value)) {
                return true;
            } else {
                return false;
            }
        }, '{{ trans('projects.messages.errors.only_two_decimal') }}');

        $validateDefaults.messages = {
            cup: {
                remote: '{{ trans('projects.messages.validation.project_cup_exists') }}'
            }
        };

        $form.validate($validateDefaults);

        $('#submitBtn').click((e) => {
            e.preventDefault();

            if ($form.valid()) {

                let url = "{!! route('store.create.project.plan_elements.plans.plans_management') !!}";
                let formData = new FormData($form[0]);

                formData.append('plan_element_id', {{ $planElementId }})

                let callback = (data = null, options = null) => {
                    pushRequest(url, null, () => {
                        $('#load-area').empty();
                        $('#load-tree').empty();

                        const url = '{!! route('loadstructure.edit.plans.plans_management', ['id' => $planId]) !!}'
                        pushRequest(url, '#load-tree', () => {
                        }, 'GET', {'_token': '{!! csrf_token() !!}'}, false);

                    }, 'POST', data || formData, false, options || {form: true});
                };

                @if(isset($justifiable) && $justifiable)
                justificationModalMultiple(callback, formData, null, '{{ trans('justifications.actions.create') }}', true);
                @else
                callback();
                @endif
            }
        })

    });

</script>

@endpermission