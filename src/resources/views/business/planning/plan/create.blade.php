@permission('create.plans.plans_management')

@inject('Plan', '\App\Models\Business\Plan')

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

                <li class="active"> {{ trans('app.labels.new') }}</li>
            </ol>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>
                        {{ trans('plans.labels.new') }} {{ trans('plans.labels.' . $scope) }}
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

                <div class="x_content">
                    <form role="form" action="{{ route('store.create.plans.plans_management') }}" method="post"
                          enctype="multipart/form-data"
                          class="form-horizontal form-label-left" id="businessPlansCreateFm" novalidate>

                        @csrf

                        <input class="hidden" name="scope" id="scope" value="{{ $scope }}">

                        <span class="section">{{ trans('plans.labels.info') }} {{ trans('plans.labels.' . $scope) }}</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">
                                {{ trans('plans.labels.is') }} {{ $planName }}?
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="checkbox" name="type_check" id="type_check" class="js-switch"/>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="type" name="type" type="hidden" value="{{ $planName }}">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                                {{ trans('plans.labels.name') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="name" id="name" maxlength="150"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('plans.placeholders.name') }}" autocomplete="off"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="vision">
                                {{ trans('plans.labels.vision') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="vision" id="vision" class="form-control col-md-7 col-sm-7 col-xs-12"></textarea>
                            </div>
                        </div>

                        @if($scope == $Plan::SCOPE_INSTITUTIONAL)
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mission">
                                    {{ trans('plans.labels.mission') }}
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="mission" id="mission" class="form-control col-md-7 col-sm-7 col-xs-12"></textarea>
                                </div>
                            </div>
                        @endif

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="startYear">
                                {{ trans('plans.labels.startYear') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="start_year" id="startYear" maxlength="4"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('plans.placeholders.startYear') }}" autocomplete="off"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="endYear">
                                {{ trans('plans.labels.endYear') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="end_year" id="endYear" maxlength="4"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('plans.placeholders.endYear') }}" autocomplete="off"/>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            @permission('index.plans.plans_management')
                            <a href="{{ route('index.plans.plans_management') }}" class="btn btn-info ajaxify">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </a>
                            @endpermission
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> {{ trans('plans.labels.save') }}
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(() => {

        let $form = $('#businessPlansCreateFm');

        $validateDefaults.rules = {
            name: {
                required: true,
                minlength: 2,
                remote: {
                    url: "{!! route('checkuniquefield') !!}",
                    data: {
                        fieldName: 'name',
                        fieldValue: function () {
                            return $('#name', $form).val();
                        },
                        model: 'App\\Models\\Business\\Plan'
                    }
                }
            },
            type: {
                remote: {
                    url: "{!! route('checktype.create.plans.plans_management') !!}",
                    data: {
                        type: () => {
                            return $("#type", $form).val();
                        },
                        type_check: () => {
                            return $("#type_check", $form).prop('checked');
                        }
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
                maxlength: 4,
                remote: {
                    url: "{!! route('check_start_year.create.plans.plans_management') !!}",
                    data: {
                        fieldName: 'start_year',
                        year: () => {
                            return $('#startYear', $form).val();
                        },
                        type: () => {
                            return $('#type', $form).val();
                        },
                        type_check: () => {
                            return $('#type_check', $form).prop('checked');
                        }
                    }
                }
            },
            end_year: {
                required: true,
                digits: true,
                egt: '#startYear',
                minlength: 4,
                maxlength: 4
            }
        };

        $validateDefaults.messages = {
            name: {
                remote: '{{ trans('plans.messages.validations.uniqueName') }}'
            },
            type: {
                remote: '{{ trans('plans.messages.validations.checkType1') }} {{ $planName }} {{ trans('plans.messages.validations.checkType2') }}'
            },
            start_year: {
                remote: '{{ trans('plans.messages.validations.checkStartYear') }}'
            }
        };

        $form.validate($validateDefaults);

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

        @if($scope == $Plan::SCOPE_INSTITUTIONAL)
        $('#startYear').on('change', () => {
            if ($('#endYear').val() == '' && $('#startYear').valid()) {
                $('#endYear').val(parseInt($('#startYear').val()) + 5)
            }

            if ($('#startYear').valid()) {
                $('#endYear', $form).rules('add', {
                    max: parseInt($('#startYear').val()) + {{ $Plan::PEI_DURATION }}
                })
            }
        });
        @endif

        $('#endYear').keyup(() => {
            $('#startYear').valid()
        });
        // End: Validate start and end year

        $('#type_check').change((e) => {
            if ($(e.currentTarget).prop('checked')) {
                @if($planAlreadyExists)
                $('#startYear').val({{ $startYear }})
                $('#startYear').attr('readonly', true);
                @endif
            } else {
                $('#startYear').val('')
                $('#startYear').attr('readonly', false);
            }
            $('#type').valid();
        })

        $form.ajaxForm($formAjaxDefaults);
    });
</script>

@else
    @include('errors.403')

    @endpermission
