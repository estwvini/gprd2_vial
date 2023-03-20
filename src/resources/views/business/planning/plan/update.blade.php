@permission('edit.plans.plans_management')

@inject('Plan', '\App\Models\Business\Plan')
@includeWhen($justifiable, 'business.planning.partials.justification.form_multiple', ['info' => trans('justifications.messages.default'), 'form' => true])

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('plans.title') }}
                <small>{{ trans('app.labels.administration') }}</small>
            </h3>
        </div>

        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.plans.plans_management')
                <li>
                    <a href="{{ route('index.plans.plans_management') }}" class="ajaxify"> {{ trans('plans.title') }}</a>
                </li>
                @endpermission

                <li class="active"> {{ trans('app.labels.edit') }}</li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        {{ trans('plans.labels.edit') }} {{ trans('plans.labels.' . $scope) }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        @permission('index.plans.plans_management')
                        <li class="pull-right">
                            <a href="{{ route('index.plans.plans_management') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                        @endpermission
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <form role="form" action="{{ route('update.edit.plans.plans_management', ['id' => $entity->id]) }}" method="post"
                      enctype="multipart/form-data"
                      class="form-horizontal form-label-left" id="businessPlansUpdateFm">

                    @method('PUT')
                    @csrf

                    @includeWhen($justifiable, 'business.planning.partials.justification.form', ['action' => trans('justifications.actions.update'), 'info' => trans('justifications.messages.default'), 'type' => 'submit'])

                    <div class="x_content">

                        <input class="hidden" name="scope" id="scope" value="{{ $scope }}">

                        <span class="section">{{ trans('plans.labels.info') }} {{ trans('plans.labels.' . $scope) }}</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">
                                {{ trans('plans.labels.is') }} {{ $planName }}?
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="checkbox" name="type_check" id="type_check" class="js-switch" disabled @if(in_array($entity->type, $fixedPlans)) checked @endif/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                {{ trans('plans.labels.name') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="name" id="name" maxlength="150"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('plans.placeholders.name') }}"
                                       value="{{ $entity->name }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vision">
                                {{ trans('plans.labels.vision') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="vision" id="vision" class="form-control col-md-7 col-sm-7 col-xs-12">{{ $entity->vision }}</textarea>
                            </div>
                        </div>

                        @if($scope == \App\Models\Business\Plan::SCOPE_INSTITUTIONAL)
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mission">
                                    {{ trans('plans.labels.mission') }}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="mission" id="mission" class="form-control col-md-7 col-sm-7 col-xs-12">{{ $entity->mission }}</textarea>
                                </div>
                            </div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="start_year">
                                {{ trans('plans.labels.startYear') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="start_year" id="startYear" maxlength="4"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('plans.placeholders.startYear') }}"
                                       value="{{ $entity->start_year }}"
                                       @if(in_array($entity->type, [$Plan::TYPE_PEI, $Plan::TYPE_PDOT]) || ($entity->status != $Plan::STATUS_DRAFT && $entity->type == $Plan::TYPE_SECTORAL)))
                                       disabled
                                       @endif
                                       autocomplete="off"
                                />
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="end_year">
                                {{ trans('plans.labels.endYear') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="end_year" id="endYear" maxlength="4"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('plans.placeholders.endYear') }}"
                                       value="{{ $entity->end_year }}"
                                       autocomplete="off"
                                       @if($draftPlan)
                                           disabled
                                    @endif
                                />
                            </div>
                        </div>

                        <div class="text-center">
                            @permission('index.plans.plans_management')
                            <a href="{{ route('index.plans.plans_management') }}" class="btn btn-info ajaxify">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </a>
                            @endpermission

                            @includeWhen($justifiable, 'business.planning.partials.justification.button')

                            @if(!$justifiable)
                                <button id="submitBtnPlan" class="btn btn-success">
                                    <i class="fa fa-check"></i> {{ trans('plans.labels.save') }}
                                </button>

                                @if (!count($entity->planElements) && in_array($entity->type, [$Plan::TYPE_PDOT, $Plan::TYPE_PEI]))
                                    <a class="btn btn-warning ajaxify" href="{{ route('replicate.plans.plans_management', ['plan' => $entity->id, 'type' => $entity->type]) }}">
                                        <i class="fa fa-copy"></i> {{ trans('plans.labels.replicate') }}
                                    </a>
                                @endif
                            @endif
                        </div>

                        <div class="separator col-lg-12 col-md-12 col-sm-12 col-xs-12"></div>

                        <div id="load-tree" class="col-lg-5 col-md-5 col-sm-5 col-xs-10 mt-3 pl-0"></div>

                        <div id="load-area" class="col-lg-7 col-md-7 col-sm-7 col-xs-10 mt-3 p-0"></div>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        const url = '{!! route('loadstructure.edit.plans.plans_management', ['id' => $entity->id]) !!}'

        pushRequest(url, '#load-tree', null, 'GET', {'_token': '{!! csrf_token() !!}'});

        let $form = $('#businessPlansUpdateFm');

        $validateDefaults.rules = {
            name: {
                required: true,
                minlength: 2,
                notEqualTo: '{!! implode(',',$fixedPlans) !!}',
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    data: {
                        fieldName: 'name',
                        fieldValue: () => {
                            return $('#name', $form).val();
                        },
                        model: 'App\\Models\\Business\\Plan',
                        current: '{{ $entity ->id }}'
                    }
                }
            },
            vision: {
                required: true
            },
            start_year: {
                required: true,
                digits: true,
                elt: '#endYear',
                // min: (new Date()).getFullYear(), //TODO this rule is disabled for now since we need to store old plans, maybe then it should be added
                minlength: 4,
                maxlength: 4
            },
            end_year: {
                required: true,
                digits: true,
                egt: '#startYear',
                minlength: 4,
                maxlength: 4
            },
            @if($justifiable)

            // Add rules to validate justification modal fields
            justificationDescription: {
                required: true,
                maxlength: 500
            },
            justificationFile: {
                required: true,
                extension: 'pdf'
            },
            justificationDocumentReference: {
                required: true,
                maxlength: 50
            }

            @endif
        };

        $validateDefaults.messages = {
            name: {
                remote: '{{ trans('plans.messages.validations.uniqueName') }}'
            }
        };

        $form.validate($validateDefaults);

        // Validate plan name
        jQuery.validator.addMethod("notEqualTo", function (value, element, param) {
            const fixedPlans = param.split(',');
            let valid = true;

            fixedPlans.forEach((plan) => {
                if (value.toLowerCase() == plan.toLowerCase()) {
                    valid = false;
                }
            });

            return valid;

        }, '{{ trans('plans.messages.validations.reservedName') }}');

        @if(in_array($entity->type, $fixedPlans))
        $("#name", $form).rules("remove", "notEqualTo");
        @endif

        // Start: Validate start and end year
        $.validator.addMethod("elt", (value, element, param) => {
            return parseInt(value) <= parseInt($(param).val()) || !$(param).val()
        }, '{{ trans('plans.messages.validations.elt') }}');

        $.validator.addMethod("egt", (value, element, param) => {
            return parseInt(value) >= parseInt($(param).val()) || !$(param).val()
        }, '{{ trans('plans.messages.validations.egt') }}');

        $('#startYear').keyup(() => {
            $('#endYear').valid()
        });

        $('#endYear').keyup(() => {
            $('#startYear').valid()
        });
        // End: Validate start and end year

        $form.ajaxForm($formAjaxDefaults);

        @if($entity->type == $Plan::TYPE_PEI )
        if ($('#startYear').valid()) {
            $('#endYear', $form).rules('add', {
                max: parseInt($('#startYear').val()) + {{ $Plan::PEI_DURATION }}
            })
        }
        @endif

        @if(in_array($entity->type, [$Plan::TYPE_PEI, $Plan::TYPE_PDOT, $Plan::TYPE_SECTORAL]))

        @if($entity->status == $Plan::STATUS_DRAFT)
        $('#startYear').on('change', () => {

            @if($entity->type == $Plan::TYPE_PEI )
            if ($('#endYear').val() == '' && $('#startYear').valid()) {
                $('#endYear').val(parseInt($('#startYear').val()) + {{ $Plan::PEI_DURATION }})
            }

            if ($('#startYear').valid()) {
                $('#endYear', $form).rules('add', {
                    max: parseInt($('#startYear').val()) + {{ $Plan::PEI_DURATION }}
                })
            }
            @endif

        });
        @endif

        @endif

        @if($justifiable)

        let permanotice = null

        $('#justificationBtn').click(() => {
            if ($('#startYear').val() != "{{ $entity->start_year }}" || $('#endYear').val() != "{{ $entity->end_year }}") {
                permanotice = notify('{{ trans('plans.messages.warning.changeDate') }}', 'warning', null, {
                        buttons: {
                            closer_hover: false,
                            sticker: false
                        },
                        hide: false
                    }
                )
            }
        })

        // Close modal before submit
        $form.submit((e) => {
            e.preventDefault()

            if (!$form.valid()) {
                return false;
            }

            if (permanotice && permanotice.remove) {
                permanotice.remove()
            }
            $('#justificationModal').modal('hide');
            return true;
        })

        // Custom justification modal dismiss
        $('#btnCancelJustification').removeAttr('data-dismiss')
        $('#btnCancelJustification').click(() => {
            if (permanotice && permanotice.remove) {
                permanotice.remove()
            }
            $('#justificationModal').modal('hide')
        })

        @else
        $('#submitBtnPlan').click((e) => {
            e.preventDefault()

            if ($form.valid()) {
                const url_submit = "{!! route('update.edit.plans.plans_management', ['id' => $entity->id]) !!}"
                let formData = new FormData($form[0]);

                if ($('#startYear').val() != "{{ $entity->start_year }}" || $('#endYear').val() != "{{ $entity->end_year }}") {
                    confirmModal('{{ trans('plans.messages.warning.changeDate') }}', () => {
                        pushRequest(url_submit, null, () => {

                        }, 'POST', formData, false, {form: true})
                    })
                } else {
                    pushRequest(url_submit, null, () => {

                    }, 'POST', formData, false, {form: true})
                }


            }
        })
        @endif
    });
</script>

@else
    @include('errors.403')

    @endpermission
