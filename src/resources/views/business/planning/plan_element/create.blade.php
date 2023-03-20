@permission('create.plan_elements.plans.plans_management')

@inject('PlanElement', '\App\Models\Business\PlanElement')

<div class="x_panel">
    <div class="x_title">
        <h2 class="align-center">{{ trans('plan_elements.labels.create', ['element' => trans('plan_elements.labels.'.$data['element_type'])])}}</h2>

        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                <form role="form" action="{{ route('store.create.plan_elements.plans.plans_management') }}" method="post"
                      enctype="multipart/form-data"
                      class="form-horizontal form-label-left" id="planElementFormCreate" novalidate>

                    @method('POST')
                    @csrf

                    <div class="pb-4">{!! $route !!}</div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="element_code">
                            @if (!in_array($type, [$PlanElement::TYPE_PROGRAM, $PlanElement::TYPE_SUBPROGRAM]))
                                {{ trans('plan_elements.labels.identifier') }}
                            @else
                                {{ trans('plan_elements.labels.code') }}
                            @endif
                            <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="element_code" id="element_code" maxlength="45"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('plan_elements.placeholders.code') }}"
                                   @if(in_array($data['element_type'], [$PlanElement::TYPE_PROGRAM, $PlanElement::TYPE_SUBPROGRAM] )) value="{{ $code }}" disabled @endif/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="element_description">
                            @switch($type)
                                @case($PlanElement::TYPE_PROGRAM)
                                {{ trans('plan_elements.labels.program_name') }}
                                @break
                                @case($PlanElement::TYPE_SUBPROGRAM)
                                {{ trans('plan_elements.labels.subprogram_name') }}
                                @break
                                @default
                                {{ trans('plan_elements.labels.description') }}
                            @endswitch
                            <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea name="element_description" id="element_description" rows="5" class="form-control"></textarea>
                        </div>
                    </div>

                    @if(isset($type) && $type === $PlanElement::TYPE_PROGRAM)
                        <div class="item form-group">
                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="product">
                                {{ trans('plan_elements.labels.product') }}
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea name="product" id="product" class="form-control" rows="5" maxlength="500"></textarea>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="production_goal">
                                {{ trans('plan_elements.labels.production_goal') }}
                            </label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea name="production_goal" id="production_goal" class="form-control" rows="5" maxlength="500"></textarea>
                            </div>
                        </div>
                    @endif

                    <div class="pull-right">
                        <button id="cancelBtn" type="button" class="btn btn-info"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
                        <button id="submitBtn" class="btn btn-success"><i
                                    class="fa fa-check"></i> {{ trans('app.labels.save') }} {{ trans('plan_elements.labels.' . $data['element_type']) }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(() => {

        $('textarea').css("min-height", "35px");

        $('#cancelBtn').click(() => {
            $('#load-area').empty();

            $('li').each((index, element) => {
                $(element).removeClass('treeview-item-selected')
            })
            $('i').each((index, element) => {
                $(element).removeClass('treeview-action-item-selected')
            })
        })

        let $form = $('#planElementFormCreate');

        $validateDefaults.rules = {
            element_code: {
                required: true,
                minlength: 2,
                maxlength: 45,
                digits: true,
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    async: false,
                    data: {
                        fieldName: 'code',
                        fieldValue: function () {
                            return $('#element_code').val();
                        },
                        model: 'App\\Models\\Business\\PlanElement',
                        filter: {
                            plan_id: '{{ $data['plan_id'] }}',
                            parent_id: '{{ isset($data['parent_id']) ? $data['parent_id'] : null }}',
                            type: '{{ $data['element_type'] }}'
                        }
                    }
                }
            },
            element_description: {
                required: true
            },
            @if(isset($type) && $type === $PlanElement::TYPE_PROGRAM)
            product: {
                maxlength: 500
            },
            production_goal: {
                maxlength: 500
            }
            @endif
        };

        $validateDefaults.messages = {
            element_code: {
                remote: '{{ trans('plan_elements.messages.validations.uniqueCode', ['element'=> trans('plan_elements.labels.'.$data['element_type'])]) }}'
            }
        };

        $form.validate($validateDefaults);

        $('#submitBtn').click((e) => {
            e.preventDefault()

            if ($form.valid()) {

                let url = "{!! route('store.create.plan_elements.plans.plans_management') !!}";
                let jsonData = {
                    _token: '{{ csrf_token() }}',
                    code: $('#element_code').val(),
                    description: $('#element_description').val(),
                    plan_id: '{{ $data['plan_id'] }}',
                    parent_id: '{{ isset($data['parent_id']) ? $data['parent_id'] : null }}',
                    type: '{{ $data['element_type'] }}',
                    @if(isset($type) && $type === $PlanElement::TYPE_PROGRAM)
                    product: $('#product').val(),
                    production_goal: $('#production_goal').val(),
                    @endif
                };

                let callback = (data = null, options = null) => {
                    pushRequest(url, null, () => {
                        $('#load-area').empty();
                        $('#load-tree').empty();

                        const url = '{!! route('loadstructure.edit.plans.plans_management', ['id' => $data['plan_id']]) !!}'
                        pushRequest(url, '#load-tree', () => {
                        }, 'GET', {'_token': '{!! csrf_token() !!}'}, false);

                    }, 'POST', data || jsonData, false, options);
                };

                @if(isset($justifiable) && $justifiable)
                justificationModalMultiple(callback, jsonData, null, '{{ trans('justifications.actions.create') }}');
                @else
                callback();
                @endif
            }
        })

    });

</script>

@endpermission