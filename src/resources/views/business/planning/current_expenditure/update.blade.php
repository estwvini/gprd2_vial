@permission('edit.current_expenditure_elements.budget.plans_management')
@inject('CurrentExpenditureElement', '\App\Models\Business\Planning\CurrentExpenditureElement')

<div class="x_panel">
    <div class="x_title">
        <h2 class="align-center">{{ trans('current_expenditure.labels.update', ['element' => trans('current_expenditure.labels.' . $type)]) }}</h2>

        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                <form role="form" method="post" class="form-horizontal form-label-left" id="currentExpenditureElementFormCreate">

                    <div class="pb-4">{!! $route !!}</div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="element_code">
                            {{ trans('current_expenditure.labels.code') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="element_code" id="element_code" maxlength="2"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('current_expenditure.placeholders.code') }}"
                                   value="{{ $entity->code }}" disabled/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="element_name">
                            {{ trans('current_expenditure.labels.name', ['element' => trans('current_expenditure.labels.' . $type)]) }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="element_name" id="element_name" maxlength="500"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('current_expenditure.placeholders.name') }}"
                                   value="{{ $entity->name }}"/>
                        </div>
                    </div>

                    @if(isset($type) && $type === $CurrentExpenditureElement::TYPE_PROGRAM)
                        <div class="item form-group">
                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="area_id">
                                {{ trans('operational_activities.labels.area') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <select class="form-control select2" id="area_id" name="area_id">
                                    <option value=""></option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}" @if($area->id === $entity->area_id) selected @endif>{{ $area->code . ' ' . $area->area }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif

                    <div class="pull-right">
                        <button id="cancelBtn" type="button" class="btn btn-info"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
                        <button id="submitBtn" class="btn btn-success"><i
                                    class="fa fa-check"></i> {{ trans('app.labels.save') }} {{ trans('plan_elements.labels.' . $type) }}</button>
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

        let currentExpenditureElementForm = $('#currentExpenditureElementFormCreate')

        let validator = currentExpenditureElementForm.validate($.extend(false, $validateDefaults, {
            rules: {
                element_code: {
                    required: true,
                    minlength: 2,
                    maxlength: 2,
                    digits: true,
                    remote: {
                        url: "{!! route('checkuniquefield') !!}",
                        async: false,
                        data: {
                            fieldName: 'code',
                            fieldValue: () => {
                                return $('#element_code').val()
                            },
                            model: 'App\\Models\\Business\\Planning\\CurrentExpenditureElement',
                            current: '{{ $entity ->id }}',
                            filter: {
                                parent_id: '{{ isset($parent_id) ? $parent_id : null }}',
                                type: '{{ $type }}'
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
                            model: 'App\\Models\\Business\\Planning\\CurrentExpenditureElement',
                            current: '{{ $entity ->id }}',
                            filter: {
                                parent_id: '{{ isset($parent_id) ? $parent_id : null }}',
                                type: '{{ $type }}',
                                @if(isset($type) && $type === $CurrentExpenditureElement::TYPE_PROGRAM)
                                fiscal_year_id: '{{ nextFiscalYear()->id }}'
                                @endif
                            }
                        }
                    }
                },
                @if(isset($type) && $type === $CurrentExpenditureElement::TYPE_PROGRAM)
                area_id: {
                    required: true
                }
                @endif
            },
            messages: {
                element_code: {
                    remote: '{{ trans('current_expenditure.messages.validations.uniqueCode', ['element'=> trans('current_expenditure.labels.' . $type)]) }}'
                },
                element_name: {
                    remote: '{{ trans('current_expenditure.messages.validations.uniqueName', ['element'=> trans('current_expenditure.labels.' . $type)]) }}'
                }
            }
        }))

        // Validate selects on change
        selectInputs.each((index, element) => {
            $(element).on('change', () => {
                validator.element(element)
            })
        })

        currentExpenditureElementForm.ajaxForm($.extend(false, $formAjaxDefaults, {}))

        $('#submitBtn').click((e) => {
            e.preventDefault()

            if (currentExpenditureElementForm.valid()) {

                let url = "{!! route('update.edit.current_expenditure_elements.budget.plans_management', ['id' => $entity->id]) !!}"
                let jsonData = {
                    _token: '{{ csrf_token() }}',
                    name: $('#element_name').val(),
                    type: '{{ $type }}',
                    @if(isset($parent_id))
                    parent_id: '{{ $parent_id }}',
                    @endif
                    @if(isset($type) && $type === $CurrentExpenditureElement::TYPE_PROGRAM)
                    area_id: $('#area_id').val()
                    @endif
                }

                pushRequest(url, null, () => {
                    $('#load-area').empty()
                    $('#load-tree').empty()

                    const url = '{!! route('loadstructure.current_expenditure_elements.budget.plans_management') !!}'
                    pushRequest(url, '#load-tree', null, 'GET', {'_token': '{!! csrf_token() !!}'}, false)

                }, 'PUT', jsonData, false)
            }
        })
    })

</script>

@else
    @include('errors.403')
@endpermission