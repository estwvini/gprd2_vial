@permission('create.small.indicator.plan_elements.plans.plans_management')
<div class="x_panel">
    <div class="x_title">
        <h2 class="align-center">{{ trans('indicators.labels.create') }}</h2>

        <div class="clearfix"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="x_content">
                <form role="form" method="post"
                      enctype="multipart/form-data"
                      class="form-horizontal form-label-left" id="smallIndicatorFormCreate">

                    @method('POST')
                    @csrf

                    <div class="pb-4">{!! $route !!}</div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="indicator_name">
                            {{ trans('plan_elements.labels.name') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="indicator_name" id="indicator_name" maxlength="100"
                                   class="form-control col-md-7 col-sm-7 col-xs-12"
                                   placeholder="{{ trans('plan_elements.placeholders.name') }}"/>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="indicator_description">
                            {{ trans('plan_elements.labels.description') }}
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea name="indicator_description" id="indicator_description" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="item form-group">
                        <label class="control-label col-lg-3 col-md-3 col-sm-3 col-xs-12" for="indicator_goal">
                            {{ trans('plan_elements.labels.GOAL') }} <span class="required text-danger">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea name="indicator_goal" id="indicator_goal" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="pull-right">
                        <button id="cancelBtn" type="button" class="btn btn-info"><i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}</button>
                        <button id="submitBtn" class="btn btn-success"><i class="fa fa-check"></i> {{ trans('app.labels.save') }} {{ trans('plan_elements.labels.INDICATOR') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>

    $(() => {

        $('#cancelBtn').click(() => {
            $('#load-area').empty();

            $('li').each((index, element) => {
                $(element).removeClass('treeview-item-selected')
            })
            $('i').each((index, element) => {
                $(element).removeClass('treeview-action-item-selected')
            })
        })

        let $form = $('#smallIndicatorFormCreate');

        $validateDefaults.rules = {
            indicator_name: {
                maxlength: 100,
                minlength: 4,
                required: true
            },
            indicator_goal: {
                required: true
            }
        };

        $validateDefaults.messages = {};

        $form.validate($validateDefaults);


        $('#submitBtn').click((e) => {
            e.preventDefault()

            if ($form.valid()) {

                let url = "{!! route('store.create.small.indicator.plan_elements.plans.plans_management') !!}";

                pushRequest(url, null, () => {
                    $('#load-area').empty();
                    $('#load-tree').empty();

                    const url = '{!! route('loadstructure.edit.plans.plans_management', ['id' => $planId]) !!}'
                    pushRequest(url, '#load-tree', () => {
                    }, 'GET', {'_token': '{!! csrf_token() !!}'}, false);

                }, 'POST', {
                    _token: '{{ csrf_token() }}',
                    name: $('#indicator_name').val(),
                    description: $('#indicator_description').val(),
                    goal_description: $('#indicator_goal').val(),
                    creator_user_id: {{ currentUser()->id }},
                    status: '{{ \App\Models\Business\PlanIndicator::STATUS_FIXED }}',
                    planElementId: '{{ $planElementId }}',
                }, false);

            }
        })

    });

</script>

@endpermission