@permission('create.users')

<div>
    <div class="page-title">
        <div class="title_left">
            <h3>{{ trans('users.user.title') }}
                <small>{{ trans('app.labels.administration') }}</small>
            </h3>
        </div>

        <div class="title_right hidden-xs">
            <ol class="breadcrumb pull-right">

                @permission('index.users')
                <li>
                    <a href="{{ route('index.users') }}" class="ajaxify"> {{ trans('users.user.title') }}</a>
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
                        <i class="fa fa-user"></i> {{ trans('users.user.labels.new') }}
                    </h2>

                    <ul class="nav navbar-right panel_toolbox">
                        @permission('index.users')
                        <li class="pull-right">
                            <a href="{{ route('index.users') }}" class="btn btn-box-tool ajaxify">
                                <i class="fa fa-times"></i>
                            </a>
                        </li>
                        @endpermission
                    </ul>

                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <form role="form" action="{{ route('store.create.users') }}" method="post"
                          enctype="multipart/form-data"
                          class="form-horizontal form-label-left" id="adminUserCreateFm" novalidate>

                        @csrf

                        <span class="section">{{ trans('users.user.labels.info') }}</span>

                        <div class="item form-group">
                            <label for="photo" class="control-label col-md-3 col-sm-3 col-xs-12">
                                {{ trans('users.user.labels.photo') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="file" name="photo" id="photo"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       accept="image/png, image/jpeg, image/jpg"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="identificationVerification">
                                {{ trans('users.user.labels.user_type') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="checkbox" name="identificationVerification" id="identificationVerification"
                                       value='true' checked>
                                <span>{{ trans('users.user.messages.confirm.user_type') }} </span>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">
                                {{ trans('users.user.labels.username') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="username" id="username"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('users.user.placeholders.username') }}"/>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-2">
                            <span class="fa fa-info-circle fa-2x"
                                  data-toggle="tooltip" rel="tooltip" data-placement="right"
                                  data-original-title="{{ trans('users.user.labels.username_info') }}"></span>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="roles">
                                {{ trans('roles.labels.roles') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control select2" name="roles[]" id="roles">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">

                                            @if($role->enabled)
                                                {{ $role->name }}
                                            @else
                                                {{ $role->name.' '.trans('app.labels.disabled') }}
                                            @endif

                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first_name">
                                {{ trans('users.user.labels.first_name') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="first_name" id="first_name" maxlength="20"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('users.user.placeholders.first_name') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last_name">
                                {{ trans('users.user.labels.last_name') }} <span class="required text-danger">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="last_name" id="last_name" maxlength="20"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('users.user.placeholders.last_name') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">
                                {{ trans('users.user.labels.email') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="email" id="email"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('users.user.placeholders.email') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="hiring_modality_id">
                                {{ trans('users.user.labels.hiring_modality') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="input-group">
                                    <select class="form-control" name="hiring_modality_id" id="hiring_modality_id">
                                        <option></option>
                                        @foreach($hiringModalities as $hiringModality)
                                            <option value="{{ $hiringModality->id }}">

                                                @if($hiringModality->enabled)
                                                    {{ $hiringModality->name }}
                                                @else
                                                    {{ $hiringModality->name.' '.trans('app.labels.disabled') }}
                                                @endif

                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-addon" id="clear-hiring-modality">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="department_id">
                                {{ trans('users.user.labels.department') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="input-group">
                                    <select class="form-control" name="department_id" id="departments">
                                        <option></option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">

                                                @if($department->enabled)
                                                    {{ $department->name }}
                                                @else
                                                    {{ $department->name.' '.trans('app.labels.disabled') }}
                                                @endif

                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-addon" id="clear-departament">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-2">
                            <span class="fa fa-info-circle fa-2x"
                                  data-toggle="tooltip" rel="tooltip" data-placement="right"
                                  data-original-title="{{ trans('users.user.labels.department_info') }}"></span>
                            </div>
                        </div>

                        <div class="item form-group mb-4" id="div_institution">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="institution">
                                {{ trans('users.user.labels.institution') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="institution" id="institution" maxlength="50"
                                       class="form-control col-md-7 col-sm-7 col-xs-12"
                                       placeholder="{{ trans('users.user.placeholders.institution') }}"/>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="responsible_department_id">
                                {{ trans('users.user.labels.responsible_department') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="input-group">
                                    <select class="form-control" name="responsible_department_id" id="responsible_department_id">
                                        <option></option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">

                                                @if($department->enabled)
                                                    {{ $department->name }}
                                                @else
                                                    {{ $department->name.' '.trans('app.labels.disabled') }}
                                                @endif

                                            </option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-addon" id="clear-responsible-department">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="enabled">
                                {{ trans('app.headers.enabled') }}
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="hidden" name="enabled_sent" value="true"/>
                                <input type="checkbox" name="enabled" id="enabled" class="js-switch" checked/>
                            </div>
                        </div>

                        <div class="ln_solid"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                            @permission('index.users')
                            <a href="{{ route('index.users') }}" class="btn btn-info ajaxify">
                                <i class="fa fa-times"></i> {{ trans('app.labels.cancel') }}
                            </a>
                            @endpermission
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> {{ trans('app.labels.save') }}
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
        let $adminUserCreateFm = $('#adminUserCreateFm');

        let validator = $adminUserCreateFm.validate($.extend(false, $validateDefaults, {
            rules: {
                photo: {
                    extension: 'jpg|jpeg|png'
                },
                "roles[]": {
                    required: true
                },
                username: {
                    required: true,
                    cedula: true,
                    maxlength: 45,
                    spaceChecker: true,
                    remote: {
                        url: "{!! route('checkusername.create.users') !!}",
                        data: {
                            username: () => {
                                return $("#username", $adminUserCreateFm).val();
                            }
                        }
                    }
                },
                first_name: {
                    required: true,
                    lettersOnly: true
                },
                last_name: {
                    required: true,
                    lettersOnly: true
                },
                email: {
                    emailChecker: true
                }
            },

            messages: {
                photo: {
                    extension: '{!! trans('users.user.messages.validation.extension') !!}'
                },
                username: {
                    remote: '{!! trans('users.user.messages.validation.username_exists') !!}'
                },
                email: {
                    remote: "{{ trans('employees.messages.validation.email_exists') }}"
                }
            }
        }));

        $("#identificationVerification", $adminUserCreateFm).on('change', (e) => {
            if ($(e.currentTarget).is(':checked') !== true) {
                $("#username", $adminUserCreateFm).rules("remove", "cedula");
                $("#identificationVerification").val('false');
            } else {
                $("#username", $adminUserCreateFm).rules("add", {
                    cedula: true
                });
            }
            validator.element($("#username", $adminUserCreateFm));
        });

        // select role
        $("#roles", $adminUserCreateFm).select2({
            minimumResultsForSearch: -1,
            multiple: true,
            allowClear: true
        }).on('change', () => {
            validator.element($("#roles", $adminUserCreateFm));
        });
        $("#roles", $adminUserCreateFm).val(null).trigger("change");

        // select responsible department
        $("#responsible_department_id", $adminUserCreateFm).select2({
            placeholder: '{{ html_entity_decode(trans('employees.placeholders.department')) }}',
            minimumResultsForSearch: -1,
        });

        // select hiring modality
        $("#hiring_modality_id", $adminUserCreateFm).select2({
            placeholder: '{{ html_entity_decode(trans('employees.placeholders.hiring_modality')) }}',
            minimumResultsForSearch: -1,
        });

        // select departments
        $("#departments", $adminUserCreateFm).select2({
            placeholder: '{{ html_entity_decode(trans('employees.placeholders.department')) }}',
            minimumResultsForSearch: -1,
        }).on('change', () => {
            $('#div_institution').hide();
            $('#institution').val(null);
        });

        // remove departments
        $('#clear-departament').on('click', () => {
            $('#departments').val(null).trigger('change');
            $('#div_institution').show();
            $('#institution').val(null);
        });

        // remove departments
        $('#clear-responsible-department').on('click', () => {
            $('#responsible_department_id').val(null).trigger('change');
        });

        // remove hiring modality
        $('#clear-hiring-modality').on('click', () => {
            $('#hiring_modality_id').val(null).trigger('change');
        });

        $adminUserCreateFm.ajaxForm($.extend(false, $formAjaxDefaults, {}));
    });
</script>

@else
    @include('errors.403')
    @endpermission