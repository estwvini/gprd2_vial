@permission('edit.operational_goals.plans_management')
@inject('OperationalGoal', '\App\Models\Business\Planning\OperationalGoal')

<div class="x_panel">
    <div class="x_title">
        <h2 class="align-center">{{ trans('operational_goals.labels.update') }}</h2>

        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                <form role="form" method="post" class="form-horizontal form-label-left" id="operationalGoalsFormUpdate">

                    <div class="pb-4">{!! $route !!}</div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="element_code">
                            {{ trans('current_expenditure.labels.code') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="element_code" id="element_code" maxlength="45"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('operational_goals.placeholders.code') }}"
                                   value="{{ $entity->code }}"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="element_name">
                            {{ trans('operational_goals.labels.name') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="element_name" id="element_name" maxlength="500"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('operational_goals.placeholders.name') }}"
                                   value="{{ $entity->name }}"/>
                        </div>
                    </div>

                    <div class="pull-right">
                        <button id="cancelBtn" type="button" class="btn btn-info"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
                        <button id="submitBtn" class="btn btn-success"><i
                                    class="fa fa-check"></i> {{ trans('app.labels.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(() => {

        $('#cancelBtn').click(() => {
            $('#load-area').empty()

            $('li').each((index, element) => {
                $(element).removeClass('treeview-item-selected')
            })
            $('i').each((index, element) => {
                $(element).removeClass('treeview-action-item-selected')
            })
        })

        let operationalGoalsFormUpdate = $('#operationalGoalsFormUpdate')

        operationalGoalsFormUpdate.validate($.extend(false, $validateDefaults, {
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
                            model: 'App\\Models\\Business\\Planning\\OperationalGoal',
                            current: '{{ $entity ->id }}',
                            filter: {
                                fiscal_year_id: '{{ $fiscal_year_id }}'
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
                            model: 'App\\Models\\Business\\Planning\\OperationalGoal',
                            current: '{{ $entity ->id }}',
                            filter: {
                                fiscal_year_id: '{{ $fiscal_year_id }}'
                            }
                        }
                    }
                }
            },
            messages: {
                element_code: {
                    remote: '{{ trans('operational_goals.messages.validations.uniqueCode') }}'
                },
                element_name: {
                    remote: '{{ trans('operational_goals.messages.validations.uniqueName') }}'
                }
            }
        }))

        operationalGoalsFormUpdate.ajaxForm($.extend(false, $formAjaxDefaults, {}))

        $('#submitBtn').click((e) => {
            e.preventDefault()

            if (operationalGoalsFormUpdate.valid()) {

                let url = "{!! route('update.edit.operational_goals.plans_management', ['id' => $entity->id]) !!}"
                let jsonData = {
                    _token: '{{ csrf_token() }}',
                    name: $('#element_name').val(),
                    code: $('#element_code').val(),
                    fiscal_year_id: {{ $fiscal_year_id }},
                    plan_element_id: {{ $plan_element_id }}
                }

                pushRequest(url, null, () => {
                    $('#load-area').empty()
                    $('#load-tree').empty()

                    const url = '{!! route('loadstructure.operational_goals.plans_management') !!}'
                    pushRequest(url, '#load-tree', null, 'GET', {'_token': '{!! csrf_token() !!}'}, false)

                }, 'PUT', jsonData, false)
            }
        })
    })

</script>

@else
    @include('errors.403')
@endpermission