@permission('show.plan_elements.plans.plans_management')
@inject('PlanElement', '\App\Models\Business\PlanElement')

<div class="x_panel">
    <div class="x_title">
        <h2 class="align-center">{{ trans('plan_elements.labels.details', ['element' => trans('plan_elements.labels.'.$entity->type)])}}</h2>

        <div class="clearfix"></div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">

                <div class="pb-4">{!! $route !!}</div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="code">
                        @if (!in_array($type, [$PlanElement::TYPE_PROGRAM, $PlanElement::TYPE_SUBPROGRAM]))
                            {{ trans('plan_elements.labels.identifier') }}
                        @else
                            {{ trans('plan_elements.labels.code') }}
                        @endif
                    </label>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <input name="element_code" id="element_code" maxlength="45"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('plan_elements.placeholders.code') }}"
                               value="{{ $entity->code }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="description">
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
                    </label>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <textarea disabled name="description" id="description" rows="5" class="form-control col-md-7 col-sm-7 col-xs-12">{{ $entity->description }}</textarea>
                    </div>
                </div>

                @if(isset($type) && $type === $PlanElement::TYPE_PROGRAM)
                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="product">
                            {{ trans('plan_elements.labels.product') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea disabled name="product" id="product" class="form-control" rows="5" maxlength="500">{{ $entity->product }}</textarea>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="production_goal">
                            {{ trans('plan_elements.labels.production_goal') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea disabled name="production_goal" id="production_goal" class="form-control" rows="5" maxlength="500">{{ $entity->production_goal }}</textarea>
                        </div>
                    </div>
                @endif

                <div class="pull-right">
                    <button id="acceptBtn" class="btn btn-info"><i class="fa fa-times"></i> {{ trans('app.labels.close') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(() => {

        $('textarea').css("min-height", "35px");

        $('#acceptBtn').click(() => {
            $('#load-area').empty();

            $('li').each((index, element) => {
                $(element).removeClass('treeview-item-selected')
            })
            $('i').each((index, element) => {
                $(element).removeClass('treeview-action-item-selected')
            })
        })

    });

</script>

@endpermission