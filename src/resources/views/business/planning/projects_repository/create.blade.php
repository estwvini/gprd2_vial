@inject('Project', '\App\Models\Business\Project')

<div id="myModal" class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-product-hunt"></i> {{ trans('projects.labels.new') }}
        </h4>
    </div>
    <form role="form" action="{{ route('store.create.index.projects_repository.plans_management') }}" method="post" class="form-horizontal form-label-left" id="projectForm">

        <div class="modal-body">

            @csrf

            <input type="hidden" name="old_project_id" value="{{ $oldProject->id }}">
            <input type="hidden" value="1" name="edit_budget">


            <fieldset>
                <legend class="scheduler-border">{{ $plan->name }}</legend>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="objective">
                        {{ trans('plan_elements.labels.OBJECTIVE') }} <span class="required text-danger">*</span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <select class="form-control select2 select2_type" id="objective" name="objective">
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($objectives as $obj)
                                <option value="{{ $obj->id }}">{{ $obj->code . ' - ' .  $obj->description }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="program">
                        {{ trans('plan_elements.labels.PROGRAM') }} <span class="required text-danger">*</span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <select class="form-control select2 select2_type" id="program" name="program" disabled>
                            <option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>
                        </select>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="plan_element_id">
                        {{ trans('plan_elements.labels.SUBPROGRAM') }} <span class="required text-danger">*</span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <select class="form-control select2 select2_type" id="plan_element_id" name="plan_element_id" disabled>
                            <option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>
                        </select>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend class="scheduler-border">{{ trans('projects.labels.project') }}</legend>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="project_name">
                        {{ trans('plan_elements.labels.project_name') }} <span class="required text-danger">*</span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input name="name" id="project_name" maxlength="200"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('projects.placeholders.name') }}" autocomplete="off"
                               value="{{ $oldProject->name }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="cup">
                        {{ trans('projects.labels.cup') }} <span class="required text-danger">*</span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="number" name="cup" id="cup" maxlength="3"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('projects.placeholders.cup') }}" autocomplete="off" value="" disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="description">
                        {{ trans('plan_elements.labels.description') }} <span class="required text-danger">*</span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea name="description" id="description" class="form-control">{{ $oldProject->description }}</textarea>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="is_road">
                        {{ trans('plan_elements.labels.isRoad') }}
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input type="checkbox" name="is_road" id="is_road" class="js-switch" @if($oldProject->is_road) checked @endif/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="responsible_unit_id">
                        {{ trans('plan_elements.labels.responsibleUnit') }} <span class="required text-danger">*</span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <select class="form-control select2 select2_type" id="responsible_unit_id" name="responsible_unit_id" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($responsibleUnits as $value)
                                <option value="{{ $value->id }}"
                                        @if($oldProject->responsible_unit_id == $value->id) selected @endif >{{$value->code . '-' .  $value->name }}</option>
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
                               placeholder="{{ trans('projects.placeholders.zone') }}" autocomplete="off"
                               value="{{ $oldProject->zone }}"/>
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
                               disabled value="{{ $oldProject->month_duration }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="execution_term">
                        {{ trans('projects.labels.execution_term') }}
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input name="execution_term" id="execution_term" maxlength="100"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               disabled value="{{ $oldProject->execution_term }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="tir">
                        {{ trans('projects.labels.tir') }}
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input name="tir" id="tir"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               value="{{ $oldProject->tir }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="van">
                        {{ trans('projects.labels.van') }}
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input name="van" id="van"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               value="{{ $oldProject->van }}"/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="benefit_cost">
                        {{ trans('projects.labels.benefit_cost') }}
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea name="benefit_cost" id="benefit_cost"
                                      class="form-control col-md-7 col-sm-7 col-xs-12"
                                      placeholder="{{ trans('projects.placeholders.benefit_cost') }}">{{ $oldProject->benefit_cost }}</textarea>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="fiscal_year_id">
                        {{ trans('projects.labels.select_year') }} <span class="required text-danger">*</span>
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <select class="form-control select2 select2_type" id="fiscal_year_id" name="fiscal_year_id" required>
                            <option value="">{{ trans('app.labels.select') }}</option>
                            @foreach($oldProject->fiscalYears as $fiscalYear)
                                <option value="{{ $fiscalYear->id }}">{{ $fiscalYear->year }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

            </fieldset>

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

        </div>

        <div class="modal-footer">
            <button id="cancelBtn" type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
            <button id="submitBtn" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.save') }} {{ trans('plan_elements.labels.PROJECT') }}</button>
        </div>
    </form>

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
        };

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
        };

        let $form = $('#projectForm');

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
                    min: 1,
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
                }, 'GET', {'years': diff_years($(e.currentTarget).val(), $(`#date_init`).val()), 'values': values}, false);

                $('#month_duration').val(diff_months($(e.currentTarget).val(), $(`#date_init`).val()));
                $('#execution_term').val(diff_years($(e.currentTarget).val(), $(`#date_init`).val()) > 0 ? '{{ $Project::EXECUTION_TERM_PLURIANNUAL }}' : '{{ $Project::EXECUTION_TERM_ANNUAL }}');
            }
        });

        $validateDefaults.rules = {
            name: {
                required: true,
                maxlength: 200,
                minlength: 3,
            },
            description: {
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
            },
            objective: {
                required: true
            },
            program: {
                required: true
            },
            plan_element_id: {
                required: true
            },
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
            name: {
                remote: '{{ trans('projects.messages.validation.project_name_exists') }}'
            },
            cup: {
                remote: '{{ trans('projects.messages.validation.project_cup_exists') }}'
            }
        };

        $form.validate($validateDefaults);
        let datatable = $('#projects_repository_tb').DataTable();
        $form.ajaxForm($.extend(false, $formAjaxDefaults, {
            success: (response) => {
                processResponse(response, null, () => {
                    $validateDefaults.rules = {};
                    $validateDefaults.messages = {};
                    $modal.modal('hide');
                    datatable.draw();
                });
            }
        }));

        let objective = $('#objective').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', () => {
            program.html('');
            program.prop("disabled", true);
            program.append('<option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>');

            plan_element_id.html('');
            plan_element_id.prop("disabled", true);
            plan_element_id.append('<option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>');

            let url = '{{ route('search.index.projects_repository.plans_management', ['element' => '__ID__']) }}';
            url = url.replace('__ID__', objective.val());

            pushRequest(url, null, (response) => {
                let opt = [];
                $.each(response, (index, value) => {
                    opt.push({
                        id: value.id,
                        text: value.code + ' - ' + value.description
                    });
                });
                program.select2({
                    data: opt
                });
                if (opt.length > 0) {
                    program.prop("disabled", false);
                }
            }, 'get', null, false)
        });

        let program = $('#program').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        }).on('change', () => {

            plan_element_id.html('');
            plan_element_id.prop("disabled", true);
            plan_element_id.append('<option value="">{{ html_entity_decode(trans("app.placeholders.select")) }}</option>');

            let url = '{{ route('search.index.projects_repository.plans_management', ['element' => '__ID__']) }}';
            url = url.replace('__ID__', program.val());

            pushRequest(url, null, (response) => {
                let opt = [];
                $.each(response, (index, value) => {
                    opt.push({
                        id: value.id,
                        text: value.code + ' - ' + value.description
                    });
                });
                plan_element_id.select2({
                    data: opt
                });
                if (opt.length > 0) {
                    plan_element_id.prop("disabled", false);
                }
            }, 'get', null, false)
        });

        let plan_element_id = $('#plan_element_id').select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        });

    });
</script>