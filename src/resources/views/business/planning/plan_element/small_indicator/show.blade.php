@permission('show.plan_elements.plans.plans_management')
<div class="x_panel">
    <div class="x_title">
        <h2 class="align-center">{{ trans('plan_elements.labels.details', ['element' => trans('plan_elements.labels.INDICATOR')])}}</h2>

        <div class="clearfix"></div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">

                <div class="pb-4">{!! $route !!}</div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="indicator_name">
                        {{ trans('plan_elements.labels.name') }}
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <input name="indicator_name" id="indicator_name" maxlength="45"
                               class="form-control col-md-7 col-sm-7 col-xs-12"
                               placeholder="{{ trans('plan_elements.placeholders.name') }}"
                               value="{{ $entity->name }}"
                               disabled/>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="indicator_description">
                        {{ trans('plan_elements.labels.description') }}
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea disabled name="indicator_description" id="indicator_description" class="form-control">{{ $entity->description }}</textarea>
                    </div>
                </div>

                <div class="item form-group">
                    <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="indicator_goal">
                        {{ trans('plan_elements.labels.GOAL') }}
                    </label>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <textarea disabled name="indicator_goal" id="indicator_goal" class="form-control">{{ $entity->goal_description }}</textarea>
                    </div>
                </div>

                <div class="pull-right">
                    <button id="acceptBtn" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.accept') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(() => {

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