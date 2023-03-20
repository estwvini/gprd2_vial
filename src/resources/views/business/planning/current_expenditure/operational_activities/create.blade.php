@permission('create.operational_activities.current_expenditure_elements.budget.plans_management')

<div class="x_panel">
    <div class="x_title">
        <h2 class="align-center">{{ trans('operational_activities.labels.create') }}</h2>

        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                <form role="form" method="post" class="form-horizontal form-label-left" id="operationalActivityFormCreate">

                    <div class="pb-4">{!! $route !!}</div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="element_code">
                            {{ trans('operational_activities.labels.code') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="element_code" id="element_code" maxlength="3"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('operational_activities.placeholders.code') }}"
                                   @if(isset($code)) value="{{ $code }}" disabled @endif/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="element_name">
                            {{ trans('operational_activities.labels.name') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="element_name" id="element_name" maxlength="500"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('operational_activities.placeholders.name') }}"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="responsible_unit_id">
                            {{ trans('operational_activities.labels.responsibleUnit') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control select2" id="responsible_unit_id" name="responsible_unit_id">
                                <option value=""></option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="executing_unit_id">
                            {{ trans('operational_activities.labels.executingUnit') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select class="form-control select2" id="executing_unit_id" name="executing_unit_id">
                                <option value=""></option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="pull-right">
                        <button id="cancelBtn" type="button" class="btn btn-info"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
                        <button id="submitBtn" class="btn btn-success">
                            <i class="fa fa-check"></i> {{ trans('app.labels.save') }} {{ trans('operational_activities.labels.OPERATIONAL_ACTIVITY') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(() => {

        let selectInputs = $('.select2')

        // Initialize selects
        selectInputs.select2({
            placeholder: "{{ html_entity_decode(trans('app.placeholders.select')) }}"
        })

        $('#cancelBtn').click(() => {
            $('#load-area').empty()

            $('li').each((index, element) => {
                $(element).removeClass('treeview-item-selected')
            })
            $('i').each((index, element) => {
                $(element).removeClass('treeview-action-item-selected')
            })
        })

        let operationalActivityForm = $('#operationalActivityFormCreate')

        let validator = operationalActivityForm.validate($.extend(false, $validateDefaults, {
            rules: {
                element_code: {
                    required: true,
                    minlength: 3,
                    maxlength: 3,
                    digits: true,
                    remote: {
                        url: "{!! route('checkuniquefield') !!}",
                        async: false,
                        data: {
                            fieldName: 'code',
                            fieldValue: () => {
                                return $('#element_code').val()
                            },
                            model: 'App\\Models\\Business\\Planning\\OperationalActivity',
                            filter: {
                                current_expenditure_element_id: '{{ isset($current_expenditure_element_id) ? $current_expenditure_element_id : null }}'
                            }
                        }
                    }
                },
                element_name: {
                    required: true,
                    minlength: 3,
                    maxlength: 500,
                    remote: {
                        url: "{!! route('checkuniquefield') !!}",
                        async: false,
                        data: {
                            fieldName: 'name',
                            fieldValue: () => {
                                return $('#element_name').val()
                            },
                            model: 'App\\Models\\Business\\Planning\\OperationalActivity',
                            filter: {
                                current_expenditure_element_id: '{{ isset($current_expenditure_element_id) ? $current_expenditure_element_id : null }}'
                            }
                        }
                    }
                },
                responsible_unit_id: {
                    required: true
                },
                executing_unit_id: {
                    required: true
                }
            },
            messages: {
                element_code: {
                    remote: '{{ trans('current_expenditure.messages.validations.uniqueCode') }}'
                },
                element_name: {
                    remote: '{{ trans('current_expenditure.messages.validations.uniqueName') }}'
                }
            }
        }))

        // Validate selects on change
        selectInputs.each((index, element) => {
            $(element).on('change', () => {
                validator.element(element)
            })
        })

        operationalActivityForm.ajaxForm($.extend(false, $formAjaxDefaults, {}))

        $('#submitBtn').click((e) => {
            e.preventDefault()

            if (operationalActivityForm.valid()) {

                let url = "{!! route('store.create.operational_activities.current_expenditure_elements.budget.plans_management') !!}"
                let jsonData = {
                    _token: '{{ csrf_token() }}',
                    name: $('#element_name').val(),
                    responsible_unit_id: $('#responsible_unit_id').val(),
                    executing_unit_id: $('#executing_unit_id').val(),
                    @if(isset($current_expenditure_element_id))
                    current_expenditure_element_id: '{{ $current_expenditure_element_id }}',
                    @endif
                }

                pushRequest(url, null, () => {
                    $('#load-area').empty()
                    $('#load-tree').empty()

                    const url = '{!! route('loadstructure.current_expenditure_elements.budget.plans_management') !!}'
                    pushRequest(url, '#load-tree', null, 'GET', {'_token': '{!! csrf_token() !!}'}, false)

                }, 'POST', jsonData, false)
            }
        })
    })
</script>

@else
    @include('errors.403')
    @endpermission